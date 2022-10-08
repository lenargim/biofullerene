$(document).ready(function () {
    $('body').on('blur change', '#billing_first_name, #billing_last_name, #shipping_city', function () {
        const wrapper = $(this).closest('.validate-required');
        // you do not have to removeClass() because Woo do it in checkout.js
        if (/\d/.test($(this).val()) || !$(this).val()) { // check if contains numbers
            wrapper.addClass('invalid').removeClass('validated'); // error
        } else {
            wrapper.addClass('validated').removeClass('invalid'); // success
        }
    });

    $('body').on('blur change', '#shipping_address_1, #shipping_address_2, #shipping_postcode', function () {
        const wrapper = $(this).closest('.validate-required');
        if (!$(this).val()) {
            wrapper.addClass('invalid').removeClass('validated'); // error
        } else {
            wrapper.addClass('validated').removeClass('invalid'); // success
        }
    });


    $('body').on('blur change', '#billing_email', function () {
        let val = $(this).val();
        const wrapper = $(this).closest('.validate-required');

        // you do not have to removeClass() because Woo do it in checkout.js
        if (!validateEmail(val) || !val) { // check if contains numbers
            wrapper.addClass('invalid').removeClass('validated'); // error
        } else {
            wrapper.addClass('validated').removeClass('invalid'); // success
        }
    });

    function validateEmail(val) {
        const emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test(val);
    }

    $('.open-contacts-part').on('click', function () {
        $('.shipping-part').hide();
        $('.method-part').hide();
        $('.saved-part').hide();
        $('.saved__box').removeClass('active');
        $('.contacts-part').show();
        $('.checkout__breadcrumbs span').removeClass('active');
        $('.checkout__breadcrumbs span:nth-child(-n+1)').addClass('active');
    });

    $('.open-shipping-part').on('click', function () {
        let checker = [];
        $('.first-validation').each(function () {
            checker.push($(this).hasClass('validated'));
        })
        if (!checker.includes(false)) {
            $('.checkout-part').hide();
            $('.method-part').hide();
            $('.saved-part').show();
            $('.saved__box:first-child').addClass('active');
            $('.saved__box:last-child').removeClass('active');
            $('.shipping-part').show();
            const firstName = $('#billing_first_name').val();
            const lastName = $('#billing_last_name').val();
            const phone = $('#billing_phone').val();
            const email = $('#billing_email').val();
            $('.saved-name').text(`${firstName} ${lastName}`)
            $('.saved-phone').text(`${phone}`)
            $('.saved-email').text(`${email}`)
            $('.checkout__breadcrumbs span').removeClass('active');
            $('.checkout__breadcrumbs span:nth-child(-n+2)').addClass('active');
        } else {
            $('.first-validation').each(function () {
                $(this).hasClass('validated') ? true : $(this).addClass('invalid')
            })
        }
    });


    $('.open-method-part').on('click', function () {
        let checker = [];
        $('.second-validation').each(function () {
            checker.push($(this).hasClass('validated'));
        })
        if (!checker.includes(false)) {
            $('.shipping-part').hide();
            $('.saved-part').show();
            $('.saved__box').addClass('active');
            $('.method-part').show();
            const country = $('#shipping_country').val();
            const address = $('#shipping_address_1').val();
            const appartment = $('#shipping_address_2').val();
            const city = $('#shipping_city').val();
            const state = $('#shipping_state').val();
            const post = $('#shipping_postcode').val();
            $('.saved__box-row').text(`${appartment} ${address}, ${city} ${state}, ${post}, ${country}`)
            $('.checkout__breadcrumbs span').removeClass('active');
            $('.checkout__breadcrumbs span:nth-child(-n+3)').addClass('active');
        } else {
            $('.second-validation').each(function () {
                $(this).hasClass('validated') ? true : $(this).addClass('invalid')
            })
        }
    })
})