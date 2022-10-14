<?php




add_action( 'woocommerce_after_checkout_billing_form', 'my_custom_checkout_field' );

function my_custom_checkout_field( $checkout ) {

	woocommerce_form_field( 'send_emails', array(
		'type'        => 'checkbox',
		'class'       => array( 'checkbox-row' ),
		'label'       => ' Email me with news and offers',
		'required'    => true,
        'priority' => 120
	), $checkout->get_value( 'send_emails' ) );
}

add_action( 'woocommerce_checkout_update_order_meta', 'bbloomer_save_new_checkout_field' );

function bbloomer_save_new_checkout_field( $order_id ) {
	if ( $_POST['send_emails'] ) update_post_meta( $order_id, '_send_emails', esc_attr( $_POST['send_emails'] ) );
}

//add_action( 'woocommerce_thankyou', 'bbloomer_show_new_checkout_field_thankyou' );
//
//function bbloomer_show_new_checkout_field_thankyou( $order_id ) {
//	if ( get_post_meta( $order_id, '_send_emails', true ) ) echo '<p><strong>License Number:</strong> ' . get_post_meta( $order_id, '_send_emails', true ) . '</p>';
//}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'bbloomer_show_new_checkout_field_order' );

function bbloomer_show_new_checkout_field_order( $order ) {
	$order_id = $order->get_id();
    echo '<p><strong>Send emails:</strong> ';
    if (get_post_meta( $order_id, '_send_emails', true ) ) {
        echo 'yes';
    } else {
        echo 'no';
    }
}

add_action( 'woocommerce_email_after_order_table', 'bbloomer_show_new_checkout_field_emails', 20, 4 );

function bbloomer_show_new_checkout_field_emails( $order, $sent_to_admin, $plain_text, $email ) {
	$order_id = $order->get_id();
	echo '<p><strong>Send emails:</strong> ';
	if (get_post_meta( $order_id, '_send_emails', true ) ) {
		echo 'yes';
	} else {
		echo 'no';
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


add_filter( 'woocommerce_checkout_fields', 'checkout_fields_edit', 9999 );

function checkout_fields_edit( $fields ) {
	// and to remove the billing fields below
	unset( $fields['billing']['billing_company'] );
	unset( $fields['billing']['billing_address_1'] );
	unset( $fields['billing']['billing_address_2'] );
	unset( $fields['billing']['billing_city'] );
	unset( $fields['billing']['billing_state'] );
	unset( $fields['billing']['billing_postcode'] );

	unset( $fields['shipping']['shipping_first_name'] );
	unset( $fields['shipping']['shipping_last_name'] );
	unset( $fields['shipping']['shipping_company'] );

	unset( $fields['order']['order_comments'] );
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

//	$fields['shipping']['shipping_address_1']['label']       = 'Address';
//	$fields['shipping']['shipping_address_1']['placeholder'] = 'Enter your address';
//
//	$fields['shipping']['shipping_address_2']['label']       = 'Apartment, suite, etc.';
//	$fields['shipping']['shipping_address_2']['placeholder'] = 'Enter your apartment, suite, etc.';
//
//	$fields['shipping']['shipping_city']['placeholder']      = 'Enter your town/city';
//	$fields['shipping']['shipping_postcode']['placeholder']  = 'Enter zip code';
//
//	$fields['shipping']['shipping_address_1']['class'] = [ 'second-validation' ];
//	$fields['shipping']['shipping_address_2']['class'] = [ 'validate-required', 'second-validation', 'form-row-wide' ];
//	$fields['shipping']['shipping_country']['class']   = [ 'form-row-wide', 'address-field', 'update_totals_on_change', 'validate-required'];
//	$fields['shipping']['shipping_city']['class']      = [ 'form-row-wide', 'second-validation' ];
//	$fields['shipping']['shipping_state']['class']     = [ 'address-field', 'validate-required', 'validate-state', 'second-validation' ];
//	$fields['shipping']['shipping_postcode']['class']  = [ 'form-row', 'second-validation' ];
//
//	$fields['shipping']['shipping_address_1']['description'] = 'Please, enter your address';
//	$fields['shipping']['shipping_address_2']['description'] = 'Please, enter your apartment, suite, etc.';
//	$fields['shipping']['shipping_city']['description']      = 'Please, enter your town/city';
//	$fields['shipping']['shipping_postcode']['description']  = 'Please, enter zip code';
//	$fields['shipping']['shipping_state']['description']     = 'Please, choose state';
//
//	$fields['shipping']['shipping_address_2']['required'] = true;

	return $fields;
}

add_filter( 'woocommerce_default_address_fields', 'custom_woocommerce_default_address_fields', 9999 );
function custom_woocommerce_default_address_fields( $fields ) {
	$fields['state']['class'][0]     = 'form-row-first';
	$fields['postcode']['class'][0]  = 'form-row-last';
	$fields['state']['class'][1]     = 'second-validation';
	$fields['postcode']['class'][1]  = 'second-validation';
	$fields['address_1']['class'][0] = 'second-validation';
	$fields['address_2']['class'][0] = 'second-validation';
	$fields['city']['class'][0]      = 'second-validation';
	$fields['city']['class'][1]      = 'form-row-wide';
	$fields['address_1']['class'][1] = 'form-row-wide';
	$fields['address_2']['class'][1] = 'form-row-wide';


	$fields['address_1']['label']       = 'Address';
	$fields['address_2']['label']       = 'Apartment, suite, etc.';
	$fields['address_2']['label_class'] = [ '' ];
	$fields['address_1']['placeholder'] = 'Enter your address';
	$fields['address_2']['placeholder'] = 'Enter your apartment, suite, etc.';
	$fields['postcode']['placeholder']  = 'Enter zip code';
	$fields['address_1']['description'] = 'Please, enter your address';
	$fields['city']['description']      = 'Please, enter your town/city';
	$fields['address_2']['description'] = 'Please, enter your apartment, suite, etc.';
	$fields['state']['description']     = 'Please, choose state';
	$fields['postcode']['description']  = 'Please, enter zip code';

	$fields['address_2']['required'] = true;

	return $fields;
}

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );