$(document).ready(function () {
    const researchBtn = $('.blog-list__button');
    researchBtn.on('click', function (event) {
        const ajax_url = window.ajaxVar.ajaxurl || false;
        const list = $('.blog-list__wrap');
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                action: 'load_research',
            },
            beforeSend: function () {
                researchBtn.text('Loading...');
            },
            success: function (html) {
                list.html(html);
                researchBtn.hide();
            },
        });
    })

    let filterArr = [];
    const researchTag = $('.blog-tags__tag');
    researchTag.on('click', function (event) {
        const $this = $(this);
        if ($this.hasClass('active')) return;
        const slug = $(this).data('slug');
        const makeUniq = (arr) => [...new Set(arr)];
        let filteredArr = [];
        if (slug) {
            filterArr.push(slug)
            filteredArr = makeUniq(filterArr);
        } else {
            filterArr = [];
        }

        const ajax_url = window.ajaxVar.ajaxurl || false;
        const list = $('.blog-list__wrap');
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                slug: filteredArr.join(', '),
                action: 'tag_filter',
            },
            success: function (html) {
                list.html(html);
                researchBtn.hide();
                if (!slug) {
                    researchTag.removeClass('active');
                }
                $this.addClass('active');
            },
        });
    })

    const researchClose = $('.blog-tags__close')
    researchClose.on('click', function (event) {
        const $this = $(this);
        const tag = $this.parent();
        const slug = tag.data('slug');
        filterArr = filterArr.filter(function (item) {
            return item !== slug
        })
        const ajax_url = window.ajaxVar.ajaxurl || false;
        const list = $('.blog-list__wrap');
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                slug: filterArr.join(', '),
                action: 'tag_filter',
            },
            success: function (html) {
                list.html(html);
                researchBtn.hide();
                tag.removeClass('active');
            },
        });
    })

    $('.blog-tags__toggle').on('click', function () {
        $(this).toggleClass('open');
        $(this).hasClass('open') ? $(this).text('Hide filters') : $(this).text('Show filters')
        //$('.blog-tags__wrap').toggle(200)
    })
})