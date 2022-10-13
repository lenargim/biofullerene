<div class="mini-cart__empty after">
  <img src="<?php echo IMAGES_PATH; ?>/empty-cart.png" class="mini-cart__empty-img" alt="Your cart is empty">
  <div class="mini-cart__empty-title">Your cart is empty</div>
  <p class="mini-cart__empty-desc">Looks like your cart is empty.<br>Start adding items!</p>
  <?php $permalink = get_permalink(66); ?>
  <a href="<?php echo $permalink ?>" class="button blue mini-cart__empty-button">Start shopping now</a>
</div>