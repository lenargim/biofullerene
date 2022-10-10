<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">

    <div class="contacts-part checkout-part">
        <h2>Contact information</h2>
		<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>
        <div class="checkout__field-wrapper">
			<?php
			$fields = $checkout->get_checkout_fields( 'billing' );
			foreach ( $fields as $key => $field ) {
				woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
			}
			?>
        </div>
		<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
        <div class="checkout__last-row">
            <a href="<?php echo wc_get_cart_url(); ?>" class="back">
                <svg>
                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                </svg>
                <span>Return to cart</span>
            </a>
            <button class="button blue next open-shipping-part" type="button">Continue to shipping
                address
            </button>
        </div>
    </div>
</div>

