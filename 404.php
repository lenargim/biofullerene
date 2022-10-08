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
    </main>

<?php get_template_part( 'template-parts/footer/footer' ); ?>