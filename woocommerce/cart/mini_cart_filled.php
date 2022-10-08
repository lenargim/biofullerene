<?php $cart = WC()->cart;
$cart_count = $cart->cart_contents_count;
?>
<div class="mini-cart__filled after">
  <div class="mini-cart__info">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M10.0003 6.66667V10M10.0003 13.3333H10.0087M18.3337 10C18.3337 14.6024 14.6027 18.3333 10.0003 18.3333C5.39795 18.3333 1.66699 14.6024 1.66699 10C1.66699 5.39763 5.39795 1.66667 10.0003 1.66667C14.6027 1.66667 18.3337 5.39763 18.3337 10Z"
            stroke="#D17D00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <span>Ships every 30 days. Arrives in 3-5 business days. Free returns within 45 days of purchase.</span>
  </div>
  <div class="mini-cart__list list-loader">
    <?php include get_template_directory() . '/woocommerce/cart/mini_cart_items.php'; ?>
  </div>
  <div class="mini-cart__total">
    <div class="mini-cart__total-row">
      <span>Subtotal:</span><span>$<span class="subtotal"><?php echo $cart->subtotal; ?></span> </span>
    </div>
    <div class="mini-cart__total-row">
      <span>Shipping:</span><span>$<?php echo $cart->get_shipping_total(); ?></span>
    </div>
    <div class="mini-cart__total-row">
      <span>Discount:</span><span class="discount">-$<?php echo $cart->get_discount_total(); ?></span>
    </div>
    <div class="mini-cart__total-row mini-cart__total-all">
      <span>Total:</span><span>$<span class="total"><?php echo $cart->total; ?></span></span>
    </div>
  </div>
  <div class="mini-cart__buttons buttons">
    <a href="<?php echo wc_get_cart_url(); ?>" class="button white">
            <span>View cart (<span
                      class="count"><?php echo $cart_count ?></span>)</span>
    </a>
    <a href="<?php echo wc_get_checkout_url(); ?>" class="button blue">Secure checkout</a>
  </div>
</div>