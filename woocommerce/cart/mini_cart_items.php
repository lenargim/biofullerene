<?php $items = WC()->cart->get_cart(); ?>
<?php foreach ( $items as $item => $values ) :
	$product = wc_get_product( $values['data']->get_id() );
	$product_link = get_permalink( $values['data']->get_id() );
	$variations = wc_get_formatted_cart_item_data( $values, true );
	?>

	<?php if ( ! wp_is_mobile() ): ?>
    <div class="woo_amc_item mini-cart__item woo_amc_item_wrap" data-id="<?php echo $product->get_id() ?>">
        <div class="mini-cart__left">
            <a href="<?php echo $product_link; ?>" class="woo_amc_item_img mini-cart__img img">
				<?php echo $product->get_image( 'woocommerce_gallery_thumbnail' ); ?>
            </a>
            <div class="mini-cart__text">
                <div class="mini-cart__name">
                    <div class="timer">
                        <div class="timer__line"></div>
                        <div class="timer__body">
                            <div class="timer__counter">
                                <span>4</span><span>3</span><span>2</span><span>1</span><span>0</span>
                            </div>
                        </div>
                    </div>
                    <span class="constName"><?php echo $product->get_title(); ?></span>
                    <span class="deleted">was deleted</span>
                </div>

                <div class="mini-cart__desc">
					<?php echo $product->get_description() ?>
                </div>
                <div class="mini-cart__quantity-wrap woo_amc_item_quanity_wrap">
                    <div class="mini-cart__update minus <?php if ( $values['quantity'] === 1 )
						echo ' disabled' ?>"
                         data-type="minus">
                        <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.33301 8H12.6663" stroke-width="1.6" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <input data-key="<?php echo $item; ?>" type="text" readonly
                           class="quanity mini-cart__quantity "
                           value="<?php echo $values['quantity']; ?>">
                    <div class="mini-cart__update" data-type="plus">
                        <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.99967 3.33334V12.6667M3.33301 8.00001H12.6663" stroke-width="1.6"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="mini-cart__right">
            <div class="mini-cart__remove" data-key="<?php echo $item; ?>">Remove</div>
            <div class="mini-cart__right-price">
				<?php
				$quantity  = $values['quantity'];
				$price     = $product->get_price();
				$reg_price = $product->get_regular_price();
				if ( $price !== $reg_price ): ?>
                    <div class="regular">$<span
                                class="regular-price"><?php echo $quantity * intval( $reg_price ) ?></span></div>
				<?php endif; ?>
                <div class="price">$<span class="current-price"><?php echo $price * intval( $quantity ) ?></span></div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="woo_amc_item mini-cart__item mini-cart__item-mobile woo_amc_item_wrap" data-id="<?php echo $product->get_id() ?>">
        <div class="mini-cart__top">
            <a href="<?php echo $product_link; ?>" class="woo_amc_item_img mini-cart__img img">
				<?php echo $product->get_image( 'woocommerce_gallery_thumbnail' ); ?>
            </a>
            <div class="mini-cart__name">
                <div class="timer">
                    <div class="timer__line"></div>
                    <div class="timer__body">
                        <div class="timer__counter">
                            <span>4</span><span>3</span><span>2</span><span>1</span><span>0</span>
                        </div>
                    </div>
                </div>
                <span class="constName"><?php echo $product->get_title(); ?></span>
                <span class="deleted">was deleted</span>
            </div>
            <div class="mini-cart__remove" data-key="<?php echo $item; ?>">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 3.99967H3.33333M3.33333 3.99967H14M3.33333 3.99967V13.333C3.33333 13.6866 3.47381 14.0258 3.72386 14.2758C3.97391 14.5259 4.31304 14.6663 4.66667 14.6663H11.3333C11.687 14.6663 12.0261 14.5259 12.2761 14.2758C12.5262 14.0258 12.6667 13.6866 12.6667 13.333V3.99967H3.33333ZM5.33333 3.99967V2.66634C5.33333 2.31272 5.47381 1.97358 5.72386 1.72353C5.97391 1.47348 6.31304 1.33301 6.66667 1.33301H9.33333C9.68696 1.33301 10.0261 1.47348 10.2761 1.72353C10.5262 1.97358 10.6667 2.31272 10.6667 2.66634V3.99967M6.66667 7.33301V11.333M9.33333 7.33301V11.333"
                          stroke="#8791A1" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
        <div class="mini-cart__desc">
			<?php echo $product->get_description() ?>
        </div>
        <div class="mini-cart__bottom">
            <div class="mini-cart__quantity-wrap woo_amc_item_quanity_wrap">
                <div class="mini-cart__update minus <?php if ( $values['quantity'] === 1 )
					echo ' disabled' ?>"
                     data-type="minus">
                    <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.33301 8H12.6663" stroke-width="1.6" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </div>
                <input data-key="<?php echo $item; ?>" type="text" readonly
                       class="quanity mini-cart__quantity "
                       value="<?php echo $values['quantity']; ?>">
                <div class="mini-cart__update" data-type="plus">
                    <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.99967 3.33334V12.6667M3.33301 8.00001H12.6663" stroke-width="1.6"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            <div class="mini-cart__right-price">
				<?php
				$quantity  = $values['quantity'];
				$price     = $product->get_price();
				$reg_price = $product->get_regular_price();
				if ( $price !== $reg_price ): ?>
                    <div class="regular">$<span
                                class="regular-price"><?php echo $quantity * intval( $reg_price ) ?></span></div>
				<?php endif; ?>
                <div class="price">$<span class="current-price"><?php echo $price * intval( $quantity ) ?></span></div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php endforeach; ?>
