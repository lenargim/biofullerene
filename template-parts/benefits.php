<section class="block benefits">
  <div class="container">
    <h2><?php echo get_the_title(41) ?></h2>
    <div class="block-title">
      <?php echo get_the_content(null, false, 41); ?>
    </div>
    <?php if (have_rows('list', 41)): ?>
      <div class="benefits__row">
        <?php while (have_rows('list', 41)): the_row() ?>
          <div class="benefits__item">
            <div class="benefits__img img"><img src="<?php the_sub_field('img') ?>" alt="<?php the_sub_field('title') ?>"></div>
            <div class="benefits__title"><?php the_sub_field('title') ?></div>
            <p class="benefits__desc"><?php the_sub_field('description') ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
</section>