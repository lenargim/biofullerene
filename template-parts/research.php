<section class="research block">
  <div class="container">
    <h3 class="block-title research__title">Research references <sup
              class="sup"><?php echo wp_count_posts()->publish; ?> articles</sup></h3>
    <div class="research__wrap">
      <?php
      $articles = get_posts([
          'numberposts' => 3,
      ]);
      foreach ($articles as $post) {
        setup_postdata($post); ?>
        <div class="research__item">
          <a href="<?php echo get_post_permalink();?>" class="research__item-img img">
            <img src="<?php the_post_thumbnail_url('research_thumbnail') ?>" alt="<?php the_title() ?>">
          </a>
          <?php $tags = get_the_tags(); ?>
          <?php if ($tags) : ?>
            <div class="research__item-taglist">
              <?php foreach ($tags as $tag): ?>
                <span class="research__item-tag"><?php echo $tag->name ?></span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <a href="<?php echo get_post_permalink();?>" class="research__item-title"><?php the_title() ?></a>
        </div>
      <?php }
      wp_reset_postdata();
      ?>
    </div>
    <a href="<?php echo get_page_link(129) ?>" target="_blank" class="research__button button white">
      <span>Go to all research</span>
      <svg>
        <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-mainpage.svg#button-arrow"></use>
      </svg>
    </a>
  </div>
</section>