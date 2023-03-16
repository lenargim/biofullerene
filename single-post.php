<?php get_template_part( 'template-parts/header/header' ); ?>

<main class="main">
    <div class="single-post__banner">
        <div class="container">
            <div class="single-post__breadcrumbs breadcrumbs">
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
                <a href="<?php echo get_page_link( 129 ) ?>">Research</a>
            </div>
            <h1><?php the_title(); ?></h1>
        </div>
        <svg class="line" width="494" height="479" viewBox="0 0 494 479" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M461.708 46.458C461.708 46.458 539.829 219.404 404.905 233.837C280.993 247.092 270.949 -26.7582 101.18 14.5959C-98.636 63.269 198.489 410.475 4.10157 476.021" stroke="#FBCEB1" stroke-width="20" stroke-dasharray="4 24"/>
        </svg>

    </div>
    <div class="container">
        <div class="single-post__main">
	        <?php get_template_part( 'template-parts/share' ); ?>
            <div class="single-post__text">
				<?php $tags = get_the_tags(); ?>
				<?php if ( $tags ): ?>
                    <div class="single-post__tags">
						<?php foreach ( $tags as $tag ): ?>
                            <div class="single-post__tag"><?php echo $tag->name; ?></div>
						<?php endforeach; ?>
                    </div>
				<?php endif; ?>
                <div class="single-post__content text-page">
					<?php the_content(); ?>
                </div>
            </div>
        </div>
		<?php
		global $post;
		$tags = wp_get_post_tags( $post->ID );
		if ( $tags ): ?>
            <section class="single-post__related block">
				<?php
				$tag_ids = array();
				foreach ( $tags as $individual_tag ) {
					$tag_ids[] = $individual_tag->term_id;
				}
				$args     = array(
					'tag__in'          => $tag_ids,
					'post__not_in'     => array( $post->ID ),
					'posts_per_page'   => - 1,
					'caller_get_posts' => 1
				);
				$my_query = new wp_query( $args );
				if ( $my_query->have_posts() ): ?>
                    <div class="single-post__title-wrap">
                        <h3 class="block-title research__title">Related researches <sup
                                    class="sup"><?php echo $my_query->found_posts; ?> articles</sup>
                        </h3>
                        <div class="navigation">
                            <div class="navigation-button navigation-prev related-prev">
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                                </svg>
                            </div>
                            <div class="navigation-button navigation-next related-next">
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="single-post__slider">
                        <div class="swiper-wrapper">
							<?php while ( $my_query->have_posts() ):
								$my_query->the_post();
								?>
                                <div class="swiper-slide">
                                    <div class="research__item">
                                        <a href="<?php echo get_post_permalink(); ?>" class="research__item-img img">
                                            <img src="<?php the_post_thumbnail_url( 'research_thumbnail' ) ?>"
                                                 alt="<?php the_title() ?>">
                                        </a>
										<?php $tags = get_the_tags(); ?>
										<?php if ( $tags ) : ?>
                                            <div class="research__item-taglist">
												<?php foreach ( $tags as $tag ): ?>
                                                    <span class="research__item-tag"><?php echo $tag->name ?></span>
												<?php endforeach; ?>
                                            </div>
										<?php endif; ?>
                                        <a href="<?php echo get_post_permalink(); ?>"
                                           class="research__item-title"><?php the_title() ?></a>
                                    </div>
                                </div>
							<?php endwhile;
							wp_reset_query();
							?>
                        </div>
                    </div>
				<?php endif; ?>
            </section>
		<?php endif; ?>
    </div>
</main>
<?php get_template_part( 'template-parts/footer/footer' ); ?>
