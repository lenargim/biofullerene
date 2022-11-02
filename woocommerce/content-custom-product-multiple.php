<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
  return;
}
?>
<div <?php wc_product_class('swiper-slide mainpage-multiple', $product); ?>>
  <?php $field = get_field('label'); ?>
  <?php if ($field): ?>
    <span class="mainpage-product__label multiple <?php echo $field['value'] ?>"><?php echo $field['label'] ?></span>
  <?php endif; ?>
  <div class="mainpage-multiple__img">
    <?php echo woocommerce_get_product_thumbnail('woocommerce_thumbnail'); ?>
    <?php $tags = $product->tag_ids; ?>
    <?php if ($tags) : ?>
      <div class="mainpage-multiple__tags">
        <?php foreach ($tags as $tag) { ?>
          <div class="mainpage-multiple__tag">
            <?php echo get_term($tag)->name; ?>
          </div>
        <?php } ?>
      </div>
    <?php endif; ?>
    <div class="mainpage-multiple__box">
        <?php if ( !$product->is_type( 'variable' ) ): ?>
	        <?php woocommerce_template_loop_add_to_cart(); ?>
        <?php endif; ?>
      <a href="<?php echo get_permalink( $product->ID ); ?>" class="mainpage-multiple__link button white">Explore</a>
    </div>
  </div>
  <div class="mainpage-multiple__info">
    <div class="mainpage-multiple__title"><?php echo get_the_title(); ?></div>
    <div class="mainpage-multiple__excerpt"><?php the_excerpt() ?></div>
  </div>
</div>
