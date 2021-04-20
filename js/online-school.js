(function ($) {
    let sliders = $('.slick-slider');
    sliders.slick({
        dots: true,
        arrows: false,
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        // centerMode: true,
        // centerPadding: '0px',
    });
})(jQuery);