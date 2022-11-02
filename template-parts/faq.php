<?php
$args = [
    'numberposts' => 5,
    'post_type' => 'faq',

];
$posts = get_posts($args);
?>

<section class="faq block">
  <div class="container">
    <div class="faq__wrap">
      <h3 class="block-title">Frequently<br>asked questions</h3>
      <div class="faq__list">
        <?php $faq_count = 0 ?>
        <?php foreach ($posts as $post): ?>
        <?php $faq_count++; ?>
          <?php setup_postdata($post); ?>
          <div class="faq__item <?php if ($faq_count == 1) echo 'opened'; ?>">
            <div class="faq__item-title">
              <span><?php the_title(); ?></span>
                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 15L12.5 10L7.5 5" stroke="#3D434C" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="faq__item-content"><?php the_content(); ?></div>
          </div>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
</section>