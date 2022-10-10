<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout"
      action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <div class="container">
        <a href="<?php echo wc_get_cart_url(); ?>" class="checkout__back">
            <svg>
                <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
            </svg>
            <span>Back to cart</span>
        </a>
        <div class="checkout__wrap">
            <div class="checkout__main" id="customer_details">
				<?php if ( $checkout->get_checkout_fields() ) : ?>
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
					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                    <div class="col2-set" id="customer_details">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>

						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
                    </div>
                    <div class="method-part checkout-part">
                        <h2>Shipping method</h2>
                        <div class="checkout__method">
							<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
<?php WC()->cart->calculate_totals(); ?>
							<?php wc_cart_totals_shipping_html(); ?>

							<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
                        </div>
                        <div class="checkout__last-row">
                            <button type="button" class="back open-shipping-part">
                                <svg>
                                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                                </svg>
                                <span>Return to shipping</span>
                            </button>
							<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

							<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button blue alt" name="woocommerce_checkout_place_order" id="place_order" value="Continue to payment" data-value="Continue to payment">Continue to payment</button>' ); // @codingStandardsIgnoreLine ?>

							<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

                        </div>
                    </div>

					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<?php endif; ?>
            </div>
            <div class="checkout__data">

				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>
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

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            </div>
        </div>
    </div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
