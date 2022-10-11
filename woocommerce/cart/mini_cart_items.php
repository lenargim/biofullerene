<?php $items = WC()->cart->get_cart(); ?>
<?php foreach ($items as $item => $values) :
  $product = wc_get_product($values['data']->get_id());
  $product_link = get_permalink($values['data']->get_id());
  $variations = wc_get_formatted_cart_item_data($values, true);
  ?>
  <div class="woo_amc_item mini-cart__item woo_amc_item_wrap" data-id="<?php echo $product->get_id() ?>">
    <div class="mini-cart__left">
      <a href="<?php echo $product_link; ?>" class="woo_amc_item_img mini-cart__img img">
	      <?php echo $product->get_image('woocommerce_gallery_thumbnail'); ?>
      </a>
      <div class="mini-cart__text">
        <div class="mini-cart__name"><?php echo $product->get_title(); ?></div>

        <div class="mini-cart__desc">
          <?php echo $product->get_description() ?>
        </div>
        <div class="mini-cart__quantity-wrap woo_amc_item_quanity_wrap">
          <div class="mini-cart__update minus <?php if ($values['quantity'] === 1) echo ' disabled' ?>"
               data-type="minus">
            <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
              <path d="M3.33301 8H12.6663" stroke-width="1.6" stroke-linecap="round"
                    stroke-linejoin="round"/>
            </svg>
          </div>
          <input data-key="<?php echo $item; ?>" type="text" readonly
                 class="quanity mini-cart__quantity "
                 value="<?php echo $values['quantity']; ?>">
          <div class="mini-cart__update" data-type="plus">
            <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
              <path d="M7.99967 3.33334V12.6667M3.33301 8.00001H12.6663" stroke-width="1.6"
                    stroke-linecap="round" stroke-linejoin="round"/>
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
        $price = $product->get_price();
        $reg_price = $product->get_regular_price();
        if ($price !== $reg_price): ?>
          <div class="regular">$<span class="regular-price"><?php echo $quantity * intval($reg_price) ?></span></div>
        <?php endif; ?>
        <div class="price">$<span class="current-price"><?php echo $price * intval($quantity) ?></span></div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
