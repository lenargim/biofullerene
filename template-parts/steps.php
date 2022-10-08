<?php if (get_field('use-main')): ?>
  <div class="steps block">
    <div class="container">
      <div class="steps__wrap">
        <div class="steps__text">
          <h2><?php the_field('use-title') ?></h2>
          <div class="steps__main main-text"><?php the_field('use-main') ?></div>
        </div>
        <?php if (have_rows('use-steps')): ?>
          <div class="steps__content">
            <?php while (have_rows('use-steps')) : the_row(); ?>
              <div class="steps__content-item">
                <div class="steps__content-img img"><img src="<?php the_sub_field('img') ?>"
                                                         alt="<?php the_sub_field('text') ?>"></div>
                <div class="steps__content-text"><?php the_sub_field('text') ?></div>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php endif; ?>