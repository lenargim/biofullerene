<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array(
	'completed',
	'processing'
) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id(); ?>
    <div class="container">
        <section class="woocommerce-order-details thankyou__order">
			<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

            <h2 class="woocommerce-order-details__title thankyou__order-title">Order summary</h2>

            <div class="thankyou__order-table woocommerce-table woocommerce-table--order-details shop_table order_details">

				<?php
				do_action( 'woocommerce_order_details_before_order_table_items', $order );

				foreach ( $order_items as $item_id => $item ) {
					$product = $item->get_product();

					wc_get_template(
						'order/order-details-item.php',
						array(
							'order'              => $order,
							'item_id'            => $item_id,
							'item'               => $item,
							'show_purchase_note' => $show_purchase_note,
							'purchase_note'      => $product ? $product->get_purchase_note() : '',
							'product'            => $product,
						)
					);
				}
				do_action( 'woocommerce_order_details_after_order_table_items', $order );
				?>
                <div class="thankyou__order-after">
                    <div class="thankyou__order-after-item thankyou__order-subtotal">
                        <span>Subtotal:</span>
                        <span><?php echo get_woocommerce_currency_symbol();?><?php echo $order->get_subtotal(); ?></span>
                    </div>
                    <div class="thankyou__order-after-item thankyou__order-shipping">
                        <span>Shipping:</span>
                        <span><?php echo get_woocommerce_currency_symbol();?><?php echo $order->get_shipping_total(); ?></span>
                    </div>
                    <div class="thankyou__order-after-item thankyou__order-discount">
                        <span>Discount:</span>
                        <span>-<?php echo get_woocommerce_currency_symbol();?><?php echo $order->get_discount_total(); ?></span>
                    </div>
                </div>
                <div class="thankyou__total thankyou__order-after-item">
                    <span>Total:</span>
                    <span><?php echo get_woocommerce_currency_symbol();?><?php echo $order->get_total(); ?></div></span>

            </div>

			<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
        </section>
    </div>
<?php
/**
 * Action hook fired after the order details.
 *
 * @param WC_Order $order Order data.
 *
 * @since 4.4.0
 */
do_action( 'woocommerce_after_order_details', $order );

if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}
