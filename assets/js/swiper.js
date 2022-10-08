$(document).ready(function () {
  const team = new Swiper('.team__slider', {
    slidesPerView: 2,
    allowTouchMove: false,
    speed: 200,
    spaceBetween: 32,
    navigation: {
      nextEl: '.team-next',
      prevEl: '.team-prev',
      disabledClass: 'navigation-disabled',
    },
    scrollbar: {
      el: '.custom-scrollbar',
    },
    a11y: {
      enabled: false,
    },
  });

  const reviews = new Swiper('.reviews__slider', {
    slidesPerView: 3,
    allowTouchMove: false,
    speed: 200,
    spaceBetween: 32,
    navigation: {
      nextEl: '.reviews-next',
      prevEl: '.reviews-prev',
      disabledClass: 'navigation-disabled',
    },
    scrollbar: {
      el: '.custom-scrollbar',
    },
  });

  const products = new Swiper('.mainpage-multiple__slider', {
    slidesPerView: 3,
    allowTouchMove: false,
    speed: 200,
    spaceBetween: 32,
    navigation: {
      nextEl: '.products-next',
      prevEl: '.products-prev',
      disabledClass: 'navigation-disabled',
    },
    scrollbar: {
      el: '.custom-scrollbar',
    },
  });

  const productThumbs = new Swiper('.product-page__thumbs', {
    slidesPerView: 'auto',
    speed: 200,
    spaceBetween: 8,
    allowTouchMove: false,
  });


  const product = new Swiper('.product-page__slider', {
    slidesPerView: 1,
    allowTouchMove: false,
    speed: 200,
    spaceBetween: 32,
    thumbs: {
      swiper: productThumbs,
    }
  });


});