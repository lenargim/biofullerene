<div class="mini-cart__empty after">
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
  <a href="<?php echo $prod_link ?>" class="button blue mini-cart__empty-button">Start shopping now</a>
</div>