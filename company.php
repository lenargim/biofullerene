<?php
// Template name: Company
?>

<?php get_template_part( 'template-parts/header/header' ); ?>
<main class="company-page text-page">
    <div class="company-page__banner page-banner" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
        <div class="container">
            <div class="blog__breadcrumbs breadcrumbs">
                <a href="/" class="home">
			        <?php if ( ! wp_is_mobile() ): ?>
                        Home
			        <?php else: ?>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 4.5L2 3.87092M2 3.87092L5.58258 1.61718C5.83095 1.46094 6.16905 1.46094 6.41742 1.61718L10 3.87092M2 3.87092V9.95759C2 10.2572 2.23878 10.5 2.53333 10.5H9.46667C9.76122 10.5 10 10.2572 10 9.95759V3.87092M10 3.87092L11 4.5"
                                  stroke="#fff" stroke-width="1.2" stroke-linecap="round"/>
                        </svg>
			        <?php endif; ?>
                </a>
                <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 15L12.5 10L7.5 5" stroke-width="1.6" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                <span>Company</span>
            </div>
            <?php
			global $post;
			$args      = [
				'post_type'      => 'post',
				'numberposts'    => 12,
				'posts_per_page' => 12,
			];
			$published = wp_count_posts()->publish
			?>
            <div class="blog-banner__title"><?php the_title(); ?></div>
            <div class="company-page__banner-desc"><?php the_content(); ?></div>
        </div>
    </div>
    <div class="container">
        <div class="company-page__nav">
            <a href="#about" class="company-page__link active">About us</a>
            <a href="#mission" class="company-page__link">Mission and goals</a>
            <a href="#team" class="company-page__link">Team</a>
        </div>
        <section class="block-about" id="about">
            <div class="company-page__wrap">
                <h2 class="company-page__title">About us</h2>
                <div class="company-page__content">
					<?php the_field( 'about-text' ); ?>
					<?php if ( get_field( 'about-list' ) ): ?>
                        <ul>
							<?php while ( have_rows( 'about-list' ) ): the_row() ?>
                                <li>
                                    <span><?php the_sub_field( 'item' ) ?></span>
                                </li>
							<?php endwhile; ?>
                        </ul>
					<?php endif; ?>
                </div>
            </div>
            <div class="about__slider">
				<?php $images = get_field( 'slider' );
				if ( $images ): ?>
                    <div class="swiper-wrapper">
						<?php foreach ( $images as $img ): ?>
                            <div class="swiper-slide">
                                <div class="about__slider-img">
                                    <img src="<?php echo esc_url( $img ); ?>">
                                </div>
                            </div>
						<?php endforeach; ?>
                    </div>
				<?php endif; ?>
                <div class="navigation about__slider-navigation">
                    <div class="navigation-button navigation-prev about-prev">
                        <svg>
                            <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                        </svg>
                    </div>
                    <div class="navigation-button navigation-next about-next">
                        <svg>
                            <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        <section class="block-mission" id="mission">
            <div class="company-page__wrap">
                <h2 class="company-page__title">Mission and goals</h2>
                <div class="company-page__content">
					<?php the_field( 'mission-text' ); ?>
					<?php if ( get_field( 'mission-infographic' ) ): ?>
                        <div class="mission__infograthic">
							<?php while ( have_rows( 'mission-infographic' ) ) : the_row(); ?>
                                <div class="mission__infograthic-item">
                                    <div class="mission__infograthic-img"><img src="<?php the_sub_field( 'img' ); ?>">
                                    </div>
                                    <div class="mission__infograthic-title"><?php the_sub_field( 'title' ); ?></div>
                                    <div class="mission__infograthic-desc"><?php the_sub_field( 'text' ); ?></div>
                                </div>
							<?php endwhile; ?>
                        </div>
					<?php endif; ?>
                    <div class="mission__alert">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.0003 6.66667V10M10.0003 13.3333H10.0087M18.3337 10C18.3337 14.6024 14.6027 18.3333 10.0003 18.3333C5.39795 18.3333 1.66699 14.6024 1.66699 10C1.66699 5.39763 5.39795 1.66667 10.0003 1.66667C14.6027 1.66667 18.3337 5.39763 18.3337 10Z"
                                  stroke="#D17D00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span><?php the_field( 'mission-alert' ); ?></span>
                    </div>
                    <div class="mission__desc"><?php the_field( 'mission-description' ); ?></div>
                </div>
            </div>
        </section>
        <section class="block-team block" id="team">
            <div class="company-page__wrap">
                <h2 class="company-page__title">Team</h2>
                <div class="company-page__content">
					<?php the_field( 'team-desc' ); ?>
                </div>
            </div>
			<?php
			$args = [
				'post_type'   => 'experts',
				'numberposts' => - 1,
			];
			$team = get_posts( $args ); ?>
            <div class="block-team__people">
				<?php foreach ( $team as $post ):
					setup_postdata( $post ); ?>
                    <div class="block-team__item">
                        <div class="block-team__img img"><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></div>
                        <div class="block-team__name"><?php the_title(); ?></div>
                        <div class="block-team__job"><?php the_field('expert-position'); ?></div>
                    </div>
				<?php endforeach;
				wp_reset_postdata(); ?>
            </div>
        </section>
    </div>
</main>
<?php get_template_part( 'template-parts/footer/footer' ); ?>
