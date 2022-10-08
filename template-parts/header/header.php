<?php require_once("head.php"); ?>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header <?php if (is_page_template('home.php') || is_page_template('research.php')) { echo 'transparent'; } ?>">
  <?php if (!isset($_COOKIE['shipping_popup'])) {
    $shippingValue = 'open';
  } else {
    $shippingValue = $_COOKIE['shipping_popup'];
  } ?>
  <?php if ($shippingValue == 'open'): ?>
    <div class="header__shipping">
      <span>Free United States Shipping</span>
      <svg class="cross">
        <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#cross"></use>
      </svg>
    </div>
  <?php endif; ?>
  <div class="header__row">
    <div class="container container_big">
      <div class="header__wrap">
        <?php wp_nav_menu([
            'theme_location' => 'primary',
            'menu' => 'main',
            'container' => '',
            'menu_class' => 'header__menu header__part',
            'walker'         => new WPSE_78121_Sublevel_Walker
        ]) ?>
        <?php if (is_page_template('home.php')) { ?>
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
          <span>Cart</span><span class="count amount amount-ajax"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        </div>
      </div>
    </div>
  </div>
</header>