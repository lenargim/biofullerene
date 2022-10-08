<?php require_once("head.php"); ?>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header header-checkout">
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

        <div class="header-checkout__secure">
          <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-checkout.svg#lock"></use></svg>
          <span>Secure checkout</span>
        </div>
        <a href="/" class="header__logo img header__part">
          <svg class="header__logo">
            <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#logo"></use>
          </svg>
        </a>
        <div class="header-checkout__help">
          <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-checkout.svg#message"></use></svg>
          <span>Need help?</span>
        </div>
      </div>
    </div>
  </div>
</header>