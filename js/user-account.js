(function ($) {
    $(document).ready(function () {
        let navTabs = $('.varTabs'), // Navigation tabs
            tabs = $('.tabs'), // Tabs
            cardOpener = $('.office-item__title'), // Openers event content
            lessonOpener = $('.office-item__name'), // Openers lesson content in event
            intFrameWidth = window.innerWidth,
            menuOpener = $('#open-menu-btn'),
            label;

        /**
         * Highlights current tab
         * @param btn {Object} - clicked button
         */
        function hightlightTab (btn) {
            navTabs.removeClass('active');
            btn.addClass('active');
        }

        /**
         * Hide current tabs
         */
        function hideTabs() {
            tabs.addClass('officeContent__noActive');
        }

        /**
         * Open tab
         */
        function openTab(id) {
            $(`#${id}`).removeClass('officeContent__noActive');
        }

        /**
         * Changes text on label
         */
        function changeLabelText(tab) {
            let newText = tab.text();

            label = label || $('#label');
            label.text(newText);
        }

        /**
         * Action after click on navigation tab
         */
        navTabs.on('click', function () {
            let id = $(this).attr('data-tab');

            hightlightTab($(this));
            hideTabs();
            openTab(id);

            if (intFrameWidth < 769) { // Mobile devices
                menuOpener.click();
                changeLabelText($(this));
            }
        });

        /**
         * Open event content
         */
        cardOpener.on('click', function () {
            let parent = $(this).parent(),
                label = $(this).children('h4'),
                triang = $(this).children('.triang'),
                redLine = parent.find('.small-red-underline'),
                timer = parent.children('.office-item__head-wrapper').children('.H3_bot'),
                slide = function () {
                    parent.find('.office-item__body-wrapper').slideToggle();
                    parent.find('.office-item__head').toggleClass('active');

                    label.toggleClass('text-red');
                    triang.toggleClass('triang_open');

                    parent.toggleClass('active');
                };

            for (var i = 0, max = redLine.length; i < max; i += 1) { // For each lessons
                if (redLine[i].classList.contains('small-transparent-underline')) {
                    let node = redLine[i];
                    setTimeout(function () {
                        node.classList.toggle('small-transparent-underline');
                    }, 400);
                } else {
                    redLine[i].classList.toggle('small-transparent-underline');
                }
            }

            if (!parent.find('.office-item__head').hasClass('active')) { // If lesson is hide
                slide();
            } else { // If lesson is visible
                setTimeout(slide, 400);
            }

            if (timer.length) { // If have time start a side
                if (!timer.hasClass('visible')) { // Timer is hide
                    setTimeout(function () {
                        timer.toggleClass('visible');
                    }, 300);
                } else { // Timer is visible
                    timer.toggleClass('visible');
                }
            }
        });

        /**
         * Open lesson content in event
         */
        lessonOpener.on('click', function () {
            let timer = $(this).parents('.office-item__body-wrapper').find('.H3_bot');
            if (timer.length) {
                if (!timer.hasClass('visible')) {
                    setTimeout(function () {
                        timer.toggleClass('visible');
                    }, 300);
                } else {
                    timer.toggleClass('visible');
                }
            }

            $(this).parent().find('.office-item__preview').slideToggle();
            $(this).children('.triang').toggleClass('triang_open');
        });


        if (intFrameWidth < 769) { // Mobile devices
            let label,
                menuTopPosition,
                menu = $('#nav-menu'); // Mobile menu


            label = label || $('#label'); // Relative element for positioning menu
            menuTopPosition = label.offset().top + label.height(); // Top position of mobile menu

            menu.css('top', menuTopPosition + 'px'); // Set menu position

            /**
             * Fires menu title and opens menu
             */
            menuOpener.on('click', function () {
                $(this).children('.triang').toggleClass('triang_open');
                menu.toggleClass('officeContent__nav_open');
            });
        }
    });
})(jQuery);