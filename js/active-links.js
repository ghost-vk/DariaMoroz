(function ($) {
    $(document).ready(function () {
        let headerLinks = $('.header__content li a'),
            currentUrl = window.location.href;

        for (var i = 0, max = headerLinks.length; i < max; i += 1) { // Hightlights active links in header
            if (headerLinks[i].getAttribute('href') === currentUrl) {
                headerLinks[i].classList.add('text-red');
            }
        }
    });
})(jQuery);