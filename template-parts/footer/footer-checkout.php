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
<footer class="footer-checkout">
  <div class="container">
    <div class="footer-checkout__policy">
      <span>© 2022, Biofullerene</span>
      <?php wp_nav_menu([
          'menu' => 34,
          'container' => false,
          'menu_class' => 'footer__policy-menu',
          'depth' => 1,
      ]) ?>
    </div>
  </div>
</footer>
<div class="overlay">
    <div class="modal modal-help">
        <div class="close">
            <svg>
                <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#close"></use>
            </svg>
        </div>
        <div class="modal-help__title">
            <div class="pre">Help center</div>
            <div class="modal__title">Do you have any questions?</div>
        </div>
        <div class="modal-help__desc">What would you like help with today? You can quickly take care of most things here, or
            connect with us when needed.
        </div>
        <div class="modal-help__list">
            <a href="<?php echo get_post_type_archive_link('faq'); ?>" class="modal-help__item">Frequently asked questions</a>
            <a href="#" class="modal-help__item">Subscribtion</a>
            <a href="<?php echo get_page_link(65); ?>" class="modal-help__item">Return Policy</a>
            <a href="#" class="modal-help__item">Shipping</a>
        </div>
        <div class="modal-help__more">
            <div class="modal-help__more-title">Can not find your answer? Please contact us</div>
            <button class="modal-help__more-link" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 2.00024L11 13.0002M22 2.00024L15 22.0002L11 13.0002M22 2.00024L2 9.00024L11 13.0002" stroke="#121417" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Send a question</span>
            </button>
        </div>
        <div class="modal-help__footer">
            Or contact us by email anytime and we’ll get back<br>
            to you within 48 hours:
            <a href="mailto:<?php echo the_field('email', 159);?>">
				<?php echo the_field('email', 159);?></a>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
