<?php
/**
 * Template name: Корзина
 **/
?>

<?php get_template_part( 'template-parts/header/header' ); ?>
<?php
$cart  = WC()->cart;
$count = $cart->get_cart_contents_count(); ?>
<main class="cart-page">
    <div class="container">
        <div class="breadcrumbs">
            <a href="/" class="home">
			    <?php if ( ! wp_is_mobile() ): ?>
                    Home
			    <?php else: ?>
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 4.5L2 3.87092M2 3.87092L5.58258 1.61718C5.83095 1.46094 6.16905 1.46094 6.41742 1.61718L10 3.87092M2 3.87092V9.95759C2 10.2572 2.23878 10.5 2.53333 10.5H9.46667C9.76122 10.5 10 10.2572 10 9.95759V3.87092M10 3.87092L11 4.5"
                              stroke="#657181" stroke-width="1.2" stroke-linecap="round"/>
                    </svg>
			    <?php endif; ?>
            </a>
            <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.5 15L12.5 10L7.5 5" stroke-width="1.6" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
            <span>Research</span>
        </div>
        <h1 class="cart-page__title">
      <span>Your Cart
        <sup>
          <?php if ( $count === 1 ): ?>
              <span class="count"><?php echo $count ?></span><span> item</span>
          <?php else: ?>
              <span class="count"><?php echo $count ?></span><span> items</span>
          <?php endif; ?>
        </sup>
      </span>
			<?php if ( $count ): ?>
                <a class="cart-page__clear"
                   href="<?php echo $cart->get_cart_url(); ?>?empty-cart">
					<?php if ( wp_is_mobile() ): ?>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 3.99967H3.33333M3.33333 3.99967H14M3.33333 3.99967V13.333C3.33333 13.6866 3.47381 14.0258 3.72386 14.2758C3.97391 14.5259 4.31304 14.6663 4.66667 14.6663H11.3333C11.687 14.6663 12.0261 14.5259 12.2761 14.2758C12.5262 14.0258 12.6667 13.6866 12.6667 13.333V3.99967H3.33333ZM5.33333 3.99967V2.66634C5.33333 2.31272 5.47381 1.97358 5.72386 1.72353C5.97391 1.47348 6.31304 1.33301 6.66667 1.33301H9.33333C9.68696 1.33301 10.0261 1.47348 10.2761 1.72353C10.5262 1.97358 10.6667 2.31272 10.6667 2.66634V3.99967M6.66667 7.33301V11.333M9.33333 7.33301V11.333" stroke="#8791A1" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
					<?php endif; ?>
					<?php _e( 'Clear cart', 'woocommerce' ); ?>
                </a>
			<?php endif; ?>
        </h1>
		<?php echo do_shortcode( '[woocommerce_cart]' ); ?>
    </div>
</main>
<?php get_template_part( 'template-parts/footer/footer' ); ?>
