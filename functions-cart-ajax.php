<?php

//add_action( 'wp_footer', 'get_cart_templates' );

add_action( 'wp_ajax_get_cart', 'show_cart_items_html' );
add_action( 'wp_ajax_nopriv_get_cart', 'show_cart_items_html' );

add_action( 'wp_ajax_quanity_update', 'quanity_update' );
add_action( 'wp_ajax_nopriv_quanity_update', 'quanity_update' );

add_action( 'wp_ajax_delete_item', 'delete_cart_item' );
add_action( 'wp_ajax_nopriv_delete_item', 'delete_cart_item' );

add_action( 'wp_ajax_add_to_cart', 'add_to_cart_ajax' );
add_action( 'wp_ajax_nopriv_add_to_cart', 'add_to_cart_ajax' );


/**
 * Show Cart Items HTML
 */
function show_cart_items_html() {
	$items      = WC()->cart->get_cart();
	$cart_count = WC()->cart->cart_contents_count;
	ob_start();
	include get_template_directory() . '/woocommerce/cart/mini_cart_filled.php';
	$output = ob_get_contents();
	ob_end_clean();


	$data['html']  = $output;
	$data['count'] = WC()->cart->cart_contents_count;

	echo json_encode( $data );
	wp_die();
}

/**
 * Delete Cart Item
 */
function delete_cart_item() {
	$key = sanitize_text_field( $_POST['key'] );
	if ( $key ) {
		$cart = WC()->cart;
		$cart->remove_cart_item( $key );
		$data['count']    = WC()->cart->cart_contents_count;
		$data['total']    = WC()->cart->total;
		$data['subtotal'] = WC()->cart->subtotal;
		//echo json_encode($data);
		echo wc_get_template( 'cart/mini-cart.php' );
		wp_die();
	}
}

/**
 * Quanity update
 */
function quanity_update() {
	$key    = sanitize_text_field( $_POST['key'] );
	$number = intval( sanitize_text_field( $_POST['number'] ) );
	$data   = [];
	if ( $key && $number > 0 ) {
		WC()->cart->set_quantity( $key, $number );
		$cart             = WC()->cart;
		$items            = $cart->get_cart();
		$data['count']    = WC()->cart->cart_contents_count;
		$data['total']    = WC()->cart->total;
		$data['subtotal'] = WC()->cart->subtotal;
		$variation_id     = $items[ $key ]['variation_id'];
		if ( ! $variation_id ) {
			$variation_id = $items[ $key ]['product_id'];
		}
		$data['item_total']     = $items[ $key ]['line_total'];
		$data['item_quantity']  = $items[ $key ]['quantity'];
		$data['variation_id']   = $variation_id;
		$data['item_reg_price'] = wc_get_product( $variation_id )->get_regular_price();
		$data['item_price']     = wc_get_product( $variation_id )->get_price();
	}
	echo json_encode( $data );
	wp_die();
}

/**
 * Add To Cart
 */
function add_to_cart_ajax() {
	WC_AJAX::get_refreshed_fragments();
	wp_die();
}

?>