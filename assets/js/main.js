$ = jQuery;
$(document).ready(function () {
    // Mask
    $('input[type="tel"]').mask('+0000-000-00-00-00-00-00');

    $('input[name="question-order"]').mask('000-000-000');
    $('#age').mask('ZZZ', {translation: {'Z': {pattern: /[0-9]/}}});

    $('.cross').on('click', closeShippingPopup);

    $('.faq__item').on('click', function () {
        $(this).toggleClass('opened');
    })

    $('.copy-link').on('click', function () {
        $(this).addClass('copied');
        setTimeout(() => {
            $(this).removeClass('copied');
        }, 3000)
        copyToClipboard($(this));
    });
    $('.copy-text').on('click', function () {
        const text = $(this).find('.text').text();
        console.log(text)
        if (!navigator.clipboard) {
            fallbackCopyTextToClipboard(text);
            return;
        }
        navigator.clipboard.writeText(text).then(function () {
            console.log('Async: Copying to clipboard was successful!');
        }, function (err) {
            console.error('Async: Could not copy text: ', err);
        });
        navigator.clipboard.writeText(text);

        $(this).addClass('copied');
        setTimeout(() => {
            $(this).removeClass('copied');
        }, 3000)
    });

    function fallbackCopyTextToClipboard(text) {
        var textArea = document.createElement("textarea");
        textArea.value = text;

        // Avoid scrolling to bottom
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";

        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            console.log('Fallback: Copying text command was ' + msg);
        } catch (err) {
            console.error('Fallback: Oops, unable to copy', err);
        }

        document.body.removeChild(textArea);
    }

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
        $('html,body').animate({scrollTop: $(blockId).offset().top}, 'slow');
    })

    $('.product-page__popular').on('click', function (e) {
        e.preventDefault();
        const blockId = '#' + $(this).data("scroll");
        $('html,body').animate({scrollTop: $(blockId).offset().top}, 'slow');
    })
    $('body').on('click', '.close', function () {
        $('.overlay').removeClass('active');
        $('.modal').removeClass('active');
    })

    $('body').on('click', '.remove-cookie', function () {
        console.log('removing');

        //$.removeCookie('review_added', { path: '/' });
        document.cookie = 'review_added=; Max-Age=0; path=/; domain=' + location.hostname;
    })

    $(document).on('click', '.company-page__link', function (e) {
        e.preventDefault();
        var id = $(this).attr('href');
        $('html,body').animate({scrollTop: $(id).offset().top - 80}, 500);
    });

    $('body').on('click', '.locations__tab:not(.active)', function () {
        $('.locations__tab').removeClass('active');
        $(this).addClass('active');
        let index = $(this).index();
        let activeBlock = $('.locations__section .locations__item').eq(index);
        $('.locations__section .locations__item').removeClass('active');
        activeBlock.addClass('active');
        let src = activeBlock.find('.map').data('src');
        activeBlock.find('.map').attr('src', src);
    })

    let src = $('.locations__item.active .map').data('src');
    $('.locations__item.active .map').attr('src', src);

    $('.set-cookies').on('click', function () {
        const val = $(this).text();
        $('.header__cookies').hide();
        document.cookie = `cookies_popup=${val}`
    })


    $('.reviews__item-full').on('click', function () {
        if ($('.modal-reviews').hasClass('loaded')) {
            $('.overlay').addClass('active');
            $('.modal-reviews').addClass('active');
            return;
        }
        const id = $(this).data('id');
        const ajax_url = window.ajaxVar.ajaxurl || false;
        $.ajax({
            type: 'POST',
            url: ajax_url, // получаем из wp_localize_script()
            data: {
                action: 'modal_reviews', // экшен для wp_ajax_ и wp_ajax_nopriv_
                id,
            },
            success: function (data) {
                $('.overlay').addClass('active');
                $('.modal-reviews').addClass('active loaded');
                $('.modal-reviews .swiper-wrapper').html(data);
            },
        });
    });


    $('.open-modal-help').on('click', function (e) {
        e.preventDefault();
        $('.overlay').addClass('active');
        $('.modal-help').addClass('active');
    });

    $('.open-subscription').on('click', function (e) {
        e.preventDefault();
        $('.overlay').addClass('active');
        $('.modal-subscription').addClass('active');
    });

    $('.open-modal-question').on('click', function (e) {
        e.preventDefault();
        $('.overlay').addClass('active');
        $('.modal').removeClass('active');
        $('.modal-question').addClass('active');
    });

    $('.open-modal-review').on('click', function (e) {
        e.preventDefault();
        $('.overlay').addClass('active');
        $('.modal').removeClass('active');
        $('.modal-review').addClass('active');
    });

    $('.modal-question__submit').attr("disabled", true);
    $('.modal .validate-required input, .modal .validate-required textarea').on('input change blur', function () {
        let wrap = $(this).parents('.validate-required')
        let val = $(this).val();
        if (val) {
            wrap.addClass('validated').removeClass('invalid')
            if ($(this).attr('name') === 'question-email') {
                if (!validateEmail(val) || !val) { // check if contains numbers
                    wrap.addClass('invalid').removeClass('validated'); // error
                } else {
                    wrap.addClass('validated').removeClass('invalid'); // success
                }
            }
        } else {
            wrap.addClass('invalid').removeClass('validated')
        }
        const form = $(this).parents('form');
        checkSubmit(form)
    })

    $('body').on('click', 'a[class^=star]', function () {
        $(this).parents('.validate-required').addClass('validated').removeClass('invalid')
    });

    $('.comment-form').on('submit', function (e) {
        $(this).find('.validate-required').not('.validated').each(function () {
            e.preventDefault();
            $(this).addClass('invalid')
        });
    })

    function checkSubmit(form) {
        let arr = []
        const submit = form.find('input[type="submit"]')
        form.find('.validate-required').each(function () {
            arr.push($(this).hasClass('validated'))
        });
        if (arr.includes(false)) {
            submit.attr("disabled", true);
        } else {
            submit.attr("disabled", false);
        }
    };

    function validateEmail(val) {
        const emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test(val);
    }

    $('.closed-bottom').on('click', function () {
        $('.close').click();
    });

    const questionForm = document.querySelector('.modal-question__form');
    if (questionForm) {
        questionForm.addEventListener('wpcf7mailsent', function (event) {
            var inputs = event.detail.inputs;
            for (let i = 0; i < inputs.length; i++) {
                if ('question-email' == inputs[i].name) {
                    $('.thx-email').text(inputs[i].value)
                    break;
                }
            }
            $('.modal-question').removeClass('active');
            $('.modal-send').addClass('active');
        }, false);
    }


    // Mobile

    $('.burger').on('click', function () {
        $('.header').addClass('opened')
        $('html, body').css('overflowY', 'hidden')
    })

    $('.burger__cross').on('click', function () {
        $('.header').removeClass('opened');
        $('html, body').css('overflowY', 'initial')
    })

    $('.mobile__menu .menu-item-has-children > a').on('click', function (e) {
        e.preventDefault();
        $(this).siblings('.submenu').toggle()
    })

    $('.share').on('click', function () {
        $(this).toggleClass('active');
    })
    $(document).mouseup(function (e) { // событие клика по веб-документу
        var div = $(".share"); // тут указываем ID элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            div.removeClass('active');
        }
    });


    // $('#shipping__list').select2({
    //     theme: "classic",
    //     dropdownParent: $('#shipping'),
    //     selectionCssClass: 'shipping__selection',
    //     dropdownCssClass: 'shipping__dropdown',
    //     // templateResult: formatState,
    // })

    const shipList = $('.shipping__list');
    const shipItem = shipList.find('.shipping__item');
    const name = shipItem.first().find('.name').text()
    const price = shipItem.first().find('.price').text()
    const current = shipList.siblings('.shipping__selection')
    current.find('.name').text(name)
    current.find('.price').text(price)
    current.on('click', function () {
        $(this).parent().toggleClass('open')
    })

    shipItem.on('click', function () {
        const name = $(this).find('.name').text()
        const price = $(this).find('.price').text()
        current.find('.name').text(name)
        current.find('.price').text(price)
        $(this).parents('.shipping__wrap').removeClass('open')
    })


    $(document).mouseup(function (e) {
        const modal = $(".modal");
        const shippingWrap = $('.shipping__wrap');
        if (!modal.is(e.target)
            && modal.has(e.target).length === 0) {
            modal.removeClass('active')
            $('.overlay').removeClass('active')
        }

        if (shippingWrap.length) {
            if (!shippingWrap.is(e.target)
                && shippingWrap.has(e.target).length === 0) {
                shippingWrap.removeClass('open')
            }
        }
    });
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
const copyToClipboard = (el) => {
    el.find('span').text('Copied!')
    window.navigator.clipboard.writeText(window.location.href);
}

const singleAddToCart = (id, price) => {
    $('.product-page__add .price').text(`$${price}`);
    $('.variation_id').val(id)
}