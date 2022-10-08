<section class="team block">
  <div class="container">
    <div class="team__row">
      <h3 class="team__title block-title"><?php echo get_field('experts_title', 'experts'); ?></h3>
      <div class="team__info">
        <?php if (is_page_template('home.php')) : ?>
          <div class="team__desc"><?php echo get_field('experts_description', 'experts'); ?></div>
        <?php endif; ?>
        <div class="navigation">
          <span class="navigation-button navigation-prev team-prev">
            <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use></svg>
          </span>
          <span class="navigation-button navigation-next team-next">
            <svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use></svg>
          </span>
        </div>
      </div>
    </div>
    <?php
    global $post;
    $args = [
        'post_type' => 'experts',
        'numberposts' => -1,
    ];
    $experts = get_posts($args);

    ?>
      <div class="team__slider">
        <div class="swiper-wrapper">
          <?php foreach ($experts as $post): ?>
          <?php setup_postdata( $post ); ?>
            <div class="swiper-slide team__expert">
              <div class="team__img img">
                <img src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>">
              </div>
              <div class="team__brand"><?php the_field('expert-brand') ?></div>
              <div class="team__name"><?php the_title(); ?></div>
              <div class="team__text"><?php the_content(); ?></div>
              <div class="team__job"><?php the_field('expert-job') ?></div>
            </div>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); ?>
        </div>
        <div class="scrollbar-wrap">
          <div class="custom-scrollbar"></div>
        </div>
      </div>
  </div>
</section>