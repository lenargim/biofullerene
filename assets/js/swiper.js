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
            draggable: true,
        },
        a11y: {
            enabled: false,
        },
        breakpoints: {
            320: {
                slidesPerView: 'auto',
                spaceBetween: 24,
                allowTouchMove: true,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 24,
            },
        },
        1280: {
            slidesPerView: 2,
            spaceBetween: 32,
        }
    });

    const reviews = new Swiper('.reviews__slider', {
        allowTouchMove: false,
        speed: 200,
        navigation: {
            nextEl: '.reviews-next',
            prevEl: '.reviews-prev',
            disabledClass: 'navigation-disabled',
        },
        scrollbar: {
            el: '.custom-scrollbar',
            draggable: true,
        },
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 'auto',
                spaceBetween: 24,
                allowTouchMove: true,
                scrollbar: false,
            },
            // when window width is >= 480px
            1024: {
                slidesPerView: 2,
                spaceBetween: 24
            },
            1280: {
                slidesPerView: 3,
                spaceBetween: 32,
            }
        }
    });

    const products = new Swiper('.mainpage-multiple__slider', {
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
            draggable: true,
        },
        breakpoints: {
            320: {
                allowTouchMove: true,
                slidesPerView: 'auto',
            },
            768: {
                slidesPerView: 2,
            },
            1280: {
                slidesPerView: 3,
            }
        }
    });

    const productThumbs = new Swiper('.product-page__thumbs', {
        slidesPerView: 'auto',
        speed: 200,
        spaceBetween: 8,
        allowTouchMove: false,
    });


    if (productThumbs) {
        const product = new Swiper('.product-page__slider', {
            slidesPerView: 1,
            speed: 200,
            spaceBetween: 32,
            pagination: {
                el: '.product-page__thumbs-mobile',
                type: 'bullets',
            },
            thumbs: {
                swiper: productThumbs,
            },
            breakpoints: {
                320: {
                    allowTouchMove: true,
                },
                1280: {
                    allowTouchMove: false,
                }
            }
        });
    }


    const related = new Swiper('.single-post__slider', {
        speed: 200,
        spaceBetween: 32,
        navigation: {
            nextEl: '.related-next',
            prevEl: '.related-prev',
            disabledClass: 'navigation-disabled',
        },
        scrollbar: {
            el: '.custom-scrollbar',
            draggable: true,
        },
        breakpoints: {
            320: {
                slidesPerView: 'auto',
                allowTouchMove: true,
            },
            768: {
                slidesPerView: 2,
                allowTouchMove: false,
            },
            1024: {
                slidesPerView: 3,
                allowTouchMove: false,
            },
        }
    })

    const about = new Swiper('.about__slider', {
        slidesPerView: 2,
        allowTouchMove: false,
        speed: 200,
        spaceBetween: 32,
        navigation: {
            nextEl: '.about-next',
            prevEl: '.about-prev',
            disabledClass: 'navigation-disabled',
        },
        breakpoints: {
            320: {
                slidesPerView: 'auto',
            },
            768: {
                slidesPerView: 2,
            },

        }
    })

    const modalReviews = new Swiper('.modal-reviews', {
        slidesPerView: 1,
        allowTouchMove: false,
        speed: 200,
        spaceBetween: 100,
        navigation: {
            nextEl: '.modal-next',
            prevEl: '.modal-prev',
            disabledClass: 'navigation-disabled',
        },
    })

    $('.reviews__item-full').on('click', function () {
        let index = $(this).parents('.swiper-slide').index();
        modalReviews.slideTo(index, 0)
    })

});