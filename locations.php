<?php
// Template name: Locations
?>

<?php get_template_part( 'template-parts/header/header' ); ?>
<main class="locations">
    <div class="locations__banner page-banner" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
        <div class="container">
            <div class="blog__breadcrumbs breadcrumbs breadcrumbs_white">
                <a href="/" class="home">
			        <?php if ( ! wp_is_mobile() ): ?>
                        Home
			        <?php else: ?>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 4.5L2 3.87092M2 3.87092L5.58258 1.61718C5.83095 1.46094 6.16905 1.46094 6.41742 1.61718L10 3.87092M2 3.87092V9.95759C2 10.2572 2.23878 10.5 2.53333 10.5H9.46667C9.76122 10.5 10 10.2572 10 9.95759V3.87092M10 3.87092L11 4.5"
                                  stroke-width="1.2" stroke-linecap="round"/>
                        </svg>
			        <?php endif; ?>
                </a>
                <svg class="separator" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 15L12.5 10L7.5 5" stroke-width="1.6" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                <span>Company</span>
            </div>
			<?php
			global $post;
			$args      = [
				'post_type'      => 'contacts',
				'numberposts'    => - 1,
				'posts_per_page' => - 1,
			];
			$published = wp_count_posts( 'contacts' )->publish;
			$countries = get_posts( $args );
			?>
            <div class="blog-banner__title">
				<span><?php the_title(); ?></span>
                <span class="count"><?php echo $published; ?>
                    countries</span>
            </div>
            <div class="locations__banner-desc"><?php the_content(); ?></div>
        </div>
    </div>
    <div class="container">
        <div class="locations__tabs">
			<?php $i = 0; ?>
			<?php foreach ( $countries as $post ): ?>
				<?php setup_postdata( $post ); ?>
                <div class="locations__tab <?php if ( $i === 0 ) {
					echo 'active';
				} ?>">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                    <span><?php the_title(); ?></span>
                </div>
				<?php $i ++; ?>
			<?php endforeach; ?>
        </div>
        <div class="locations__section">
	        <?php $i = 0; ?>
	        <?php foreach ( $countries as $post ): ?>
		        <?php setup_postdata( $post ); ?>
                <div class="locations__item <?php if ( $i === 0 ) {
	                echo 'active';
                } ?>">
                    <iframe class="map" data-src="<?php the_field('map') ?>"
                            allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="locations__box">
                        <div class="locations__box-title">Headquarters</div>
                        <a href="tel:<?php the_field('phone') ?>" class="locations__box-phone"><?php the_field('phone') ?></a>
                        <a href="mailto:<?php the_field('email') ?>" class="locations__box-mail"><?php the_field('email') ?></a>
                        <address class="locations__box-address"><?php the_field('address') ?></address>
                        <div class="socials locations__box-socials">
                            <a href="https://www.instagram.com/<?php the_field('instagram'); ?>" target="_blank"
                               class="socials__link locations__box-link">
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#inst"></use>
                                </svg>
                            </a>
	                        <?php $whatsUp = get_field( 'whatsup', 159 ); ?>
                            <a href="https://api.whatsapp.com/send?phone=<?php echo trim($whatsUp, '+') ?>" target="_blank"
                               class="socials__link locations__box-link">
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#whatsup-blue"></use>
                                </svg>
                            </a>

                        </div>
                    </div>
                </div>
		        <?php $i ++; ?>
	        <?php endforeach; ?>
        </div>
    </div>
</main>
<?php get_template_part( 'template-parts/footer/footer' ); ?>
