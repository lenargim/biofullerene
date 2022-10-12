<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

get_template_part('template-parts/header/header'); ?>
<?php $args = [
    'delimiter' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M7.5 15L12.5 10L7.5 5" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
</svg>',
    'wrap_before' => '<nav class="breadcrumbs">',
]; ?>
<main class="product-page">
  <?php while (have_posts()) :the_post();
    global $product; ?>
    <div class="container">
      <?php echo woocommerce_breadcrumb($args); ?>
      <div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
        <div class="product-page__wrap">
          <div class="product-page__images">
            <?php $field = get_field('label'); ?>
            <?php if ($field): ?>
              <span class="mainpage-product__label <?php echo $field['value'] ?>"><?php echo $field['label'] ?></span>
            <?php endif; ?>
            <div class="product-page__slider">
              <div class="swiper-wrapper">
                <div class="swiper-slide product-page__img img">
                  <?php echo $product->get_image('woocommerce_single', ['alt' => $product->get_name()]); ?>
                </div>
                <?php $attachment_ids = $product->get_gallery_image_ids(); ?>
                <?php foreach ($attachment_ids as $attachment_id): ?>
                  <div class="swiper-slide product-page__img img">
                    <?php $Original_image_url = wp_get_attachment_url($attachment_id);
                    echo wp_get_attachment_image($attachment_id, 'woocommerce_single', ['alt' => $product->get_name()]); ?>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="product-page__thumbs">
              <div class="swiper-wrapper">
                <div class="swiper-slide product-page__thumb img">
                  <div class="product-page__thumb-wrap">
                    <?php echo $product->get_image('woocommerce_gallery_thumbnail'); ?>
                  </div>
                </div>
                <?php foreach ($attachment_ids as $attachment_id): ?>
                  <div class="swiper-slide product-page__thumb img">
                    <div class="product-page__thumb-wrap">
                      <?php $Original_image_url = wp_get_attachment_url($attachment_id);
                      echo wp_get_attachment_image($attachment_id, 'woocommerce_gallery_thumbnail'); ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class="product-page__info">
            <?php $tags = $product->tag_ids; ?>
            <?php if ($tags) : ?>
              <div class="mainpage-product__tags">
                <?php foreach ($tags as $tag) { ?>
                  <div class="mainpage-product__tag">
                    <?php echo get_term($tag)->name; ?>
                  </div>
                <?php } ?>
              </div>
            <?php endif; ?>
            <div class="product-page__title">
              <h1 class="main-text"><?php echo $product->get_name(); ?></h1>
              <div class="share">
                <span>Share</span>
                <svg viewBox="0 0 16 16" fill="none">
                  <g clip-path="url(#clip0_1401_13094)">
                    <path d="M5.72667 9.00768L10.28 11.661M10.2733 4.34102L5.72667 6.99435M14 3.33435C14 4.43892 13.1046 5.33435 12 5.33435C10.8954 5.33435 10 4.43892 10 3.33435C10 2.22978 10.8954 1.33435 12 1.33435C13.1046 1.33435 14 2.22978 14 3.33435ZM6 8.00102C6 9.10559 5.10457 10.001 4 10.001C2.89543 10.001 2 9.10559 2 8.00102C2 6.89645 2.89543 6.00102 4 6.00102C5.10457 6.00102 6 6.89645 6 8.00102ZM14 12.6677C14 13.7723 13.1046 14.6677 12 14.6677C10.8954 14.6677 10 13.7723 10 12.6677C10 11.5631 10.8954 10.6677 12 10.6677C13.1046 10.6677 14 11.5631 14 12.6677Z"
                          stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                  </g>
                  <defs>
                    <clipPath id="clip0_1401_13094">
                      <rect width="16" height="16" fill="white" transform="translate(0 0.00100708)"/>
                    </clipPath>
                  </defs>
                </svg>
                <div class="share__modal-wrap">
                  <div class="share__modal">
                    <button class="share__item copy-link">
                      <img src="<?php echo IMAGES_PATH; ?>/svg/link.svg">
                      <span>Copy link</span>
                    </button>
                    <a href="#" target="_blank" class="share__item share-twitter twitter-share-button">
                      <svg>
                        <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#tw"></use>
                      </svg>
                      <span>Twitter</span>
                    </a>
                    <a href="#" target="_blank" class="share__item share-telegram">
                      <img src="<?php echo IMAGES_PATH; ?>/svg/tg.svg">
                      <span>Telegram</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-page__popular" data-scroll="reviews">
              <div class="product-page__rating">
                <?php $rating_width = $product->get_average_rating() / 5 * 100; ?>
                <div class="product-page__rating-fill" style="width: <?php echo $rating_width ?>%"></div>
              </div>
              <div class="product-page__reviews"><?php echo $product->get_review_count(); ?> reviews</div>

            </div>
            <?php if ($product->get_attribute('serving')): ?>
              <div class="product-page__serving"><?php echo $product->get_attribute('serving'); ?></div>
            <?php endif; ?>
            <div class="product-page__desc"><?php echo $product->get_description(); ?></div>
            <?php if ($product->is_type('variable')): ?>
            <form class="variations_form cart"
                  action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                  method="post" enctype='multipart/form-data'
                  data-product_id="<?php echo absint($product->get_id()); ?>">
              <div class="product-page__plan">
                <?php $types = wp_get_post_terms($product->get_id(), 'pa_plan');
                if (!empty($types)): ?>
                  <div class="product-page__plan-title">Select your plan:</div>
                  <div class="product-page__types">
                    <?php $i = 0; ?>
                    <?php foreach ($types as $type): ?>
                      <div class="product-page__type">
                        <input type="radio"
                            <?php if ($i === 0) echo 'checked' ?>
                               name="product-type"
                               class="product-page__type-input"
                               id="product-type-<?php echo $type->slug; ?>"
                               value="<?php echo $type->slug; ?>"
                        >
                        <label for="product-type-<?php echo $type->slug; ?>" class="product-page__type-label label">
                          <div class="product-page__type-text">
                            <div><?php echo $type->name; ?></div>
                            <div><?php echo $type->description ?></div>
                          </div>
                        </label>
                      </div>
                      <?php $i++ ?>
                    <?php endforeach; ?>
                  </div>
                  <div class="product-page__block individual">
                    <?php $i = 0; ?>
                    <?php $variations = $product->get_available_variations(); ?>
                    <?php foreach ($variations as $value): ?>
                      <div class="product-page__variation <?php echo $value['attributes']['attribute_pa_plan']; ?>">
                        <?php
                        $price = $value['display_price'];
                        $reg_price = $value['display_regular_price'];
                        if ($value['attributes']['attribute_pa_plan'] == 'individual'): ?>
                          <input type="radio"
                              <?php if ($i === 0) echo 'checked';
                              $i++; ?>

                                 id="product-individual-<?php echo $value['variation_id']; ?>"
                                 class="product-page__variation-input"
                                 name="product-individual"
                                 data-id="<?php echo $value['variation_id']; ?>"
                                 data-price="<?php echo $price ?>"
                          >
                          <label for="product-individual-<?php echo $value['variation_id']; ?>"
                                 class="product-page__box product-page__label label product-page__individual">
                            <div class="product-page__variation-text">
                              <div class="product-page__variation-type">
                                <?php echo $value['text_field'] ?></div>
                              <div class="product-page__variation-desc">
                                <?php echo $value['variation_description'] ?></div>
                            </div>
                            <div class="product-page__variation-price">
                              <?php if ($price !== $reg_price) :
                                $percentage = round(100 - (floatval($price) / floatval($reg_price) * 100)); ?>
                                <div class="save">Save <?php echo $percentage ?>%</div>
                              <?php endif;
                              echo $value['price_html'] ?></div>
                          </label>
                        <?php elseif ($value['attributes']['attribute_pa_plan'] == 'subscribe'): ?>
                          <div class="product-page__subscribe product-page__box"
                               data-id="<?php echo $value['variation_id']; ?>"
                               data-price="<?php echo $price ?>"
                          >
                            <div class="product-page__variation-text">
                              <div class="product-page__variation-type">
                                <?php echo $value['text_field'] ?></div>
                              <div class="product-page__variation-desc">
                                <?php echo $value['variation_description'] ?></div>
                            </div>
                            <div class="product-page__variation-price">
                              <?php
                              $price = $value['display_price'];
                              $reg_price = $value['display_regular_price'];
                              if ($price !== $reg_price) :
                                $percentage = round(100 - (floatval($price) / floatval($reg_price) * 100)); ?>
                                <div class="save">Save <?php echo $percentage ?>%</div>
                              <?php endif;
                              echo $value['price_html'] ?></div>
                          </div>
                          <div class="product-page__subscribe-after">You'll receive Bio automatically every 30 days,
                            for the 12 month prepayment plan. Plans auto-renew. Change or cancel anytime.
                          </div>
                          <a class="product-page__subscribe-link" href="#">How do subscribtions work?</a>
                        <?php endif; ?>
                      </div>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>
              <?php endif; ?>
              <button type="submit" class="single_add_to_cart_button button alt blue product-page__add">Add to cart
                <span class="price"><?php echo '$' . $product->get_price(); ?></span></button>
              <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>"/>
              <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>"/>
              <input type="hidden" name="variation_id" class="variation_id" value="<?php echo $product->get_children()[0]; ?>"/>
              <div href="#info" class="button white product-page__how">How it works?</div>
            </form>
            <div class="product-page__advantages">
              <?php if (get_field('advantages-title')): ?>
                <div class="product-page__advantages-title"><?php the_field('advantages-title'); ?></div>
              <?php endif; ?>
              <?php if (get_field('about-list', 278)): ?>
                <ul class="product-page__advantages-list">
                  <?php while (have_rows('about-list', 278)): the_row() ?>
                    <li class="product-page__advantages-item">
                      <svg>
                        <use xlink:href="<?php echo IMAGES_PATH ?>/sprite-mainpage.svg#sb"></use>
                      </svg>
                      <span><?php the_sub_field('item') ?></span>
                    </li>
                  <?php endwhile; ?>
                </ul>
              <?php endif; ?>
            </div>
            <div class="product-page__accordeon">
              <?php if (get_field('ingredients')): ?>
                <div class="product-page__text">
                  <div class="product-page__text-title">
                    <span>Ingredients</span>
                    <svg>
                      <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                    </svg>
                  </div>
                  <div class="product-page__text-desc"><?php the_field('ingredients'); ?></div>
                </div>
              <?php endif; ?>
              <?php if (get_field('how-to-use')): ?>
                <div class="product-page__text">
                  <div class="product-page__text-title">
                    <span>How to use</span>
                    <svg>
                      <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#arrow"></use>
                    </svg>
                  </div>
                  <div class="product-page__text-desc"><?php the_field('how-to-use'); ?></div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="product-page__infograph">
          <div class="product-page__infograph-item">
            <svg class="product-page__infograph-img">
              <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-product.svg#colorless"></use>
            </svg>
            <div class="product-page__infograph-text">Colorless</div>
          </div>
          <div class="product-page__infograph-item">
            <svg class="product-page__infograph-img">
              <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-product.svg#flavorless"></use>
            </svg>
            <div class="product-page__infograph-text">Flavorless</div>
          </div>
          <div class="product-page__infograph-item">
            <svg class="product-page__infograph-img">
              <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-product.svg#no-calories"></use>
            </svg>
            <div class="product-page__infograph-text">No calories</div>
          </div>
          <div class="product-page__infograph-item">
            <svg class="product-page__infograph-img">
              <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-product.svg#no-sugar"></use>
            </svg>
            <div class="product-page__infograph-text">No sugar</div>
          </div>
          <div class="product-page__infograph-item">
            <svg class="product-page__infograph-img">
              <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-product.svg#odorless"></use>
            </svg>
            <div class="product-page__infograph-text">Odorless</div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <?php get_template_part('template-parts/basis'); ?>
    <?php get_template_part('template-parts/info'); ?>
    <?php get_template_part('template-parts/benefits'); ?>
    <?php get_template_part('template-parts/steps'); ?>
    <div class="product-page__cite">
      <div class="container">
        <?php
        $post_object = get_field('expert_cite');
        if ($post_object):
          $post = $post_object;
          setup_postdata($post);
          ?>
          <div class="product-page__cite-img img"><img src="<?php the_post_thumbnail_url() ?>"
                                                       alt="<?php the_title(); ?>"></div>
          <h3 class="main-text product-page__cite-text"><?php the_content(); ?></h3>
          <div class="product-page__cite-job"><?php the_field('expert-job'); ?></div>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>
    </div>

    <div class="product-reviews block" id="reviews">
      <div class="container">
        <h3 class="block-title product-reviews__title">What customers are saying</h3>
        <div class="product-reviews__wrap">
          <div class="product-reviews__list-wrap">
            <ul class="product-reviews__list">
              <?php
              $args = [
                  'post_type' => 'product',
                  'number' => 4,
                  'post_id' => $product->get_id(),
                  'status' => 'approve',
              ];
              $comments = get_comments($args);
              wp_list_comments(array('callback' => 'woocommerce_comments'), $comments);
              $total = wp_count_comments($product->get_id())->approved;
              ?>
            </ul>
            <?php if ($total > 4): ?>
              <button class="product-reviews__more button white"
                      data-offset="4"
                      data-product="<?php echo $product->get_id(); ?>"
                      data-total="<?php echo $total ?>"
                      data-order="comment_date_gmt"
                      data-sort="DESC"
                      id="load-reviews"
              >Show more
              </button>
            <?php endif; ?>
          </div>
          <div class="product-reviews__sidebar">
            <button class="button white product-reviews__add open-modal-review">Leave review</button>
            <div class="product-reviews__popular">
              <div class="product-reviews__rating">
                <div class="product-reviews__rating-number">
                  <?php echo round($product->get_average_rating(), 1) ?>
                </div>
                <div class="product-reviews__rating-after">
                  <div class="product-reviews__rating-bg">
                    <div class="product-reviews__rating-fill" style="width: <?php echo $rating_width ?>%"></div>
                  </div>
                  <div class="product-reviews__reviews">Based on <?php echo $product->get_review_count(); ?> reviews</div>
                </div>

              </div>
            </div>
            <div class="product-reviews__table">
              <?php $args = [
                  'post_type' => 'product',
                  'post_id' => $product->get_id(),
                  'status' => 'approve'
              ];
              $all_comments = get_comments($args);
              $rating_arr = [0, 0, 0, 0, 0];
              ?>
              <?php foreach ($all_comments as $comment): ?>
                <?php $user_rate = intval(get_comment_meta($comment->comment_ID, 'rating', true));
                $rating_arr[$user_rate - 1] += 1;
                ?>
              <?php endforeach; ?>
              <?php $count = count($rating_arr);
              $i = $count;
              ?>
              <?php foreach (array_reverse($rating_arr) as $myArrayElement): ?>
                <div class="product-reviews__table-row">
                  <span class="number"><?php echo $i-- ?></span>
                  <div class="row">
                    <?php $width = $myArrayElement / $total * 100; ?>
                    <span class="fill" style="width: <?php echo $width . '%'; ?>"></span>
                  </div>
                  <span><?php echo $myArrayElement ?></span>
                </div>
              <?php endforeach; ?>
              <div class="product-reviews__sort">
                <select name="review-sort" id="review-sort" class="select-type-1" data-product="<?php the_ID(); ?>">
                  <option value="recent" data-order="comment_date_gmt">Most recent</option>
                  <option value="hight" data-order="rating" data-sort="DESC">Highest Rated</option>
                  <option value="low" data-order="rating" data-sort="ASC">Lowest Rated</option>
                </select>
              </div>
            </div>
            <!--            --><?php //if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>
            <!--              <div id="review_form_wrapper">-->
            <!--                <div id="review_form">-->
            <!--                  --><?php
            //                  $commenter = wp_get_current_commenter();
            //                  $comment_form = array(
            //                    /* translators: %s is product title */
            //                      'title_reply' => have_comments() ? esc_html__('Add a review', 'woocommerce') : sprintf(esc_html__('Be the first to review &ldquo;%s&rdquo;', 'woocommerce'), get_the_title()),
            //                    /* translators: %s is product title */
            //                      'title_reply_to' => esc_html__('Leave a Reply to %s', 'woocommerce'),
            //                      'title_reply_before' => '<span id="reply-title" class="comment-reply-title">',
            //                      'title_reply_after' => '</span>',
            //                      'comment_notes_after' => '',
            //                      'label_submit' => esc_html__('Submit', 'woocommerce'),
            //                      'logged_in_as' => '',
            //                      'comment_field' => '',
            //                  );
            //
            //                  $name_email_required = (bool)get_option('require_name_email', 1);
            //                  $fields = array(
            //                      'author' => array(
            //                          'label' => __('Name', 'woocommerce'),
            //                          'type' => 'text',
            //                          'value' => $commenter['comment_author'],
            //                          'required' => $name_email_required,
            //                      ),
            //                      'email' => array(
            //                          'label' => __('Email', 'woocommerce'),
            //                          'type' => 'email',
            //                          'value' => $commenter['comment_author_email'],
            //                          'required' => $name_email_required,
            //                      ),
            //                  );
            //
            //                  $comment_form['fields'] = array();
            //
            //                  foreach ($fields as $key => $field) {
            //                    $field_html = '<p class="comment-form-' . esc_attr($key) . '">';
            //                    $field_html .= '<label for="' . esc_attr($key) . '">' . esc_html($field['label']);
            //
            //                    if ($field['required']) {
            //                      $field_html .= '&nbsp;<span class="required">*</span>';
            //                    }
            //
            //                    $field_html .= '</label><input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" type="' . esc_attr($field['type']) . '" value="' . esc_attr($field['value']) . '" size="30" ' . ($field['required'] ? 'required' : '') . ' /></p>';
            //
            //                    $comment_form['fields'][$key] = $field_html;
            //                  }
            //
            //                  $account_page_url = wc_get_page_permalink('myaccount');
            //                  if ($account_page_url) {
            //                    /* translators: %s opening and closing link tags respectively */
            //                    $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a review.', 'woocommerce'), '<a href="' . esc_url($account_page_url) . '">', '</a>') . '</p>';
            //                  }
            //
            //                  if (wc_review_ratings_enabled()) {
            //                    $comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__('Your rating', 'woocommerce') . (wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '') . '</label><select name="rating" id="rating" required>
            //						<option value="">' . esc_html__('Rate&hellip;', 'woocommerce') . '</option>
            //						<option value="5">' . esc_html__('Perfect', 'woocommerce') . '</option>
            //						<option value="4">' . esc_html__('Good', 'woocommerce') . '</option>
            //						<option value="3">' . esc_html__('Average', 'woocommerce') . '</option>
            //						<option value="2">' . esc_html__('Not that bad', 'woocommerce') . '</option>
            //						<option value="1">' . esc_html__('Very poor', 'woocommerce') . '</option>
            //					</select></div>';
            //                  }
            //
            //                  $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__('Your review', 'woocommerce') . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';
            //
            //                  comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
            //                  ?>
            <!--                </div>-->
            <!--              </div>-->
            <!--            --><?php //endif; ?>
          </div>
        </div>
      </div>
    </div>

    <?php get_template_part('template-parts/team'); ?>
    <?php get_template_part('template-parts/research'); ?>
    <?php get_template_part('template-parts/faq'); ?>
  <?php endwhile; ?>
</main>
<?php get_template_part('template-parts/footer/footer'); ?>

