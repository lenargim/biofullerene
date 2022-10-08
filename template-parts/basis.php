<?php if (get_field('basis-main')): ?>
  <section class="basis block">
    <div class="container">
      <div class="basis__wrap">
        <div class="basis__graph">
          <div class="basis__img img"><img src="<?php the_field('basis-image'); ?>"
                                           alt="<?php the_field('basis-main'); ?>"></div>
        </div>
        <div class="basis__text">
          <h2><?php the_field('basis-title'); ?></h2>
          <h3 class="block-title"><?php the_field('basis-main'); ?></h3>
          <div class="basis__desc"><?php the_field('basis-description'); ?></div>
          <div class="basis__link button white">See the science</div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>