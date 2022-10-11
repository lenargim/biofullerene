<?php
$cart_count = WC()->cart->cart_contents_count;
$items      = WC()->cart->get_cart();
$cart_total = WC()->cart->get_cart_total();
?>

    <div class="mini-cart__title">
        <span><span class="count"><?php echo $cart_count; ?></span> items in your cart</span>
        <div class="close">
            <svg>
                <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#close"></use>
            </svg>
        </div>
    </div>
<?php $cart = WC()->cart ?>
<?php if ( ! $cart->is_empty() ) : ?>
	<?php include get_template_directory() . '/woocommerce/cart/mini_cart_filled.php'; ?>
<?php else: ?>
	<?php include get_template_directory() . '/woocommerce/cart/mini_cart_empty.php'; ?>
<?php endif; ?>