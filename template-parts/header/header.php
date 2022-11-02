<?php require_once( "head.php" ); ?>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header
        class="header <?php if ( is_page_template( 'home.php' ) ||
		                                is_page_template( 'research.php' ) ||
		                                is_page_template( 'locations.php' ) ||
		                                is_page_template( 'company.php' ) ) {
			echo 'transparent ';
		} else if ( is_post_type_archive( 'faq' ) ||
		            is_page_template( 'terms.php' )
		) {
			echo 'blue';
		} ?>">
	<?php if ( ! isset( $_COOKIE['shipping_popup'] ) ) {
		$shippingValue = 'open';
	} else {
		$shippingValue = $_COOKIE['shipping_popup'];
	} ?>
	<?php if ( $shippingValue == 'open' ): ?>
        <div class="header__shipping">
            <span>Free United States Shipping</span>
            <svg class="cross">
                <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#cross"></use>
            </svg>
        </div>
	<?php endif; ?>
	<?php if ( ! isset( $_COOKIE['cookies_popup'] ) ) {
		$cookiesValue = 'open';
	} else {
		$cookiesValue = $_COOKIE['cookies_popup'];
	} ?>
	<?php if ( $cookiesValue == 'open' ): ?>
        <div class="header__cookies">
            <p>Our site uses cookies to make for a more optimal experience. By continuing to browse<br>
                the site you are agreeing to our use of cookies. You can view <a
                        href="<?php echo get_privacy_policy_url(); ?>">our cookie information here</a>.</p>
            <div class="header__cookies-buttonbox">
                <button class="button white set-cookies">Decline</button>
                <button class="button blue set-cookies">Allow</button>
            </div>
        </div>
	<?php endif; ?>
    <div class="header__row">
        <div class="container container_big">
            <div class="header__wrap">
				<?php if ( ! wp_is_mobile() ): ?>
					<?php wp_nav_menu( [
						'theme_location' => 'primary',
						'menu'           => 'main',
						'container'      => '',
						'menu_class'     => 'header__menu header__part',
						'walker'         => new WPSE_78121_Sublevel_Walker
					] );
				else: ?>
                    <div class="header__part">
                        <div class="burger">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 12H21M3 6H21M3 18H21" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="burger__cross">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 5L5 15M5 5L15 15" stroke="#121417" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
				<?php endif; ?>
				<?php if ( is_page_template( 'home.php' ) ) { ?>
                    <svg class="header__logo header__part">
                        <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#logo"></use>
                    </svg>
				<?php } else {
					?>
                    <a href="/" class="header__logo img header__part">
                        <svg class="header__logo">
                            <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#logo"></use>
                        </svg>
                    </a>
					<?php
				} ?>
                <div class="header__cart header__part">
                    <span class="label">Cart</span>
					<?php if ( wp_is_mobile() ): ?>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.5 5.00033L5 1.66699H15L17.5 5.00033M2.5 5.00033V16.667C2.5 17.109 2.67559 17.5329 2.98816 17.8455C3.30072 18.1581 3.72464 18.3337 4.16667 18.3337H15.8333C16.2754 18.3337 16.6993 18.1581 17.0118 17.8455C17.3244 17.5329 17.5 17.109 17.5 16.667V5.00033M2.5 5.00033H17.5M13.3333 8.33366C13.3333 9.21771 12.9821 10.0656 12.357 10.6907C11.7319 11.3158 10.8841 11.667 10 11.667C9.11594 11.667 8.2681 11.3158 7.64298 10.6907C7.01786 10.0656 6.66667 9.21771 6.66667 8.33366"
                                  stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
					<?php endif; ?>
                    <span class="count amount amount-ajax">
                        <?php echo WC()->cart->get_cart_contents_count(); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
	<?php if ( wp_is_mobile() ): ?>
        <div class="burger__menu">
            <div class="container">
                <div class="burger__menu-wrap">
	                <?php wp_nav_menu( [
		                'theme_location' => 'primary',
		                'menu'           => 'main',
		                'container'      => '',
		                'menu_class'     => 'mobile__menu',
		                //'walker'         => new WPSE_78121_Sublevel_Walker
	                ] ); ?>
	                <?php wp_nav_menu( [
		                'menu'       => 33,
		                'container'  => false,
		                'menu_class' => 'mobile__support',
		                'depth'      => 1,
	                ] ) ?>
	                <?php
	                $count_posts = wp_count_posts('product')->publish;
	                if (intval($count_posts) === 1) :
		                $prod_link = wc_get_products(['numberposts' => 1, 'post_status' => 'publish'])[0]->get_permalink();
	                else:
		                $prod_link = get_permalink(wc_get_page_id('cart'));
	                endif;
	                ?>
                    <div class="burger__buttons">
                        <a href="<?php echo $prod_link ?>" class="button blue burger__buy">Buy water now</a>
                        <button class="open-modal-help burger__help button white">Need help?</button>
                    </div>
                </div>
            </div>
        </div>
	<?php endif; ?>
</header>