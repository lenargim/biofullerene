<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_scripts', 9999 );
add_action( 'wp_head', 'my_theme_enqueue_scripts', 9999 );
function my_theme_enqueue_scripts() {
	//wp_dequeue_style( 'twenty-twenty-one-style' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/style.css', array(), filemtime( get_template_directory() . '/style.css' ), false );
	//wp_enqueue_style('main-styles', get_template_directory_uri() . '/style.css');

	wp_enqueue_script( 'main-scripts', get_template_directory_uri() . '/main.min.js', array( 'jquery' ) );
	wp_localize_script( 'cart', 'ajaxVar', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'cart', get_template_directory_uri() . '/assets/js/cart.js', array( 'jquery' ) );
	if ( is_checkout() ) {
		wp_enqueue_script( 'checkout-scripts', get_template_directory_uri() . '/assets/js/checkout.js', array( 'jquery' ) );
	}

	// AJAX
	wp_register_script( 'true_loadmore', get_stylesheet_directory_uri() . '/assets/js/loadmore.js', array( 'jquery' ) );
	wp_localize_script( 'true_loadmore', 'ajaxVar', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'true_loadmore' );
	wp_enqueue_script( 'select_scripts', get_template_directory_uri() . '/assets/js/select.js', array(
		'jquery',
		'true_loadmore'
	) );

	wp_enqueue_script( 'research', get_stylesheet_directory_uri() . '/assets/js/research.js', array( 'jquery' ) );

	if (
		is_page_template( 'home.php' )
		|| is_singular()
		|| is_product()
		|| is_page_template( 'company.php' )
	) {
		wp_enqueue_style( 'swiper-styles', 'https://unpkg.com/swiper@8/swiper-bundle.min.css' );
		wp_enqueue_script( 'swiper-lib', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'swiper-script', get_template_directory_uri() . '/assets/js/swiper.js', array( 'swiper-lib' ) );
	}

}

add_action( 'wp_default_scripts', function ( $scripts ) {
	if ( ! empty( $scripts->registered['jquery'] ) ) {
		$scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, [ 'jquery-migrate' ] );
	}
} );

add_action( 'admin_menu', 'remove_menus' );
function remove_menus() {
	//remove_menu_page('index.php');                # Консоль
	//remove_menu_page('edit.php');                 # Записи
	//remove_menu_page('edit-comments.php');        # Комментарии
	//remove_menu_page('edit.php?post_type=page');  # Страницы
	//remove_menu_page('upload.php');               # Медиафайлы
	//remove_menu_page('themes.php');               # Внешний вид
	//remove_menu_page('plugins.php');              # Плагины
	//remove_menu_page('users.php');                # Пользователи
	remove_menu_page( 'tools.php' );                # Инструменты
	//remove_menu_page('options-general.php');      # Настройки
	//remove_menu_page('edit.php?post_type=acf-field-group'); # ACF
}


