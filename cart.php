<?php
/**
 * Template name: Корзина
 **/
?>

<?php get_template_part('template-parts/header/header'); ?>
<?php
$cart = WC()->cart;
$count = $cart->get_cart_contents_count();
$args = [
    'delimiter' => '<svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 15L12.5 10L7.5 5" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'wrap_before' => '<nav class="breadcrumbs">',
]; ?>
<main class="cart-page">
  <div class="container">
    <?php echo woocommerce_breadcrumb($args); ?>
    <h1 class="cart-page__title">
      <span>Your Cart
        <sup>
          <?php if ($count === 1): ?>
            <span class="count"><?php echo $count ?></span><span> item</span>
          <?php else: ?>
            <span class="count"><?php echo $count ?></span><span> items</span>
          <?php endif; ?>
        </sup>
      </span>
      <?php if ($count): ?>
        <a class="cart-page__clear"
           href="<?php echo $cart->get_cart_url(); ?>?empty-cart"><?php _e('Clear cart', 'woocommerce'); ?></a>
      <?php endif; ?>
    </h1>
    <?php echo do_shortcode('[woocommerce_cart]'); ?>
  </div>
</main>
<?php get_template_part('template-parts/footer/footer'); ?>
