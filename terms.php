<?php
/**
 * Template name: Terms
 **/
?>

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
                <span><?php wp_title('') ?></span>
            </div>

            <h1><?php the_title(); ?></h1>
            <div class="single-post__banner-desc">Last Updated: <?php echo get_the_modified_time('F j, Y') ?></div>
        </div>
        <svg class="line" width="494" height="479" viewBox="0 0 494 479" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M461.708 46.458C461.708 46.458 539.829 219.404 404.905 233.837C280.993 247.092 270.949 -26.7582 101.18 14.5959C-98.636 63.269 198.489 410.475 4.10157 476.021" stroke="#FBCEB1" stroke-width="20" stroke-dasharray="4 24"/>
        </svg>
    </div>
    <div class="container">
        <div class="single-post__main">
	        <?php get_template_part( 'template-parts/share' ); ?>
            <div class="text-page">
                <?php the_content(); ?>
            </div>
        </div>
	    <?php get_template_part( 'template-parts/not-find' ); ?>
    </div>
</main>
<?php get_template_part( 'template-parts/footer/footer' ); ?>