add_action( 'init', 'custom_posts' );
function custom_posts() {
	register_post_type( 'faq', array(
		'labels'             => array(
			'name'               => 'Frequently asked questions', // Основное название типа записи
			'singular_name'      => 'faq', // отдельное название записи типа Book
			'add_new'            => 'Add question',
			'add_new_item'       => 'Add new question',
			'edit_item'          => 'Edit question',
			'new_item'           => 'New question',
			'view_item'          => 'View question',
			'search_items'       => 'Search questions',
			'not_found'          => 'questions not found',
			'not_found_in_trash' => 'not_found_in_trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'FAQ'

		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-list-view',
		'supports'           => array( 'title', 'editor' )
	) );

	register_post_type( 'contacts', array(
		'labels'             => array(
			'name'               => 'Contacts', // Основное название типа записи
			'singular_name'      => 'contact', // отдельное название записи типа Book
			'add_new'            => 'Add contact',
			'add_new_item'       => 'Add new contact',
			'edit_item'          => 'Edit contact',
			'new_item'           => 'New contact',
			'view_item'          => 'View contact',
			'search_items'       => 'Search contacts',
			'not_found'          => 'contacts not found',
			'not_found_in_trash' => 'No contacts',
			'parent_item_colon'  => '',
			'menu_name'          => 'Contacts'

		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-admin-site',
		'supports'           => array( 'title', 'thumbnail' )
	) );

	register_post_type( 'experts', array(
		'labels'             => array(
			'name'               => 'Experts', // Основное название типа записи
			'singular_name'      => 'expert', // отдельное название записи типа Book
			'add_new'            => 'Add expert',
			'add_new_item'       => 'Add new expert',
			'edit_item'          => 'Edit expert',
			'new_item'           => 'New expert',
			'view_item'          => 'View expert',
			'search_items'       => 'Search expert',
			'not_found'          => 'experts not found',
			'not_found_in_trash' => 'No expert',
			'parent_item_colon'  => '',
			'menu_name'          => 'Experts'

		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-admin-users',
		'supports'           => array( 'title', 'thumbnail', 'editor' )
	) );
}

function my_nav_menu_submenu_css_class( $classes ) {
	$classes[] = 'submenu container container_big';

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'my_nav_menu_submenu_css_class' );

add_action( 'init', function () {
	if ( ! isset( $_COOKIE['shipping_popup'] ) ) {
		setcookie( 'shipping_popup', 'open' );
	}
} );

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'research_thumbnail', 384, 240 );
	add_image_size( 'about-slider', 592, 420 );
}

add_theme_support( 'woocommerce', array(
	'thumbnail_image_width'         => 420,
	'gallery_thumbnail_image_width' => 68,
	'single_image_width'            => 552,
) );


add_filter( 'woocommerce_enqueue_styles', '__return_false' );

add_filter( 'private_title_format', 'true_no_private_title_format' );

function true_no_private_title_format( $format ) {
	return '%s';
}


add_filter( 'woocommerce_get_breadcrumb', 'custom_breadcrumb', 20, 2 );
function custom_breadcrumb( $crumbs, $breadcrumb ) {

	// only on the single product page
	if ( ! is_product() ) {
		return $crumbs;
	}

	// gets the first element of the array "$crumbs"
	$new_crumbs[] = reset( $crumbs );
	// gets the last element of the array "$crumbs"
	$new_crumbs[] = end( $crumbs );

	return $new_crumbs;
}

add_action( 'after_setup_theme', 'yourtheme_setup' );

function yourtheme_setup() {
	remove_theme_support( 'wc-product-gallery-zoom' );
	remove_theme_support( 'wc-product-gallery-lightbox' );
}

class WPSE_78121_Sublevel_Walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<div class='submenu-wrap container container_big'><ul class='submenu'>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul></div>\n";
	}
}


// Add Variation Settings
add_action( 'woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3 );

// Save Variation Settings
add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );

// Create new fields for variations
function variation_settings_fields( $loop, $variation_data, $variation ) {
	// Text Field
	woocommerce_wp_text_input(
		array(
			'id'          => '_text_field[' . $variation->ID . ']',
			'label'       => __( 'Type', 'woocommerce' ),
			'placeholder' => 'Example: 3 month supply',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the custom value here.', 'woocommerce' ),
			'value'       => get_post_meta( $variation->ID, '_text_field', true )
		)
	);

	woocommerce_wp_text_input(
		array(
			'id'          => '_number_field[' . $variation->ID . ']',
			'label'       => __( 'Duration (month)', 'woocommerce' ),
			'placeholder' => '12',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the custom value here.', 'woocommerce' ),
			'value'       => get_post_meta( $variation->ID, '_number_field', true )
		)
	);
}

// Save new fields for variations
function save_variation_settings_fields( $post_id ) {
	// Text Field
	$text_field = $_POST['_text_field'][ $post_id ];
	if ( ! empty( $text_field ) ) {
		update_post_meta( $post_id, '_text_field', esc_attr( $text_field ) );
	}

	$number_field = $_POST['_number_field'][ $post_id ];
	if ( ! empty( $number_field ) ) {
		update_post_meta( $post_id, '_number_field', esc_attr( $number_field ) );
	}
}

add_filter( 'woocommerce_available_variation', 'load_variation_settings_fields' );

// Add custom fields for variations
function load_variation_settings_fields( $variations ) {
	// duplicate the line for each field
	$variations['text_field']   = get_post_meta( $variations['variation_id'], '_text_field', true );
	$variations['number_field'] = get_post_meta( $variations['variation_id'], '_number_field', true );

	return $variations;
}


add_filter( 'acf_archive_post_types', 'change_acf_archive_cpt' );
function change_acf_archive_cpt( $cpts ) {
	// 'book' and 'movie' are the cpt key.

	// Remove cpt
	unset( $cpts['faq'] );
	unset( $cpts['contacts'] );
	unset( $cpts['product'] );

	// Add cpt
	$cpts['experts'];

	return $cpts;
}


add_action( 'wp_ajax_loadmore', 'actions_loadmore' );
add_action( 'wp_ajax_nopriv_loadmore', 'actions_loadmore' );

