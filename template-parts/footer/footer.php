<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<footer class="footer">
    <div class="container">
        <div class="footer__row">
            <div class="footer__row-text">
                <div class="footer__row-title">Join our newsletter</div>
                <div class="footer__row-desc">Receive news, articles and events by email.</div>
            </div>
            <div class="footer__row-subscribe"><?php echo do_shortcode( '[contact-form-7 id="143" title="Subscribe"]' ); ?></div>
        </div>
        <div class="footer__main">
            <div class="footer__column">
                <svg class="footer__logo">
                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#logo"></use>
                </svg>
                <div class="socials footer__socials">
                    <a href="https://www.instagram.com/<?php the_field( 'instagram', 159 ); ?>" target="_blank"
                       class="socials__link footer__socials-link">
                        <svg>
                            <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#inst"></use>
                        </svg>
                    </a>
<!--                    <a href="https://twitter.com/--><?php //the_field( 'twitter', 159 ); ?><!--" target="_blank"-->
<!--                       class="socials__link footer__socials-link">-->
<!--                        <svg>-->
<!--                            <use xlink:href="--><?php //echo IMAGES_PATH; ?><!--/sprite-common.svg#tw"></use>-->
<!--                        </svg>-->
<!--                    </a>-->
                </div>
            </div>
            <div class="footer__column">
                <div class="footer__column-title">Product</div>
				<?php wp_nav_menu( [
					'menu'       => 31,
					'container'  => false,
					'menu_class' => 'footer__menu',
					'depth'      => 1,
				] ) ?>
            </div>
            <div class="footer__column">
                <div class="footer__column-title">Company</div>
				<?php wp_nav_menu( [
					'menu'       => 32,
					'container'  => false,
					'menu_class' => 'footer__menu',
					'depth'      => 1,
				] ) ?>
            </div>
            <div class="footer__column">
                <div class="footer__column-title">Support</div>
				<?php wp_nav_menu( [
					'menu'       => 33,
					'container'  => false,
					'menu_class' => 'footer__menu',
					'depth'      => 1,
				] ) ?>
                <a href="#" class="footer__help open-modal-help">Need help?</a>
            </div>
        </div>
        <div class="footer__text"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
        <div class="footer__policy">
            <span>© 2022</span>
			<?php wp_nav_menu( [
				'menu'       => 34,
				'container'  => false,
				'menu_class' => 'footer__policy-menu',
				'depth'      => 1,
			] ) ?>
        </div>
    </div>
</footer>
<?php get_template_part( 'template-parts/modal' ); ?>
<?php wp_footer(); ?>
</body>
</html>
