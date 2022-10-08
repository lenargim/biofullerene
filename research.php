<?php
// Template name: Research
?>

<?php get_template_part( 'template-parts/header/header' ); ?>
    <main class="blog">
        <div class="blog-banner" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
            <div class="container">
				<?php $bargs = [
					'delimiter'   => '<svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 15L12.5 10L7.5 5" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
					'wrap_before' => '<nav class="breadcrumbs blog__breadcrumbs">',
				];
				echo woocommerce_breadcrumb( $bargs ); ?>
				<?php
				global $post;
				$args  = [
					'post_type'      => 'post',
					'numberposts'    => 12,
					'posts_per_page' => 12,
				];
				$posts = get_posts( $args );
                $published = wp_count_posts()->publish
				?>
                <div class="blog-banner__title">Research references<span
                            class="count"><?php echo wp_count_posts()->publish ?> articles</span></div>
            </div>
        </div>
        <div class="blog-tags">
            <div class="container">
				<?php
				$tags = get_tags( $args );
				?>
                <div class="blog-tags__wrap">
                    <div class="blog-tags__tag" data-slug="">
                        All articles
                        <svg class="blog-tags__close" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 5L5 15M5 5L15 15" stroke="white" stroke-width="1.6" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </div>
					<?php foreach ( $tags as $tag ): ?>
                        <div class="blog-tags__tag" data-slug="<?php echo $tag->slug ?>">
							<?php echo $tag->name; ?>
                            <svg class="blog-tags__close" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
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