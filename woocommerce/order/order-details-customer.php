<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.6.0
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details">
    <div class="container">
        <div class="order__details">
            <div class="order__details-item order__details-shipping">
                <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M55.7209 6.50918C73.3361 16.7505 76.3819 34.3333 66.1845 52.1196C55.9871 69.9059 38.059 77.6687 20.4438 67.4274C2.82866 57.1861 -5.84412 32.9405 4.35329 15.1543C14.5507 -2.63201 38.1057 -3.73211 55.7209 6.50918Z"
                          fill="#F5F9FF"/>
                    <path d="M40 39.9999V26.9999H25V39.9999H40ZM40 39.9999H47V34.9999L44 31.9999H40V39.9999ZM32 42.4999C32 43.8806 30.8807 44.9999 29.5 44.9999C28.1193 44.9999 27 43.8806 27 42.4999C27 41.1192 28.1193 39.9999 29.5 39.9999C30.8807 39.9999 32 41.1192 32 42.4999ZM45 42.4999C45 43.8806 43.8807 44.9999 42.5 44.9999C41.1193 44.9999 40 43.8806 40 42.4999C40 41.1192 41.1193 39.9999 42.5 39.9999C43.8807 39.9999 45 41.1192 45 42.4999Z"
                          stroke="#0059D6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="order__details-title">Shipping to</div>
                <div class="order__details-desc">
					<?php echo $order->get_shipping_address_1(); ?>
					<?php echo $order->get_shipping_address_2(); ?>
                    <br>
					<?php echo $order->get_shipping_city(); ?>
					<?php echo $order->get_shipping_state(); ?>
					<?php echo $order->get_shipping_postcode(); ?>
                    <br>
					<?php echo $order->get_shipping_country(); ?>
                </div>
            </div>
            <div class="order__details-item order__details-arrival">
                <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M55.7209 6.50918C73.3361 16.7505 76.3819 34.3333 66.1845 52.1196C55.9871 69.9059 38.059 77.6687 20.4438 67.4274C2.82866 57.1861 -5.84412 32.9405 4.35329 15.1543C14.5507 -2.63201 38.1057 -3.73211 55.7209 6.50918Z"
                          fill="#F5F9FF"/>
                    <path d="M36 29.9999V35.9999L40 37.9999M46 35.9999C46 41.5227 41.5228 45.9999 36 45.9999C30.4772 45.9999 26 41.5227 26 35.9999C26 30.477 30.4772 25.9999 36 25.9999C41.5228 25.9999 46 30.477 46 35.9999Z"
                          stroke="#0059D6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="order__details-title">Estimated arrival</div>
                <div class="order__details-desc">Estimated arrival</div>
            </div>
        </div>
    </div>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</section>
