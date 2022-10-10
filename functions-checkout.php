<?php

add_filter( 'woocommerce_checkout_fields', 'unset_fields_checkout', 9999 );

function unset_fields_checkout( $checkout_fields ) {

	// and to remove the billing fields below
	unset( $checkout_fields['billing']['billing_company'] );
	unset( $checkout_fields['billing']['billing_address_1'] );
	unset( $checkout_fields['billing']['billing_address_2'] );
	unset( $checkout_fields['billing']['billing_city'] );
	unset( $checkout_fields['billing']['billing_state'] );
	unset( $checkout_fields['billing']['billing_postcode'] );

	unset( $checkout_fields['shipping']['shipping_first_name'] );
	unset( $checkout_fields['shipping']['shipping_last_name'] );
	unset( $checkout_fields['shipping']['shipping_company'] );

	unset( $checkout_fields['order']['order_comments'] );

	return $checkout_fields;
}

add_filter( 'woocommerce_checkout_fields', 'checkout_fields_edit', 9999 );

function checkout_fields_edit( $fields ) {
	unset( $fields['billing']['billing_phone']['required'] );

	$fields['billing']['billing_first_name']['label'] = 'First name';
	$fields['billing']['billing_last_name']['label']  = 'Last name';
	$fields['billing']['billing_phone']['label']      = 'Phone';
	$fields['billing']['billing_email']['label']      = 'Email';

	$fields['billing']['billing_first_name']['class'] = 'first-validation';
	$fields['billing']['billing_last_name']['class']  = 'first-validation';
	$fields['billing']['billing_email']['class']      = 'form-row-wide first-validation';

	$fields['billing']['billing_first_name']['description'] = 'Please, enter your first name';
	$fields['billing']['billing_last_name']['description']  = 'Please, enter your last name';
	$fields['billing']['billing_email']['description']      = 'Please, enter your email';
	$fields['billing']['billing_phone']['description']      = 'Used to contact you with delivery info (mobile preferred)';

	$fields['billing']['billing_first_name']['placeholder'] = 'Enter your first name';
	$fields['billing']['billing_last_name']['placeholder']  = 'Enter your last name';
	$fields['billing']['billing_phone']['placeholder']      = '+1 (000) 000-00000';
	$fields['billing']['billing_email']['placeholder']      = 'example@gmail.com';

	$fields['shipping']['shipping_address_1']['label']       = 'Address';
	$fields['shipping']['shipping_address_1']['placeholder'] = 'Enter your address';

	$fields['shipping']['shipping_address_2']['required'] = true;
	$fields['shipping']['shipping_address_2']['label']       = 'Apartment, suite, etc.';
	$fields['shipping']['shipping_address_2']['placeholder'] = 'Enter your apartment, suite, etc.';

	$fields['shipping']['shipping_city']['placeholder']      = 'Enter your town/city';
	$fields['shipping']['shipping_postcode']['placeholder']  = 'Enter zip code';

	$fields['shipping']['shipping_address_1']['class'] = [ 'second-validation', 'form-row-wide' ];
	$fields['shipping']['shipping_address_2']['class'] = [ 'validate-required', 'second-validation', 'form-row-wide' ];
	$fields['shipping']['shipping_country']['class']   = [
		'form-row-wide',
		'address-field',
		'update_totals_on_change',
		'validate-required',
	];
	$fields['shipping']['shipping_city']['class']      = [ 'form-row-wide', 'second-validation' ];
	$fields['shipping']['shipping_state']['class']     = [
		'address-field',
		'validate-required',
		'validate-state',
		'second-validation'
	];
	$fields['shipping']['shipping_postcode']['class']  = [ 'form-row second-validation' ];

	$fields['shipping']['shipping_address_1']['description'] = 'Please, enter your address';
	$fields['shipping']['shipping_address_2']['description'] = 'Please, enter your apartment, suite, etc.';
	$fields['shipping']['shipping_city']['description']      = 'Please, enter your town/city';
	$fields['shipping']['shipping_postcode']['description']  = 'Please, enter zip code';
	$fields['shipping']['shipping_state']['description']     = 'Please, choose state';



	// the same way you can make any field required, example:
	// $fields[ 'billing' ][ 'billing_company' ][ 'required' ] = true;

	return $fields;
}

// add fields
add_action( 'woocommerce_after_checkout_billing_form', 'subscribe_checkbox' );

