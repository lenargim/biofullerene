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
  console.log('qwe')
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
        name.prepend(`<span class="pseudo">${qty}</span>`);
        name.append(`<span class="deleted">&ensp;was deleted</span>`);

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
        cancel.removeClass('cancel').text('Remove');
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
