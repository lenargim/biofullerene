$ = jQuery;
$(document).ready(function () {
  // Mask
  $('input[type="tel"]').mask('+1(000)000-0000', {translation: {'Z': {pattern: /[0-79]/}}});


  $('.cross').on('click', closeShippingPopup);

  $('.faq__item').on('click', function () {
    $(this).toggleClass('opened');
  })

  $('.copy-link').on('click', copyToClipboard);

  const docTitle = $(document).attr('title');
  const tw = `https://twitter.com/intent/tweet/?text=${docTitle}&url=${window.location.href}`;
  const tg = `https://t.me/share/url?url=${window.location.href}&text=${docTitle}`;
  $('.share-twitter').attr('href', tw);
  $('.share-telegram').attr('href', tg);

  $('.product-page__type-input').on('change', function () {
    const prodType = $('input[name="product-type"]:checked').val();
    $('.product-page__block').attr('class', `product-page__block ${prodType}`);

    if ($(this).val() === 'subscribe') {
      const id = $('.product-page__subscribe').data('id');
      const price = $('.product-page__subscribe').data('price');
      singleAddToCart(id, price)
    } else if ($(this).val() === 'individual') {
      const id = $('.product-page__variation-input:checked').data('id');
      const price = $('.product-page__variation-input:checked').data('price');
      singleAddToCart(id, price)
    }
  });

  $('.product-page__variation-input').on('change', function () {
    const prodType = $('input[name="product-individual"]:checked');
    const id = prodType.data('id');
    const price = prodType.data('price');
    singleAddToCart(id, price)
  });

  $('.product-page__text').on('click', function () {
    $(this).toggleClass('opened');
  })

  $('.product-page__how').on('click', function (e) {
    e.preventDefault();
    const blockId = $(this).attr("href");
    $('html,body').animate({scrollTop: $(blockId).offset().top},'slow');
  })

  $('.product-page__popular').on('click', function (e) {
    e.preventDefault();
    const blockId = '#'+$(this).data("scroll");
    $('html,body').animate({scrollTop: $(blockId).offset().top},'slow');
  })
  $('.modal .close').on('click', function () {
    $('.overlay').removeClass('active');
    $('.modal').removeClass('active');
  })

});

$(document).scroll(function () {
  const header = $('.header');
  if ($(this).scrollTop() > 0) {
    header.addClass('sticky');
    if (!header.hasClass('transparent')) {
      const height = header.height();
      $('body').css('padding-top', `${height}px`);
    }
  } else {
    header.removeClass('sticky');
    if (!header.hasClass('transparent')) {
      $('body').css('padding-top', 0);
    }
  }
})

closeShippingPopup = () => {
  $('.header__shipping').addClass('closed');
  document.cookie = "shipping_popup=close"
};
const copyToClipboard = () => {
  window.navigator.clipboard.writeText(window.location.href);
  // let $temp = $("<input>");
  // $("body").append($temp);
  // $temp.val(window.location.href).select();
  // document.execCommand("copy");
  // $temp.remove();
  // $('.copy-link span').text('Copied');
}

const singleAddToCart = (id, price) => {
  $('.product-page__add .price').text(`$${price}`);
  $('.variation_id').val(id)
}