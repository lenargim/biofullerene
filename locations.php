<?php
// Template name: Locations
?>

<?php get_template_part( 'template-parts/header/header' ); ?>
<main class="locations">
    <div class="locations__banner" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
        <div class="container">
			<?php $bargs = [
				'delimiter'   => '<svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 15L12.5 10L7.5 5" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
				'wrap_before' => '<nav class="breadcrumbs blog__breadcrumbs">',
			];
			echo woocommerce_breadcrumb( $bargs ); ?>
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
				<?php the_title(); ?>
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
                            <a href="https://twitter.com/<?php the_field('twitter'); ?>" target="_blank"
                               class="socials__link locations__box-link">
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#tw"></use>
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
