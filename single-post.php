<?php get_template_part( 'template-parts/header/header' ); ?>

<main class="main">
    <div class="single-post__banner">
        <div class="container">
            <nav class="single-post__breadcrumbs breadcrumbs">
                <a href="/">Home</a>
                <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 15L12.5 10L7.5 5" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <a href="<?php echo get_page_link( 129 ) ?>">Research</a>
            </nav>
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
    <div class="container">
        <div class="single-post__main">
            <div class="single-post__socials">
                <p>Share:</p>
                <div class="socials">
                    <a href="https://www.instagram.com/<?php the_field( 'instagram', 159 ); ?>" target="_blank"
                       class="socials__link">
                        <svg>
                            <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#inst"></use>
                        </svg>
                    </a>
                    <a href="https://twitter.com/<?php the_field( 'twitter', 159 ); ?>" target="_blank"
                       class="socials__link">
                        <svg>
                            <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#tw"></use>
                        </svg>
                    </a>
                    <div class="socials__link copy-link">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.6668 8.66767C6.9531 9.05042 7.31837 9.36713 7.73783 9.5963C8.1573 9.82547 8.62114 9.96175 9.0979 9.99589C9.57466 10.03 10.0532 9.96125 10.501 9.79419C10.9489 9.62714 11.3555 9.36572 11.6935 9.02767L13.6935 7.02767C14.3007 6.399 14.6366 5.55699 14.629 4.683C14.6215 3.80901 14.2709 2.97297 13.6529 2.35494C13.0348 1.73692 12.1988 1.38635 11.3248 1.37876C10.4508 1.37116 9.60881 1.70714 8.98013 2.31434L7.83347 3.45434M9.33347 7.33434C9.04716 6.95159 8.68189 6.63488 8.26243 6.40571C7.84297 6.17654 7.37913 6.04026 6.90237 6.00612C6.4256 5.97197 5.94708 6.04076 5.49924 6.20782C5.0514 6.37487 4.64472 6.63629 4.3068 6.97434L2.3068 8.97434C1.69961 9.60301 1.36363 10.445 1.37122 11.319C1.37881 12.193 1.72938 13.029 2.3474 13.6471C2.96543 14.2651 3.80147 14.6157 4.67546 14.6233C5.54945 14.6308 6.39146 14.2949 7.02013 13.6877L8.16013 12.5477"
                                  stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
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
				<?php
				$args  = [
					'numberposts' => 5,
					'post_type'   => 'faq',

				];
				$posts = get_posts( $args );
				?>
                <div class="faq__list">
					<?php $faq_count = 0 ?>
					<?php foreach ( $posts as $post ): ?>
						<?php $faq_count ++; ?>
						<?php setup_postdata( $post ); ?>
                        <div class="faq__item <?php if ( $faq_count == 2 ) {
							echo 'opened';
						} ?>">
                            <div class="faq__item-title">
                                <span><?php the_title(); ?></span>
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                                </svg>
                            </div>
                            <div class="faq__item-content"><?php the_content(); ?></div>
                        </div>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
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
