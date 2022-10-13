$(document).ready(function () {
  $('.header__cart').on('click', openMiniCart);

  $('body').on('added_to_cart', function (e, fragments, cart_hash, this_button) {
    get_cart()
  });

  $('body').on('click', '.mini-cart__remove', function () {
    var key = $(this).data('key');
    var item = $(this).parents('.mini-cart__item');

    if ($(this).hasClass('cancel')) {
      cancel_item(key, item)
    } else {
      remove_item(key, item);
    }
  });

  $('body').on('click', '.mini-cart__update', function () {
    quanity_update_buttons($(this));
  });

  $('body').on('blur', '.item_quanity', function () {
    quanity_update($(this));
  });

  $(document).on('click', '.single_add_to_cart_button', function (e) {
    let ajax_url = window.ajaxVar.ajaxurl || false;
    e.preventDefault();
    var $button = $(this),
      $form = $button.closest('form.cart'),
      product_id = $form.find('input[name=add-to-cart]').val();

    if (!product_id)
      return;

    if ($button.is('.disabled'))
      return;
    var data = {
      action: 'add_to_cart',
      'add-to-cart': product_id,
    };

    $form.serializeArray().forEach(function (element) {
      data[element.name] = element.value;
    });

    $(document.body).trigger('adding_to_cart', [$button, data]);
    $.ajax({
      type: 'post',
      url: ajax_url,
      data: data,
      beforeSend: function (response) {
        $button.addClass('loading');
      },
      complete: function (response) {
        $button.removeClass('loading');
      },
      success: function (response) {

        if (response.error & response.product_url) {
          window.location = response.product_url;
          return;
        } else {
          $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $button]);
        }
      },
    });
    return false;
  });

});
let is_cart_update = true;

function openMiniCart() {
  $('.overlay').addClass('active');
  $('.mini-cart').addClass('active');
}

function get_cart() {
  let ajax_url = window.ajaxVar.ajaxurl || false;
  if (!is_cart_update) return;
  is_cart_update = false;
  $('.list-loader').addClass('loading');

  $.ajax({
    type: 'POST',
    url: ajax_url,
    data: {
      dataType: "html",
      action: 'get_cart',
      contentType: "application/json; charset=utf-8",
    },
    success: function (response) {
      const cart_response = JSON.parse(response);
      const count = cart_response['count'];
      let html = cart_response['html'];
      $('.mini-cart .after').remove();
      $('.mini-cart__title').after(html);
      $('.count').html(count);
      $('.list-loader').removeClass('loading');
      openMiniCart();
      is_cart_update = true;
    }
  });
}

function quanity_update_buttons(el) {
  let ajax_url = window.ajaxVar.ajaxurl || false;
  if (el.hasClass('disabled')) return;
  if (is_cart_update) {
    $('.list-loader').addClass('loading');
    is_cart_update = false;
    var wrap = $(el).parents('.mini-cart__item');
    var input = $(wrap).find('.quanity');
    var key = $(input).data('key');
    var number = parseInt($(input).val());
    var type = $(el).data('type');
    if (type === 'minus') {
      number--;
      if (number < 1) {
        number = 1;
      }
    } else {
      number++;
    }
    const minus = input.siblings('.minus ');
    number === 1 ? minus.addClass('disabled') : minus.removeClass('disabled');

    $.ajax({
      type: 'POST',
      url: ajax_url,
      data: {
        action: 'quanity_update',
        key: key,
        number: number,
      },
      success: function (data) {
        const response = JSON.parse(data);
        let total = response.total;
        let subtotal = response.subtotal;
        let count = response.count;
        let varId = response.variation_id;
        let itemRegPrice = +response.item_reg_price;
        let itemPrice = +response.item_price;
        let itemQuantity = +response.item_quantity;

        let item = $(`.mini-cart__item[data-id="${varId}"]`);
        item.find('.regular-price').html(itemRegPrice * itemQuantity);
        item.find('.current-price').html(itemPrice * itemQuantity);

        $('.total').html(total);
        $('.subtotal').html(subtotal);
        $('.count').html(count);
      },
      error: function (error) {
        console.log(error)
      },
      complete: function () {
        $(input).val(number);
        is_cart_update = true;
        $('.list-loader').removeClass('loading');
      }
    });
  }
}