function actions_loadmore() {
	$offset     = $_POST['offset'];
	$product_id = $_POST['product_id'];
	$order      = $_POST['order'];
	$sort       = $_POST['sort'];


	$args = [
		'post_type' => 'product',
		'number'    => 4,
		'offset'    => $offset+1,
		'post_id'   => $product_id,
		'status '   => 'approve',
		'order'     => $sort,
		'orderby'   => $order,
	];
	if ( $order = 'rating' ) {
		$args['meta_key'] = 'rating';
	}

	$comments = get_comments( $args );
	wp_list_comments( array( 'callback' => 'woocommerce_comments' ), $comments );
	die();
}

add_action( 'wp_ajax_load_research', 'actions_load_research' );
add_action( 'wp_ajax_nopriv_load_research', 'actions_load_research' );

function actions_load_research() {
	global $post;
	$args = [
		'post_type'      => 'post',
		'numberposts'    => - 1,
		'posts_per_page' => - 1,
		'order'          => 'ASC'
	];

	$posts = get_posts( $args );
	foreach ( $posts as $post ):
		setup_postdata( $post ); ?>
        <div class="research__item">
            <a href="<?php echo get_post_permalink(); ?>" class="research__item-img img">
                <img src="<?php the_post_thumbnail_url( 'research_thumbnail' ) ?>"
                     alt="<?php the_title() ?>">
            </a>
			<?php $tags = get_the_tags(); ?>
			<?php if ( $tags ) : ?>
                <div class="research__item-taglist">
					<?php foreach ( $tags as $tag ): ?>
                        <span class="research__item-tag"><?php echo $tag->name ?></span>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>
            <a href="<?php echo get_post_permalink(); ?>"
               class="research__item-title"><?php the_title() ?></a>
        </div>
	<?php endforeach;
	wp_reset_postdata();
	die();
}

add_action( 'wp_ajax_tag_filter', 'filter_research_articles_by_tag' );
add_action( 'wp_ajax_nopriv_tag_filter', 'filter_research_articles_by_tag' );

function filter_research_articles_by_tag() {
	global $post;
	$slug = $_POST['slug'];
	$args = [
		'post_type'      => 'post',
		'numberposts'    => - 1,
		'posts_per_page' => - 1,
		'order'          => 'ASC',
		'tag'            => $slug
	];

	$posts = get_posts( $args );
	foreach ( $posts as $post ):
		setup_postdata( $post ); ?>
        <div class="research__item">
            <a href="<?php echo get_post_permalink(); ?>" class="research__item-img img">
                <img src="<?php the_post_thumbnail_url( 'research_thumbnail' ) ?>"
                     alt="<?php the_title() ?>">
            </a>
			<?php $tags = get_the_tags(); ?>
			<?php if ( $tags ) : ?>
                <div class="research__item-taglist">
					<?php foreach ( $tags as $tag ): ?>
                        <span class="research__item-tag"><?php echo $tag->name ?></span>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>
            <a href="<?php echo get_post_permalink(); ?>"
               class="research__item-title"><?php the_title() ?></a>
        </div>
	<?php endforeach;
	wp_reset_postdata();
	die();
}


add_action( 'wp_ajax_sort', 'review_sort' );
add_action( 'wp_ajax_nopriv_sort', 'review_sort' );

function review_sort() {
	$product_id = $_POST['product_id'];
	$order      = $_POST['order'];
	$sort       = $_POST['sort'];

	$args = [
		'post_type' => 'product',
		'number'    => 4,
		'post_id'   => $product_id,
		'status'   => 'approve',
		'order'     => $sort,
		'orderby'   => $order,
	];
	if ( $order = 'rating' ) {
		$args['meta_key'] = 'rating';
	}
	$comments = get_comments( $args );
	wp_list_comments( array( 'callback' => 'woocommerce_comments' ), $comments );
	die();
}


add_action( 'wp_ajax_modal_reviews', 'open_modal_reviews' );
add_action( 'wp_ajax_nopriv_modal_reviews', 'open_modal_reviews' );

function open_modal_reviews() {
	$id = $_POST['id'];

	$args     = [
		'status'    => 'approve',
		'post_type' => 'product',
	];
	$comments = get_comments( $args );

	foreach ( $comments as $comment ): ?>
		<?php $name = explode( " ", $comment->comment_author );
		$initials   = null;
		foreach ( $name as $i ):
			$initials .= $i[0];
		endforeach; ?>
        <div class="swiper-slide">
            <div class="modal-reviews__item">
                <div class="modal-reviews__row">
                    <div class="reviews__item-logo logo"><?php echo $initials ?></div>
                    <div class="reviews__item-info">
                        <div class="reviews__item-name"><?php echo $comment->comment_author; ?></div>
		                <?php if ( get_field( 'age', $comment ) ): ?>
                            <div class="reviews__item-age"><?php the_field( 'age', $comment ); ?> years
                                old
                            </div>
		                <?php endif; ?>
                    </div>
                </div>
				<?php $rating = get_comment_meta( $comment->comment_ID, 'rating', true ); ?>
                <div class="reviews__item-rating">
					<?php for ( $i = 0; $i < 5; $i ++ ) { ?>
                        <div class="star <?php if ( $i < $rating ): echo 'orange'; endif; ?>"></div>
					<?php }
					?>
                </div>
                <div class="reviews__item-text"><?php echo $comment->comment_content; ?></div>
            </div>
        </div>
	<?php endforeach;
	die();
}


