<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table info">

    <div class="info__list">
		<?php $cart = WC()->cart; ?>
		<?php foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
			$product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $product && $product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>

                <div class="info__item">
                    <div class="info__item-img">
						<?php echo $product->get_image( 'woocommerce_gallery_thumbnail' ); ?>
                        <div class="count">
							<?php echo $cart_item['quantity']; ?></div>
                    </div>
                    <div class="info__item-text">
                        <div class="info__item-name">
							<?php echo $product->get_title(); ?></div>
                        <div class="info__item-desc">
							<?php echo $product->get_description() ?>
                        </div>
                    </div>
                    <div class="info__item-price">
						<?php
						$quantity  = $cart_item['quantity'];
						$price     = $product->get_price();
						$reg_price = $product->get_regular_price();
						if ( $price !== $reg_price ): ?>
                            <div class="regular">$<span
                                        class="regular-price">
		    <?php echo $quantity * intval( $reg_price ) ?></span>
                            </div>
						<?php endif; ?>
                        <div class="price">$<span
                                    class="current-price">
		    <?php echo $price * intval( $quantity ) ?></span>
                        </div>
                    </div>
                </div>
				<?php
			}
		}
		?>
    </div>

    <div class="mini-cart__total cart-page__total">
        <div class="mini-cart__total-row">
            <span>Subtotal:</span><span>$<span
                        class="subtotal">
	<?php echo $cart->subtotal; ?></span> </span>
        </div>
        <div class="mini-cart__total-row">
            <span>Shipping:</span><span>$
	<?php echo $cart->get_shipping_total(); ?></span>
        </div>
        <div class="mini-cart__total-row">
            <span>Discount:</span><span
                    class="discount">-$
	<?php echo $cart->get_discount_total(); ?></span>
        </div>
        <div class="mini-cart__total-row mini-cart__total-all">
            <span>Total:</span><span>$<span class="total">
	<?php echo $cart->total; ?></span></span>
        </div>
    </div>

</div>