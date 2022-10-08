<?php get_template_part('template-parts/header/head'); ?>
<body>
<div class="not-found">
  <div class="not-found__box">
    <div class="not-found__head">404</div>
    <div class="not-found__oops">Упс!</div>
    <div class="not-found__span">Ошибочка</div>
    <div class="not-found__info">
      <div class="not-found__info-item">Вернуться на <a href="/">главную страницу</a></div>
      <div class="not-found__info-item">Или позвоните нам
        <a href="tel:<?php echo preg_replace('/[' . PHONE_CHARS . ']/', '', get_field('phone', 38)) ?>">
          <?php echo get_field('phone', 38) ?>
        </a>
      </div>
    </div>
  </div>
</div>
</body>