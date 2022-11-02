<?php get_template_part( 'template-parts/header/head' ); ?>

    <main class="not-found">
        <div class="not-found__top">
            <div class="container">
                <a href="/" class="not-found__logo">
                    <svg>
                        <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#logo"></use>
                    </svg>
                </a>
            </div>
        </div>
        <div class="not-found__bottom">
            <div class="container">
                <div class="not-found__text">
                    <div class="not-found__title"><span class="underline">Oops!</span><br>Page Not Found</div>
                    <div class="not-found__desc">Looks like this page doesn't exist, sorry. That button below seems
                        pretty
                        important right about now.
                    </div>
                    <a href="/" class="not-found__back button white">Back to homepage</a>
                </div>
            </div>
        </div>
        </div>
        <svg class="line" width="494" height="479" viewBox="0 0 494 479" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M461.708 46.458C461.708 46.458 539.829 219.404 404.905 233.837C280.993 247.092 270.949 -26.7582 101.18 14.5959C-98.636 63.269 198.489 410.475 4.10157 476.021" stroke="#FBCEB1" stroke-width="20" stroke-dasharray="4 24"/>
        </svg>
    </main>

<?php get_template_part( 'template-parts/footer/footer' ); ?>