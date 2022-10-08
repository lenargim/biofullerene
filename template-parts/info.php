<section class="info block" id="info">
  <div class="container">
    <div class="info__wrap">
      <div class="info__img-box">
        <img src="<?php echo IMAGES_PATH; ?>/info1.jpg" class="info__img img big">
        <img src="<?php echo IMAGES_PATH; ?>/info2.jpg" class="info__img img small">
        <img src="<?php echo IMAGES_PATH; ?>/info3.jpg" class="info__img img small">
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