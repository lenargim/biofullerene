<?php

defined('ABSPATH') || exit; ?>
<div class="mini-cart__info">
  <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M10.0003 6.66667V10M10.0003 13.3333H10.0087M18.3337 10C18.3337 14.6024 14.6027 18.3333 10.0003 18.3333C5.39795 18.3333 1.66699 14.6024 1.66699 10C1.66699 5.39763 5.39795 1.66667 10.0003 1.66667C14.6027 1.66667 18.3337 5.39763 18.3337 10Z"
          stroke="#D17D00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>
  <span><?php the_field('shipping-tip') ?></span>
</div>
<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
  <?php $cart = WC()->cart; ?>
  <?php $items = $cart->get_cart(); ?>
  <div class="cart-page__wrap">
    <div class="cart-page__list list-loader">
      <?php foreach ($items as $item => $values):
        $_product = wc_get_product($values['data']->get_id());
        $product_link = get_permalink($values['data']->get_id());
        $variations = wc_get_formatted_cart_item_data($values, true);
        ?>
        <div class="mini-cart__item" data-id="<?php echo $_product->get_id() ?>">
          <div class="mini-cart__left">
            <a href="<?php echo $product_link; ?>" class="mini-cart__img img">
              <?php echo $_product->get_image(); ?>
            </a>
            <div class="mini-cart__text">
              <?php $product = $_product ?>
              <div class="mini-cart__name"><?php echo $product->get_title(); ?></div>

              <div class="mini-cart__desc">
                <?php echo $_product->get_description() ?>
              </div>
              <div class="mini-cart__quantity-wrap">
                <div class="mini-cart__update minus <?php if ($values['quantity'] === 1) echo ' disabled' ?>"
                     data-type="minus">
                  <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.33301 8H12.6663" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

                </div>
                <input data-key="<?php echo $item; ?>" type="text" readonly class="quanity mini-cart__quantity"
                       value="<?php echo $values['quantity']; ?>">
                <div class="mini-cart__update" data-type="plus">
                  <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.99967 3.33334V12.6667M3.33301 8.00001H12.6663" stroke-width="1.6" stroke-linecap="round"
                          stroke-linejoin="round"/>
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="mini-cart__right">
            <div class="mini-cart__remove" data-key="<?php echo $item; ?>">Remove</div>
            <div class="mini-cart__right-price">
              <?php
              $quantity = $values['quantity'];
              $price = $_product->get_price();
              $reg_price = $_product->get_regular_price();
              if ($price !== $reg_price): ?>
                <div class="regular">$<span class="regular-price"><?php echo $quantity * intval($reg_price) ?></span>
                </div>
              <?php endif; ?>
              <div class="price">$<span class="current-price"><?php echo $price * intval($quantity) ?></span></div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div>
      <div class="cart-page__info">
        <div class="cart-page__shipping">
            <?php get_template_part('template-parts/shipping'); ?>
        </div>
        <div class="mini-cart__total cart-page__total">
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
        <a href="<?php echo wc_get_checkout_url(); ?>" class="cart-page__checkout button blue">Secure checkout</a>
      </div>
      <div class="cart-page__payments">
        <div class="row">
          <span>Secure payment</span><span>Free returns</span><span>Pause Anytime</span>
        </div>
        <div class="icons">
          <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-payments.svg#visa"></use></svg>
          <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-payments.svg#mastercard"></use></svg>
          <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-payments.svg#maestro"></use></svg>
          <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-payments.svg#paypal"></use></svg>
        </div>
      </div>
    </div>
  </div>
</form>