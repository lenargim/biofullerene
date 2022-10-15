$(document).ready(function () {
  $('.select-type-1').each(function() {
    // Cache the number of options
    var $this = $(this),
      numberOfOptions = $(this).children('option').length;

    // Hides the select element
    $this.addClass('s-hidden');

    // Wrap the select element in a div
    $this.wrap('<div class="select"></div>');

    // Insert a styled div to sit over the top of the hidden select element
    $this.after('<div class="styledSelect"></div>');

    // Cache the styled div
    var $styledSelect = $this.next('div.styledSelect');

    // Show the first select option in the styled div
    let firstOption = $this.children('option').eq(0);
    $styledSelect.text(firstOption.text());

    // Insert an unordered list after the styled div and also cache the list
    var $list = $('<ul />', {
      'class': 'options'
    }).insertAfter($styledSelect);

    // Insert a list item into the unordered list for each select option
    for (var i = 0; i < numberOfOptions; i++) {
      let liClass = i === 0 ? 'checked' : '';
      $('<li />', {
        text: $this.children('option').eq(i).text(),
        rel: $this.children('option').eq(i).val(),
        class: liClass,
      }).appendTo($list);
    }

    // Cache the list items
    var $listItems = $list.children('li');

    // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)


    $styledSelect.click(function(e) {
      e.stopPropagation();
      $('div.styledSelect.active').each(function() {
        $(this).removeClass('active').next('ul.options').hide();
      });
      $(this).toggleClass('active').next('ul.options').toggle();
    });

    // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
    // Updates the select element to have the value of the equivalent option
    $listItems.on('click', function(e) {
      e.stopPropagation();
      $styledSelect.text($(this).text()).removeClass('active');
      $this.val($(this).attr('rel'));
      let productId = $this.data('product');
      let order = $this.find(':selected').data('order');
      let sort = $this.find(':selected').data('sort');
      $list.hide();
      $styledSelect.addClass('filled')
      $listItems.removeClass('checked');
      $(this).addClass('checked');
      reviewSortChange(productId, order, sort)
    });

    // Hides the unordered list when clicking outside of it
    $(document).click(function() {
      $styledSelect.removeClass('active');
      $list.hide();
    });
  });
})

function reviewSortChange(productId, order, sort = 'DESC') {
  const ajax_url = window.ajaxVar.ajaxurl || false;
  $.ajax({
    type: 'POST',
    url: ajax_url, // получаем из wp_localize_script()
    data: {
      action: 'sort', // экшен для wp_ajax_ и wp_ajax_nopriv_
      product_id: productId,
      order: order,
      sort: sort,
    },
    success: function (data) {
      $('.product-reviews__list').html(data);
      const button = $('#load-reviews');
      button.show();
      button.data('sort', sort);
      button.data('order', order);
    },
  });
}