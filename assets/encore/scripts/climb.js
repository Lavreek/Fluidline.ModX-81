const $ = require('jquery');

$(document).ready(function () {
    let scrollButton = document.getElementById('flScrollToTop');

    function scrollToTop () {
        $('html, body').animate({ scrollTop: 0 }, 250);
    }

    scrollButton.addEventListener('click', scrollToTop);

    let scrollButtonJQ = $('._647de5d4774cd');

    if (!scrollButtonJQ.hasClass('hidden')) {
        scrollButtonJQ.addClass('hidden');

        setTimeout(() => {
            scrollButtonJQ.addClass('none');
        }, 500);
    }
})

$(document).scroll(function () {
    let scroll = $(this).scrollTop();
    let scrollButton = $('._647de5d4774cd');

    if (scroll > 500) {
        if (scrollButton.hasClass('hidden')) {
            scrollButton.removeClass('none');
            setTimeout(() => {
                scrollButton.removeClass('hidden');
            }, 500);
        }
    } else {
        if (!scrollButton.hasClass('hidden')) {
            scrollButton.addClass('hidden');

            setTimeout(() => {
                scrollButton.addClass('none');
            }, 500);
        }
    }
})