function quanity_update(input) {
  let ajax_url = window.ajaxVar.ajaxurl || false;
  const inputEl = input;
  if (inputEl.hasClass('disabled')) return;
  if (is_cart_update) {
    is_cart_update = false;
    $('.list-loader').addClass('loading');
    var wrap = inputEl.parents('.mini-cart__item');
    var key = inputEl.data('key');
    var number = parseInt(inputEl.val());

    const minus = inputEl.siblings('.quanity_minus');
    number === 1 ? minus.addClass('disabled') : minus.removeClass('disabled');

    $.ajax({
      type: 'POST',
      url: ajax_url,
      data: {
        action: 'quanity_update',
        key: key,
        number: number,
      },
      success: function (data) {
        const response = JSON.parse(data);
        let total = response.total;
        let subtotal = response.subtotal;
        let count = response.count;
        let varId = response.variation_id;
        let itemRegPrice = +response.item_reg_price;
        let itemPrice = +response.item_price;
        let itemQuantity = +response.item_quantity;

        let item = $(`.mini-cart__item[data-id="${varId}"]`);
        item.find('.regular-price').html(itemRegPrice * itemQuantity);
        item.find('.current-price').html(itemPrice * itemQuantity);

        $('.total').html(total);
        $('.subtotal').html(subtotal);
        $('.count').html(count);
      },
      error: function (error) {
        console.log(error)
      },
      complete: function () {
        $(input).val(number);
        is_cart_update = true;
        $('.list-loader').removeClass('loading');
      }
    });
  }
}

function remove_item(key, item) {
  let ajax_url = window.ajaxVar.ajaxurl || false;
  if (is_cart_update) {
    is_cart_update = false;
    $('.list-loader').addClass('loading');

    $.ajax({
      type: 'POST',
      url: ajax_url,
      data: {
        action: 'delete_item',
        key: key,
      },
      success: function (response) {
        const cart_response = JSON.parse(response);
        $('.count').html(cart_response['count']);
        $('.total').html(cart_response['total']);
        $('.subtotal').html(cart_response['subtotal']);
        item.addClass('removing');
        const cancel = item.find('.mini-cart__remove');
        cancel.addClass('cancel').text('Cancel');
        const qty = item.find('.mini-cart__quantity').val();
        const name = item.find('.mini-cart__name');
        name.append(`<span class="deleted">was deleted</span>`)
        name.prepend(`<span class="pseudo">${qty}</span>`);

        if (!$('.mini-cart__item:not(.removing)').length) {
          $('.mini-cart__buttons .button').addClass('disabled');
        }
      },
      error: function (error) {
        console.log(error);
      },
      complete: function () {
        is_cart_update = true;
        $('.list-loader').removeClass('loading');
      }
    });
  }
}

function cancel_item(key, block) {
  let ajax_url = window.ajaxVar.ajaxurl || false;
  if (is_cart_update) {
    is_cart_update = false;
    $('.list-loader').addClass('loading');
    block.removeClass('removing');
    const prodId = block.data('id');
    const qty = parseInt(block.find('.mini-cart__quantity').val());
    const cancel = block.find('.mini-cart__remove');
    const name = block.find('.mini-cart__name');
    $.ajax({
      type: 'POST',
      url: ajax_url,
      data: {
        action: 'cancel_delete',
        key: key,
        qty: qty,
        id: prodId,
      },
      success: function (data) {
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
          cancel.removeClass('cancel').html('<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
              '    <path d="M2 3.99967H3.33333M3.33333 3.99967H14M3.33333 3.99967V13.333C3.33333 13.6866 3.47381 14.0258 3.72386 14.2758C3.97391 14.5259 4.31304 14.6663 4.66667 14.6663H11.3333C11.687 14.6663 12.0261 14.5259 12.2761 14.2758C12.5262 14.0258 12.6667 13.6866 12.6667 13.333V3.99967H3.33333ZM5.33333 3.99967V2.66634C5.33333 2.31272 5.47381 1.97358 5.72386 1.72353C5.97391 1.47348 6.31304 1.33301 6.66667 1.33301H9.33333C9.68696 1.33301 10.0261 1.47348 10.2761 1.72353C10.5262 1.97358 10.6667 2.31272 10.6667 2.66634V3.99967M6.66667 7.33301V11.333M9.33333 7.33301V11.333" stroke="#8791A1" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>\n' +
              '</svg>\n');
        } else {
          cancel.removeClass('cancel').text('Remove');
        }
        name.find('.pseudo, .deleted').remove();

        if ($('.mini-cart__item:not(.removing)').length) {
          $('.mini-cart__buttons .button').removeClass('disabled');
        }
        const response = JSON.parse(data);
        let total = response.total;
        let subtotal = response.subtotal;
        let count = response.count;
        $('.total').html(total);
        $('.subtotal').html(subtotal);
        $('.count').html(count);
      },
      error: function (error) {
        console.log(error);
      },
      complete: function () {
        is_cart_update = true;
        $('.list-loader').removeClass('loading');
      },
    });
  }
}
