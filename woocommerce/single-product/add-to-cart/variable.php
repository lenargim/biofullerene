<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined('ABSPATH') || exit;

global $product;

$attribute_keys = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);

do_action('woocommerce_before_add_to_cart_form'); ?>

  <form class="variations_form cart"
        action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
        method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>"
        data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
    <?php do_action('woocommerce_before_variations_form'); ?>
    <?php if (empty($available_variations) && false !== $available_variations) : ?>
      <p class="stock out-of-stock"><?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?></p>
    <?php else : ?>
      <table class="variations" cellspacing="0" role="presentation">
        <tbody>
        <?php foreach ($attributes as $attribute_name => $options) : ?>
          <tr>
            <td class="value">
              <?php
              $args = wp_parse_args(
                  apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args),
                  array(
                      'options' => $options,
                      'attribute' => $attribute_name,
                      'product' => $product,
                      'selected' => false,
                      'name' => '',
                      'id' => '',
                      'class' => '',
                      'show_option_none' => __('Choose an option', 'woocommerce'),
                  )
              );

              // Get selected value.
              if (false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {
                $selected_key = 'attribute_' . sanitize_title($args['attribute']);
                // phpcs:disable WordPress.Security.NonceVerification.Recommended
                $args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']);
                // phpcs:enable WordPress.Security.NonceVerification.Recommended
              }

              $options = $args['options'];
              $product = $args['product'];
              $attribute = $args['attribute'];
              $name = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title($attribute);
              $id = $args['id'] ? $args['id'] : sanitize_title($attribute);
              $class = $args['class'];
              $show_option_none = (bool)$args['show_option_none'];
              $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce'); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

              if (empty($options) && !empty($product) && !empty($attribute)) {
                $attributes = $product->get_variation_attributes();
                $options = $attributes[$attribute];
              } ?>
              <div class="product-page__types">
                <?
                if (!empty($options)) {
                  if ($product && taxonomy_exists($attribute)) {
                    // Get terms if this is a taxonomy - ordered. We need the names too.
                    $terms = wc_get_product_terms(
                        $product->get_id(),
                        $attribute,
                        array(
                            'fields' => 'all',
                        )
                    );
                    $i = 0;
                    foreach ($terms as $term) {
                      if (in_array($term->slug, $options, true)): ?>
                        <div class="product-page__type">
                          <input type="radio"
                              <?php if ($i === 0) echo 'checked' ?>
                                 name="product-type"
                                 class="product-page__type-input"
                                 id="product-type-<?php echo $term->slug; ?>">
                          <label for="product-type-<?php echo $term->slug; ?>" class="product-page__type-label label">
                            <div class="product-page__type-text">
                              <div><?php echo $term->name; ?></div>
                              <div><?php echo $term->description ?></div>
                            </div>
                          </label>
                        </div>
                      <?php endif;
                    }
                  }
                } ?>
              </div>
              <?

              // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
              //echo apply_filters('woocommerce_dropdown_variation_attribute_options_html', $html, $args);
              ?>

            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <?php do_action('woocommerce_after_variations_table'); ?>

      <div class="single_variation_wrap">
        <?php
        /**
         * Hook: woocommerce_before_single_variation.
         */
        do_action('woocommerce_before_single_variation');

        /**
         * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
         *
         * @since 2.4.0
         * @hooked woocommerce_single_variation - 10 Empty div for variation data.
         * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
         */
        do_action('woocommerce_single_variation');

        /**
         * Hook: woocommerce_after_single_variation.
         */
        do_action('woocommerce_after_single_variation');
        ?>
      </div>
    <?php endif; ?>

    <?php do_action('woocommerce_after_variations_form'); ?>
  </form>

<?php
do_action('woocommerce_after_add_to_cart_form');
