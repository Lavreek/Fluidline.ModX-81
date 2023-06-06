const $ = require('jquery');

$(document).scroll(function () {
    let scroll = $(this).scrollTop();
    let scrollButton = $('._647de5d4774cd');

    if (scroll > 750) {
        if (scrollButton.hasClass('hidden')) {
            scrollButton.css('display', 'block');
            setTimeout(() => {
                scrollButton.removeClass('hidden');
            }, 500);
        }
    } else {
        if (!scrollButton.hasClass('hidden')) {
            scrollButton.addClass('hidden');

            setTimeout(() => {
                scrollButton.css('display', 'none');
            }, 500);
        }
    }
})