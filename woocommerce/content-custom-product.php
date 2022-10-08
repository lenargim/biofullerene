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
<div <?php wc_product_class('mainpage-product', $product); ?>>
  <?php $field = get_field('label'); ?>
  <div class="mainpage-product__img">
    <?php if ($field): ?>
      <span class="mainpage-product__label <?php echo $field['value'] ?>"><?php echo $field['label'] ?></span>
    <?php endif; ?>
    <?php echo woocommerce_get_product_thumbnail(array(552, 487, 1)); ?>
  </div>
  <div class="mainpage-product__info">
    <?php $tags = $product->tag_ids; ?>
    <?php if ($tags) : ?>
      <div class="mainpage-product__tags">
        <?php foreach ($tags as $tag) { ?>
          <div class="mainpage-product__tag">
            <?php echo get_term($tag)->name; ?>
          </div>
        <?php } ?>
      </div>
    <?php endif; ?>
    <div class="mainpage-product__title"><?php echo get_the_title(); ?></div>
    <?php if ($product->get_attribute('serving')): ?>
      <div class="mainpage-product__serving"><?php echo $product->get_attribute('serving'); ?></div>
    <?php endif; ?>
    <div class="mainpage-product__excerpt"><?php the_excerpt() ?></div>
    <?php if (get_field('advantages')): ?>
      <ul class="mainpage-product__advantages">
        <?php while (have_rows('advantages')): the_row() ?>
          <li class="mainpage-product__advantage">
            <svg>
              <use xlink:href="<?php echo IMAGES_PATH ?>/sprite-mainpage.svg#sb"></use>
            </svg>
            <span><?php the_sub_field('item') ?></span>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
    <a href="<?php echo get_permalink($product->ID); ?>"
       class="mainpage-product__button button blue"
       target="_blank">Buy now from $<?php echo $product->get_price(); ?></a>
  </div>
