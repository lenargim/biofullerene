<?php require_once("head.php"); ?>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header header-empty">
  <?php if (!isset($_COOKIE['shipping_popup'])) {
    $shippingValue = 'open';
  } else {
    $shippingValue = $_COOKIE['shipping_popup'];
  } ?>
  <div class="header__row">
    <div class="container container_big">
      <div class="header__wrap">
        <a href="/" class="header__logo img header__part">
          <svg class="header__logo">
            <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#logo"></use>
          </svg>
        </a>
      </div>
    </div>
  </div>
</header>