// save fields to order meta
add_action( 'woocommerce_checkout_update_order_meta', 'save_what_we_added' );

// checkbox
function subscribe_checkbox( $checkout ) {

	woocommerce_form_field(
		'subscribed',
		array(
			'type'     => 'checkbox',
			'class'    => array( 'checkbox-row' ),
			'label'    => ' Email me with news and offers',
			'required' => true,
		),
		$checkout->get_value( 'subscribed' )
	);

}

// save field values
function save_what_we_added( $order_id ) {
	if ( ! empty( $_POST['subscribed'] ) && 1 === $_POST['subscribed'] ) {
		update_post_meta( $order_id, 'subscribed', 1 );
	}
}

add_filter( 'default_checkout_billing_country', 'change_default_checkout_country_and_state' );
add_filter( 'default_checkout_shipping_country', 'change_default_checkout_country_and_state' );
function change_default_checkout_country_and_state( $default ) {
	return 'US';
}


add_filter( 'gettext', function ( $translated_text, $text, $domain ) {
	if ( $text === 'United States (US)' && $domain === 'woocommerce' ) {
		$translated_text = 'United States';
	}

	return $translated_text;

}, 10, 3 );

add_action( 'woocommerce_init', 'shipping_instance_form_fields_filters' );

function shipping_instance_form_fields_filters() {
	$shipping_methods = WC()->shipping->get_shipping_methods();
	foreach ( $shipping_methods as $shipping_method ) {
		add_filter( 'woocommerce_shipping_instance_form_fields_' . $shipping_method->id, 'shipping_instance_form_add_extra_fields' );
	}
}

function shipping_instance_form_add_extra_fields( $settings ) {
	$settings['shipping_extra_field'] = [
		'title'       => 'Shipping description',
		'type'        => 'text',
		'placeholder' => 'Description',
		'description' => ''
	];

	return $settings;
}

function shipping_instance_custom_desc( $shipping_rate, $index ) {

	if ( is_cart() ) {
		return;
	} // Exit on cart page


	$option_key = 'woocommerce_' . $shipping_rate->method_id . '_' . $shipping_rate->instance_id . '_settings';

	$instance_settings = get_option( $option_key );

	if ( isset( $instance_settings['shipping_extra_field'] ) ) {
		?>
        <div class="shipping-method-desc">
			<?php echo $instance_settings['shipping_extra_field'] ?>
        </div>
		<?php
	}

}

add_action( 'woocommerce_after_shipping_rate', 'shipping_instance_custom_desc', 10, 2 );


add_filter( 'woocommerce_cart_shipping_method_full_label', 'change_cart_shipping_method_full_label', 10, 2 );
function change_cart_shipping_method_full_label( $label, $method ) {
	$has_cost  = 0 < $method->cost;
	$hide_cost = ! $has_cost && in_array( $method->get_method_id(), array( 'free_shipping', 'local_pickup' ), true );

	if ( ! $has_cost ) {
		$label = $method->get_label() . '<div class="price">Free</div>';
	} else {
		$label = $method->get_label() . '<div class="price">' . $method->cost . '$</div>';
	}

	return $label;
}

add_filter( 'woocommerce_checkout_get_value', 'bks_remove_values', 10, 2 );

function bks_remove_values( $value, $input ) {
	$item_to_set_null = array(
		'billing_first_name',
		'billing_last_name',
		'billing_company',
		'billing_address_1',
		'billing_address_2',
		'billing_city',
		'billing_postcode',
		//'billing_country',
		'billing_state',
		'billing_email',
		'billing_phone',
		'shipping_first_name',
		'shipping_last_name',
		'shipping_company',
		'shipping_address_1',
		'shipping_address_2',
		'shipping_city',
		'shipping_postcode',
		//'shipping_country',
		'shipping_state',
	); // All the fields in this array will be set as empty string, add or remove as required.

	if ( in_array( $input, $item_to_set_null ) ) {
		$value = '';
	}

	return $value;
}

add_filter( 'woocommerce_form_field', 'elex_remove_checkout_optional_text', 10, 4 );
function elex_remove_checkout_optional_text( $field, $key, $args, $value ) {
	if ( is_checkout() && ! is_wc_endpoint_url() ) {
		$optional = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
		$field    = str_replace( $optional, '&nbsp;<span class="optional">' . esc_html__( 'Optional', 'woocommerce' ) . '</span>', $field );
	}

	return $field;
}
