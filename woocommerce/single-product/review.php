<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}
?>
<li class="product-reviews__item" id="li-comment-<?php comment_ID(); ?>">
  <?php $name = explode(" ", get_comment_author());
  $initials = null;
  foreach ($name as $i) {
    $initials .= $i[0];
  } ?>
  <div class="product-reviews__item-left">
    <div class="product-reviews__item-img logo"><?php echo $initials; ?></div>
    <div class="product-reviews__item-info">
      <div class="product-reviews__item-name"><?php comment_author(); ?></div>
      <?php if (get_field('age', 'comment_' . get_comment_ID())): ?>
        <div class="product-reviews__item-age"><?php the_field('age', 'comment_' . get_comment_ID()); ?> years old</div>
      <?php endif; ?>
    </div>
  </div>
  <div class="product-reviews__item-content">
    <?php $rating = get_comment_meta(get_comment_ID(), 'rating', true);
    $rating_width = $rating / 5 * 100;
    if ($rating): ?>
      <div class="product-reviews__item-rating">
        <div class="product-reviews__item-rating-fill" style="width: <?php echo $rating_width ?>%"></div>
      </div>
    <?php endif; ?>
    <div class="product-reviews__item-text"><?php comment_text(); ?></div>
    <div class="product-reviews__item-date"><?php echo get_comment_date('d/m/Y'); ?></div>
  </div>
