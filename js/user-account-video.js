/**
 * @namespace MOROZ
 */
var MOROZ = MOROZ || {};

/**
 * Settings object
 */
MOROZ.videoConfig = {
    videoOpener: 'play-video-btn',
    popupCloser: 'popup-close',
    videoWidth: 640,
    videoHeight: 360,
}

/**
 * Set width and height of player
 */
MOROZ.getVideoParams = (function () {
    let intViewportWidth = window.innerWidth;
    if (intViewportWidth > 1024) {
        MOROZ.videoConfig.videoWidth = 960;
        MOROZ.videoConfig.videoHeight = 540;
    } else {
        MOROZ.videoConfig.videoWidth = intViewportWidth * 0.95;
        MOROZ.videoConfig.videoHeight = intViewportWidth * 0.95 / 4 * 3;
    }
})();
// MOROZ.getVideoParams(); // Call to set params



/**
 * Create youtube player
 */
let youtubeScriptTag = document.createElement('script');

youtubeScriptTag.src = "https://www.youtube.com/iframe_api";
let firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(youtubeScriptTag, firstScriptTag);

MOROZ.player = {};

// Creates YouTube players
(function readyYoutube() {
    if ((typeof YT !== "undefined") && YT && YT.Player) {
        for (var key in video) { // Events video
            if (video[key].length) { // If video ID is set
                MOROZ.player[key] = new YT.Player(`player-${key}`, {
                    height: MOROZ.videoConfig.videoHeight,
                    width: MOROZ.videoConfig.videoWidth,
                    videoId: video[key]
                });
            }
        }

        for (var key in videoCourse) { // Course video
            if (videoCourse[key].length) { // If video ID is set
                MOROZ.player[key] = new YT.Player(`player-${key}`, {
                    height: MOROZ.videoConfig.videoHeight,
                    width: MOROZ.videoConfig.videoWidth,
                    videoId: videoCourse[key]
                });
            }
        }
    } else {
        setTimeout(readyYoutube, 300);
    }
})();


(function ($) {
    let playBtns = document.getElementsByClassName('play-video-btn'),
        intViewportHeight = window.innerHeight,
        intViewportWidth = window.innerWidth,
        closeBtns = $(".popup-close"),
        currentPlayer;

    /**
     * Opens popup YouTube and stops first video
     */
    function handlePopup(button) {
        let dataPopup = button.attr('data-modal'),
            dataPlayer = button.attr('data-player'),
            popup = $(`#${dataPopup}`);

        // console.log(button.attr('data-modal'));

        popup.addClass('popup-active');
        document.body.classList.add('overflow-hidden');
        currentPlayer = MOROZ.player[dataPlayer];
        MOROZ.player[dataPlayer].playVideo();
    }

    for (var i = 0, max = playBtns.length; i < max; i += 1) {
        playBtns[i].addEventListener('click', function () {
            handlePopup($(this));
        });
    }

    /**
     * Close popup
     */
    function hidePopup(button) {
        let popup = button.parent('.popup-window');

        popup.removeClass('popup-active');
        document.body.classList.remove('overflow-hidden');
        currentPlayer.stopVideo();
    }

    closeBtns.on('click', function () {
        hidePopup($(this));
    });

    /**
     * Set position of X - video closer
     */
    (function setCloseBtn() {
        let topPosition = ((intViewportHeight - MOROZ.videoConfig.videoHeight) / 2 - 50) + 'px',
            rightPosition;

        if (intViewportWidth > 1024) {
            rightPosition = ((intViewportWidth - MOROZ.videoConfig.videoWidth) / 2 - 50) + 'px';
        } else {
            rightPosition = ((intViewportWidth - MOROZ.videoConfig.videoWidth) / 2 + 20) + 'px';
        }

        closeBtns.css('top', topPosition);
        closeBtns.css('right', rightPosition);
    })();



})(jQuery);