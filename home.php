<?php
// Template name: Главная
?>

<?php get_template_part( 'template-parts/header/header' ); ?>
    <main>
        <section class="banner" style="background-image: url(<?php the_field( 'img' ) ?>)">
            <div class="container">
                <div class="banner__text">
                    <h1 class="banner__title"><?php the_field( 'title' ) ?></h1>
                    <p class="banner__annotation"><?php the_field( 'annotation' ) ?></p>
					<?php $button = get_field( 'button' ); ?>
					<?php if ( $button ): ?>
                        <div class="banner__box">
                            <a href="<?php echo $button['link'] ?>"
                               class="banner__button button blue"><?php echo $button['text'] ?></a>
                            <div class="banner__after"><?php echo $button['after'] ?></div>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </section>
        <section class="caring block">
            <div class="container">
                <div class="caring__wrap">
                    <div class="caring__text">
                        <h2><?php the_field( 'caring-title' ) ?></h2>
                        <div class="caring__desc main-text"><?php the_field( 'caring-text' ) ?></div>
                    </div>
					<?php if ( have_rows( 'caring-list' ) ): ?>
                        <ol class="caring__list">
							<?php while ( have_rows( 'caring-list' ) ) : the_row() ?>
                                <li class="caring__item"><?php the_sub_field( 'item' ); ?></li>
							<?php endwhile; ?>
                        </ol>
					<?php endif; ?>
                </div>
            </div>
        </section>
		<?php get_template_part( 'template-parts/benefits' ); ?>
        <section class="mainpage-products block">
            <div class="container">
                <div class="mainpage-products__wrap">
					<?php
					$args = array(
						'post_type'      => 'product',
						'posts_per_page' => - 1
					);
					$loop = new WP_Query( $args );
					if ( $loop->have_posts() ) {
						if ( $loop->post_count === 1 ) {
							while ( $loop->have_posts() ) : $loop->the_post();
								wc_get_template_part( 'content', 'custom-product' );
							endwhile;
						} else { ?>
                            <div class="block-wrap mainpage-multiple__heading">
                                <h3 class="block-title">Meet the lineup <sup
                                            class="sup"><?php echo wp_count_posts( 'product' )->publish; ?>
                                        products</sup></h3>
                                <div class="navigation">
          <span class="navigation-button navigation-prev products-prev">
            <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use></svg>
          </span>
                                    <span class="navigation-button navigation-next products-next">
            <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use></svg>
          </span>
                                </div>
                            </div>
                            <div class="mainpage-multiple__slider">
                                <div class="swiper-wrapper">
									<?php
									while ( $loop->have_posts() ) : $loop->the_post();
										wc_get_template_part( 'content', 'custom-product-multiple' );
									endwhile;
									?>
                                </div>
                                <div class="scrollbar-wrap">
                                    <div class="custom-scrollbar"></div>
                                </div>
                            </div>
						<?php }
					} else {
						echo __( 'No products found' );
					}
					wp_reset_postdata();
					?>
                </div>
            </div>
        </section>
        <section class="solution block">
            <div class="container">
                <h2 class="center"><?php the_field( 'solution-title' ) ?></h2>
                <div class="main-text"><?php the_field( 'solution-main' ) ?></div>
                <div class="solution__desc"><?php the_field( 'solution-desc' ) ?></div>
                <div class="solution__info">
					<?php while ( have_rows( 'solution-info' ) ) : the_row() ?>
                        <div class="solution__item">
                            <div><?php the_sub_field( 'text1' ); ?></div>
                            <div class="big"><?php the_sub_field( 'text2' ); ?></div>
                            <div><?php the_sub_field( 'text3' ); ?></div>
                        </div>
					<?php endwhile; ?>
                </div>
            </div>
        </section>
		<?php get_template_part( 'template-parts/info' ); ?>
		<?php get_template_part( 'template-parts/team' ); ?>
		<?php get_template_part( 'template-parts/research' ); ?>
        <section class="reviews block">
            <div class="container">
                <div class="reviews__title-wrap">
                    <h3 class="block-title">What customers are saying</h3>
                    <div class="navigation">
          <span class="navigation-button navigation-prev reviews-prev">
            <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use></svg>
          </span>
                        <span class="navigation-button navigation-next reviews-next">
            <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use></svg>
          </span>
                    </div>
                </div>
                <div class="reviews__slider">
					<?php
					$args     = [
						'status'    => 'approve',
						'post_type' => 'product',
					];
					$comments = get_comments( $args );
					?>
                    <div class="swiper-wrapper">
						<?php foreach ( $comments as $comment ): ?>
                            <div class="swiper-slide reviews__item">
								<?php $name = explode( " ", $comment->comment_author );
								$initials   = null;
								foreach ( $name as $i ) {
									$initials .= $i[0];
								} ?>
                                <div class="reviews__item-top">
                                    <div class="reviews__item-logo logo"><?php echo $initials ?></div>
                                    <div class="reviews__item-info">
                                        <div class="reviews__item-name"><?php echo $comment->comment_author; ?></div>
										<?php if ( get_field( 'age', $comment ) ): ?>
                                            <div class="reviews__item-age"><?php the_field( 'age', $comment ); ?> years
                                                old
                                            </div>
										<?php endif; ?>
                                    </div>
									<?php $rating = get_comment_meta( $comment->comment_ID, 'rating', true ); ?>
                                    <div class="reviews__item-rating">
										<?php for ( $i = 0; $i < 5; $i ++ ) { ?>
                                            <div class="star <?php if ( $i < $rating ): echo 'orange'; endif; ?>"></div>
										<?php }
										?>
                                    </div>
                                </div>
                                <div class="reviews__item-text"><?php echo get_comment_excerpt($comment->comment_ID); ?></div>
                                <div class="reviews__item-full" data-id="<?php echo $comment->comment_ID; ?>">Read full review</div>
                            </div>
						<?php endforeach; ?>
                    </div>
                    <div class="scrollbar-wrap">
                        <div class="custom-scrollbar"></div>
                    </div>
                </div>
            </div>
        </section>
		<?php get_template_part( 'template-parts/faq' ); ?>
    </main>
<?php get_template_part( 'template-parts/footer/footer' ); ?>