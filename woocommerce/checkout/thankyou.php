<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<?php get_template_part( 'template-parts/header/header-empty' ); ?>

    <div class="woocommerce-order thankyou">

		<?php
		if ( $order ) :

			do_action( 'woocommerce_before_thankyou', $order->get_id() );
			?>

			<?php if ( $order->has_status( 'failed' ) ) : ?>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>"
                   class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"
                       class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
            </p>

		<?php else : ?>

            <div class="container">

                <div class="single-post__breadcrumbs breadcrumbs">
                    <a href="/" class="home">
			            <?php if ( ! wp_is_mobile() ): ?>
                            Home
			            <?php else: ?>
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 4.5L2 3.87092M2 3.87092L5.58258 1.61718C5.83095 1.46094 6.16905 1.46094 6.41742 1.61718L10 3.87092M2 3.87092V9.95759C2 10.2572 2.23878 10.5 2.53333 10.5H9.46667C9.76122 10.5 10 10.2572 10 9.95759V3.87092M10 3.87092L11 4.5"
                                      stroke="#657181" stroke-width="1.2" stroke-linecap="round"/>
                            </svg>
			            <?php endif; ?>
                    </a>
                    <svg class="separator" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 15L12.5 10L7.5 5" stroke-width="1.6" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    <span>Thanks for your order</span>
                </div>
                <h1>Thanks for your order!</h1>
                <div class="thankyou__desc">
                    <div class="number"><span>Your order number is:</span><button class="copy-text"><?php echo $order->get_order_number(); ?></button></div>
                    <div class="mail-confirfation">We’ll email your order confirmation to <?php echo $order->get_billing_email(); ?></div>
                </div>
                <a href="#" class="thankyou__help button white open-modal-help">Need help?</a>
            </div>

		<?php endif; ?>
			<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

		<?php else : ?>

            <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

		<?php endif; ?>

        <div class="not-find block">
            <div class="container">
                <div class="not-find__wrap">
                    <a href="<?php echo get_permalink( get_page_by_path( 'shipping' ) ); ?>" class="not-find__item">
                        <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-found.svg#shipping"></use></svg>
                        <div class="not-find__name">Shipping</div>
                    </a>
                    <a href="<?php echo get_page_link(327); ?>" class="not-find__item">
                        <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-found.svg#billing"></use></svg>
                        <div class="not-find__name">Terms and Service</div>
                    </a>
                    <a href="<?php echo get_page_link(65) ?>" class="not-find__item">
                        <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-found.svg#return"></use></svg>
                        <div class="not-find__name">Return Policy</div>
                    </a>
                    <a href="<?php echo get_post_type_archive_link('faq') ?>" class="not-find__item">
                        <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-found.svg#message"></use></svg>
                        <div class="not-find__name">FAQ</div>
                    </a>
                </div>
            </div>
        </div>

	    <?php get_template_part( 'template-parts/faq' ); ?>
    </div>

<?php get_template_part( 'template-parts/footer/footer' ); ?>