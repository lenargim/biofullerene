<?php if ((is_cart() || is_checkout())):
  return; ?>
<?php endif; ?>
<div class="overlay">
  <div class="modal mini-cart">
    <?php woocommerce_mini_cart() ?>
  </div>
</div>