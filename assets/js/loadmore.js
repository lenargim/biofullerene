$(document).ready(function () {
    const button = $('#load-reviews');
    button.on('click', function (event) {
        const ajax_url = window.ajaxVar.ajaxurl || false;
        const list = $('.product-reviews__list');
        const prodId = button.data('product');
        let offset = +button.data('offset');
        const order = button.data('order');
        const sort = button.data('sort');
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: ajax_url, // получаем из wp_localize_script()
            data: {
                action: 'loadmore', // экшен для wp_ajax_ и wp_ajax_nopriv_
                offset: offset,
                product_id: prodId,
                order: order,
                sort: sort,
            },
            beforeSend: function () {
                button.text('Loading...');
            },
            success: function (data) {
                list.append(data);
                button.text('Show more');
                offset += 4;
                const total = +button.data('total');
                if (total > offset) {
                    button.data('offset', offset);
                } else {
                    button.hide()
                }
            },
        });
    });
});