add_filter( 'woocommerce_get_item_data', 'customizing_cart_item_data', 10, 2 );
function customizing_cart_item_data( $cart_data, $cart_item ) {
	$description = $cart_item['data']->get_description(); // Get the product description

	// If product or variation description exists we display it
	if ( ! empty( $description ) ) {
		$cart_data[] = array(
			'key'     => __( 'Description', 'woocommerce' ),
			'value'   => $description,
			'display' => $description,
		);
	}

	return $cart_data;
}


add_action( 'init', 'woocommerce_clear_cart_url' );
function woocommerce_clear_cart_url() {
	global $woocommerce;

	if ( isset( $_GET['empty-cart'] ) ) {
		$woocommerce->cart->empty_cart();
	}
}

add_filter( 'wc_add_to_cart_message', 'remove_add_to_cart_message' );
function remove_add_to_cart_message() {
	return;
}

function woo_dequeue_select2() {
	if ( class_exists( 'woocommerce' ) ) {
		wp_dequeue_style( 'select2' );
		wp_deregister_style( 'select2' );

		wp_dequeue_script( 'selectWoo' );
		wp_deregister_script( 'selectWoo' );
	}
}

add_action( 'wp_enqueue_scripts', 'woo_dequeue_select2', 100 );


add_filter( 'comment_excerpt_length', 'wp_kama_comment_excerpt_length_filter' );

function wp_kama_comment_excerpt_length_filter() {
	return 40;
}


add_filter('comment_form_fields', 'kama_reorder_comment_fields' );
function kama_reorder_comment_fields( $fields ){
	// die(print_r( $fields )); // посмотрим какие поля есть

	$new_fields = array(); // сюда соберем поля в новом порядке

	$myorder = array('rating','author', 'age', 'email', 'comment'); // нужный порядок

	foreach( $myorder as $key ){
		$new_fields[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}

	// если остались еще какие-то поля добавим их в конец
	if( $fields )
		foreach( $fields as $key => $val )
			$new_fields[ $key ] = $val;

	return $new_fields;
}

// Save the comment meta data along with comment

add_action( 'comment_post', 'save_comment_meta_data' );
function save_comment_meta_data( $comment_id ) {
	if ( ( isset( $_POST['age'] ) ) && ( $_POST['age'] != '') )
		$age = wp_filter_nohtml_kses($_POST['age']);
	add_comment_meta( $comment_id, 'age', $age );

}



// Add an edit option to comment editing screen

add_action( 'add_meta_boxes_comment', 'extend_comment_add_meta_box' );
function extend_comment_add_meta_box() {
	add_meta_box( 'title', __( 'Comment Data' ), 'extend_comment_meta_box', 'comment', 'normal', 'high' );
}

function extend_comment_meta_box ( $comment ) {
	$age = get_comment_meta( $comment->comment_ID, 'age', true );
	wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
	?>
    <p>
        <label for="age"><?php _e( 'Age' ); ?></label>
        <input type="text" name="age" value="<?php echo esc_attr( $age ); ?>" class="widefat" />
    </p>
	<?php
}


add_filter( 'comment_post_redirect', 'wp_kama_comment_post_redirect_filter', 10, 2 );

function wp_kama_comment_post_redirect_filter( $location, $comment ){

	setcookie('review_added', true, time()+5);
	// filter...
	return $location;
}

add_action('woocommerce_checkout_update_order_review', 'checkout_update_refresh_shipping_methods', 10, 1);
function checkout_update_refresh_shipping_methods( $post_data ) {
	$packages = WC()->cart->get_shipping_packages();
	foreach ($packages as $package_key => $package ) {
		WC()->session->set( 'shipping_for_package_' . $package_key, false ); // Or true
	}
}

add_action( 'wp_ajax_update_shipping_method', 'update_shipping_method_ajax' );
add_action( 'wp_ajax_nopriv_update_shipping_method', 'update_shipping_method_ajax' );

function update_shipping_method_ajax() {
    WC()->cart->calculate_totals();
	wc_cart_totals_shipping_html();
	wp_die();
}
