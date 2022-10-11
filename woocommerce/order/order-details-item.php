<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<div class="thankyou__order-row <?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ); ?>">

    <div class="thankyou__order-text woocommerce-table__product-name product-name">
		<?php
		$is_visible        = $product && $product->is_visible();
		$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

		$qty = $item->get_quantity();
		?>
        <a href="<?php echo $product_permalink; ?>" class="mini-cart__img img">
			<?php echo $product->get_image(); ?>
        </a>
        <div class="thankyou__order-info">
            <div class="thankyou__order-name"><?php echo $product->get_title(); ?></div>
            <div class="thankyou__order-addition">
                <span>
                    <?php $plan = str_replace( 'Plan: ', '', $product->attribute_summary ) ?>
                    <?php echo $plan; ?>
                </span>
                <span>(<?php echo $product->get_description() ?>)</span>
            </div>
        </div>

		<?

		do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

		wc_display_item_meta( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
		?>
    </div>

    <div class="thankyou__order-amount"><?php echo $qty; ?></div>

    <div class="thankyou__order-total woocommerce-table__product-total product-total">
        <div class="mini-cart__right-price">
			<?php
			$price     = $product->get_price();
			$reg_price = $product->get_regular_price();
			if ( $price !== $reg_price ): ?>
                <div class="regular">$<span
                            class="regular-price"><?php echo $qty * intval( $reg_price ) ?></span>
                </div>
			<?php endif; ?>
            <div class="price">$<span class="current-price"><?php echo $price * intval( $qty ) ?></span></div>
        </div>
    </div>
	<?php if ( $product->attributes['pa_plan'] === 'subscribe' ): ?>
        <div class="thankyou__order-subscribe">
            <span>Subscribe duration:</span>
            <span class="duration">
                <?php $duration = $product->get_meta( '_number_field' );
                $date           = date( 'Y-m-d' );
                $newDate        = date( 'F j, Y', strtotime( $date . ' + ' . $duration . ' months' ) );
                echo date( "F j, Y" ) . ' — ' . $newDate; ?>
            </span>
        </div>
	<?php endif; ?>

</div>

<?php //if ( $show_purchase_note && $purchase_note ) : ?>
<!---->
<!--<tr class="woocommerce-table__product-purchase-note product-purchase-note">-->
<!---->
<!--	<td colspan="2">--><?php //echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><!--</td>-->
<!---->
<!--</tr>-->
<!---->
<?php //endif; ?>
