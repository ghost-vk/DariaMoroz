(function ($) {
    $(document).ready(function () {
        let windbags,
            alert = $('#uncompleted-function'),
            links = $('.menu-item a');

        for (var i = 0, max = links.length; i < max; i += 1) {
            if (links[i].getAttribute("href") === "#") {
                links[i].classList.add('not-completed-function');
            }
        }

        windbags = $('.not-completed-function');

        windbags.on('click', function (e) {
            e.preventDefault();
            alert.addClass('active');
            setTimeout(function () {
                alert.removeClass('active');
            }, 1300);
        });
    });
})(jQuery);