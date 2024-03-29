$(document).ready(function () {
    $('body').on('blur change', '#billing_first_name, #billing_last_name, #shipping_city, #shipping_state', function () {
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
        $('.checkout-part').hide();
        $('.contacts-part').show();
        $('.first-validation').removeClass('invalid')
        $('.saved__box').removeClass('active');
        $('.checkout__breadcrumbs span').removeClass('active');
        $('.checkout__breadcrumbs span:nth-child(-n+1)').addClass('active');
    });

    $('.open-shipping-part').on('click', function () {
        let checker = [];
        $('.first-validation').each(function () {
            checker.push($(this).hasClass('validated'));
        })
        $('.second-validation').removeClass('invalid')
        if (!checker.includes(false)) {
            $('.checkout-part').hide();
            $('.shipping-part').show();
            $('.saved-part').show();
            $('.saved__box:first-child').addClass('active');
            $('.saved__box:last-child').removeClass('active');
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
        $('.first-validation, .second-validation').each(function () {
            checker.push($(this).hasClass('validated'));
        })
        $('.third-validation').removeClass('invalid')
        if (!checker.includes(false)) {
            $('.checkout-part').hide();
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
            $('.first-validation, .second-validation').each(function () {
                $(this).hasClass('validated') ? true : $(this).addClass('invalid')
            })
        }
    })

    $('.open-payment-part').on('click', function () {
        let checker = [];
        $('.first-validation, .second-validation, .third-validation').each(function () {
            checker.push($(this).hasClass('validated'));
        })
        if (!checker.includes(false)) {
            $('.checkout-part').hide();
            $('.saved-part').hide();
            $('.payment-part').show();
            $('.checkout__breadcrumbs span').addClass('active');
        } else {
            $('.first-validation, .second-validation, .third-validation').each(function () {
                $(this).hasClass('validated') ? true : $(this).addClass('invalid')
            })
        }
    });

    $('.checkout__summary').on('click', function () {
        $(this).toggleClass('open');
        $('.checkout__data').slideToggle();
    });

    $('#shipping_country').select2({
        dropdownParent: $('#shipping_country_field')
    });
    $('#shipping_state').select2({
        dropdownParent: $('#shipping_state_field')
    });


    $('#shipping_state, #shipping_country').on('select2:select', function (e) {
        $(this).parents('.validate-required').addClass('validated').removeClass('invalid');

        const ajax_url = window.ajaxVar.ajaxurl || false;
        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                action: 'update_shipping_method',
            },
            success: function (data) {
                $('.checkout__method').html(data);
                $('body').trigger('update_checkout');
            },
            error: function (error) {
                console.log(error)
            },
        });
    });

    $('#shipping_country').on('select2:select', function (e) {
        if ($('#shipping_state').find('option').length) {
            $('#shipping_state').select2({
                dropdownParent: $('#shipping_country_field')
            })
        }
        ;
    });

})