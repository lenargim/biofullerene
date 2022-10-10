<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/1form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$checkout = WC()->checkout();

do_action( 'woocommerce_before_checkout_form', $checkout );

?>

    <form name="checkout" method="post" class="checkout woocommerce-checkout"
          action="<?php echo esc_url( wc_get_checkout_url() ); ?>"
          enctype="multipart/form-data">
        <div class="container">
            <a href="<?php echo wc_get_cart_url(); ?>" class="checkout__back">
                <svg>
                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                </svg>
                <span>Back to cart</span>
            </a>
            <div class="checkout__wrap">
                <div class="checkout__main" id="customer_details">
                    <h1>Checkout</h1>
                    <div class="checkout__breadcrumbs">
      <span class="active">Contacts
      <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-checkout.svg#arrow"></use></svg>
      </span><span>Shipping address
      <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-checkout.svg#arrow"></use></svg>
      </span>
                        <span>Shipping method
      <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-checkout.svg#arrow"></use></svg>
      </span>
                        <span>Payment</span>
                    </div>
                    <div class="saved-part checkout-part">
                        <div class="saved">
                            <div class="saved__box">
                                <div class="saved__box-title">
                                    <span>Contact information</span>
                                    <div class="edit open-contacts-part">Edit</div>
                                </div>
                                <div class="saved__box-info saved__box-table">
                                    <div>Name:</div>
                                    <div class="saved-name"></div>
                                    <div>Email:</div>
                                    <div class="saved-email"></div>
                                    <div>Phone:</div>
                                    <div class="saved-phone"></div>
                                </div>
                            </div>
                            <div class="saved__box">
                                <div class="saved__box-title">
                                    <span>Shipping address</span>
                                    <div class="edit open-shipping-part">Edit</div>
                                </div>
                                <div class="saved__box-info saved__box-row">

                                </div>
                            </div>
                        </div>
                    </div>
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
                    <div class="shipping-part checkout-part">
                        <h2>Shipping address</h2>
                        <h3 id="ship-to-different-address" class="hidden">
                            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                <input id="ship-to-different-address-checkbox"
                                       class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?>
                                       type="checkbox" name="ship_to_different_address" value="1"/>
                                <span><?php esc_html_e( 'Ship to a different address?', 'woocommerce' ); ?></span>
                            </label>
                        </h3>
						<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>
                        <div class="checkout__field-wrapper">
							<?php
							$fields = $checkout->get_checkout_fields( 'shipping' );
							foreach ( $fields as $key => $field ) {
								woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
							}
							?>
                        </div>
						<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>
                        <div class="checkout__last-row">
                            <button type="button" class="back open-contacts-part">
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                                </svg>
                                <span>Return to information</span>
                            </button>
                            <button class="button blue next open-method-part" type="button">Continue to shipping method
                            </button>
                        </div>
                    </div>
                    <div class="method-part checkout-part">
                        <h2>Shipping method</h2>
                        <div class="checkout__method">
							<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

							<?php wc_cart_totals_shipping_html(); ?>

							<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
                        </div>
                        <div class="checkout__last-row">
                            <button class="back open-shipping-part">
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                                </svg>
                                <span>Return to shipping</span>
                            </button>
                            <button class="button blue next" type="submit">Continue to payment</button>
                        </div>
                    </div>
                </div>
                <div class="checkout__data">
					<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                    <div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
                        <div class="cart-page__payments">
                            <div class="row">
                                <span>Secure payment</span><span>Free returns</span><span>Money back guarantee</span>
                            </div>
                            <div class="icons">
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-payments.svg#visa"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-payments.svg#mastercard"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-payments.svg#maestro"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-payments.svg#paypal"></use>
                                </svg>
                            </div>
                        </div>
                    </div>

					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                </div>
            </div>
        </div>
    </form>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>