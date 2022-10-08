<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;
?>
<div class="cart-page__empty">
  <img src="<?php echo IMAGES_PATH; ?>/empty-cart.png" class="mini-cart__empty-img" alt="Your cart is empty">
  <div class="mini-cart__empty-title">Your cart is empty</div>
  <p class="mini-cart__empty-desc">Looks like your cart is empty.<br>Start adding items!</p>
  <?php
  $count_posts = wp_count_posts('product')->publish;
  if (intval($count_posts) === 1) :
    $prod_link = wc_get_products(['numberposts' => 1, 'post_status' => 'publish'])[0]->get_permalink();
  else:
    $prod_link = get_permalink(wc_get_page_id('cart'));
  endif;
  ?>
  <a href="<?php echo $prod_link ?>" class="button blue cart-page__empty-button">Start shopping now</a>
</div>