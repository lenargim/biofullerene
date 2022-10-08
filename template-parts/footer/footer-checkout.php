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
<?php wp_footer(); ?>
</body>
</html>
