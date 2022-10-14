<?php
// Template name: Research
?>

<?php get_template_part( 'template-parts/header/header' ); ?>
    <main class="blog">
        <div class="blog-banner page-banner" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
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
                    <span><?php wp_title(''); ?></span>
                </div>
				<?php global $post;
				$args      = [
					'post_type'      => 'post',
					'numberposts'    => 12,
					'posts_per_page' => 12,
				];
				$posts     = get_posts( $args );
				$published = wp_count_posts()->publish
				?>
                <div class="blog-banner__title">Research references<span
                            class="count"><?php echo wp_count_posts()->publish ?> articles</span></div>
            </div>
        </div>
        <div class="blog-tags">
            <div class="container">
                <div class="blog-tags__toggle">Show filters</div>
				<?php $tags = get_tags( $args ); ?>
                <div class="blog-tags__wrap">
                    <div class="blog-tags__tag" data-slug="">
                        All articles
                        <svg class="blog-tags__close" width="20" height="20" viewBox="0 0 20 20" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 5L5 15M5 5L15 15" stroke="white" stroke-width="1.6" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </div>
					<?php foreach ( $tags as $tag ): ?>
                        <div class="blog-tags__tag" data-slug="<?php echo $tag->slug ?>">
							<?php echo $tag->name; ?>
                            <svg class="blog-tags__close" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 5L5 15M5 5L15 15" stroke="white" stroke-width="1.6" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>

                        </div>
					<?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="blog-list">
            <div class="container">
                <div class="blog-list__wrap">
					<?php foreach ( $posts as $post ):
						setup_postdata( $post ); ?>
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
					<?php endforeach;
					wp_reset_postdata();
					?>
                </div>
				<?php if ( $published > 12 ): ?>
                    <button class="blog-list__button button white">Explore more</button>
				<?php endif; ?>
            </div>
        </div>
    </main>
<?php get_template_part( 'template-parts/footer/footer' ); ?>