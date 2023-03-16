<?php get_template_part( 'template-parts/header/header' ); ?>
<?php global $post; ?>
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
                <span><?php wp_title( '' ); ?></span>
            </div>
            <h1><?php wp_title( '' ); ?></h1>
        </div>
    </div>
    <div class="container">
        <div class="single-post__main">
	        <?php get_template_part( 'template-parts/share' ); ?>
            <div class="single-post__text">
                <div class="faq__list">
					<?php
					while ( have_posts() ):
						the_post(); ?>
                        <div class="faq__item">
                            <div class="faq__item-title">
                                <span><?php the_title(); ?></span>
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                                </svg>
                            </div>
                            <div class="faq__item-content"><?php the_content(); ?></div>
                        </div>
					<?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
	<?php get_template_part( 'template-parts/not-find' ); ?>
</main>
<?php get_template_part( 'template-parts/footer/footer' ); ?>
