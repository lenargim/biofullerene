<section class="info block" id="info">
  <div class="container">
    <div class="info__wrap">
      <div class="info__img-box">
        <img src="<?php echo IMAGES_PATH; ?>/info1.jpg" class="info__img img big">
        <img src="<?php echo IMAGES_PATH; ?>/info2.jpg" class="info__img img small">
        <img src="<?php echo IMAGES_PATH; ?>/info3.jpg" class="info__img img small">
          <svg class="line" width="494" height="479" viewBox="0 0 494 479" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M461.708 46.458C461.708 46.458 539.829 219.404 404.905 233.837C280.993 247.092 270.949 -26.7582 101.18 14.5959C-98.636 63.269 198.489 410.475 4.10157 476.021" stroke="#FBCEB1" stroke-width="20" stroke-dasharray="4 24"/>
          </svg>
      </div>
      <div class="info__text">
        <h2><?php the_field('info-title') ?></h2>
        <div class="info__main main-text"><?php the_field('info-main') ?></div>
        <ol class="info__list">
          <?php while (have_rows('info-list')): the_row() ?>
            <li class="info__list-item"><?php the_sub_field('item') ?></li>
          <?php endwhile; ?>
        </ol>
      </div>
    </div>
  </div>
</section>