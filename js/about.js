/**
 * @namespace MOROZ
 */
var MOROZ = MOROZ || {};

/**
 * Settings object
 */
MOROZ.videoConfig = {
    popup: 'video-popup',
    popupCloser: 'popup-close',
    videoWidth: 640,
    videoHeight: 360,
}

/**
 * Set width and height of player
 */
MOROZ.getVideoParams = function () {
    let intViewportWidth = window.innerWidth;
    if (intViewportWidth > 1024) {
        MOROZ.videoConfig.videoWidth = 960;
        MOROZ.videoConfig.videoHeight = 540;
    } else {
        MOROZ.videoConfig.videoWidth = intViewportWidth * 0.95;
        MOROZ.videoConfig.videoHeight = intViewportWidth * 0.95 / 4 * 3;
    }
}
MOROZ.getVideoParams(); // Call to set params

/**
 * Create youtube player
 */
let youtubeScriptTag = document.createElement('script');

youtubeScriptTag.src = "https://www.youtube.com/iframe_api";
let firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(youtubeScriptTag, firstScriptTag);

/**
 * This function creates an <iframe> (and YouTube player)
 * after the API code downloads.
 * */
let youtubePlayer;
function onYouTubePlayerAPIReady() {
    youtubePlayer = new YT.Player('player', {
        height: MOROZ.videoConfig.videoHeight,
        width: MOROZ.videoConfig.videoWidth,
        videoId: videoMoroz.videoId
    });
}

(function ($) {
    $(document).ready(function () {
        let popup = document.getElementById(MOROZ.videoConfig.popup),
            body = document.getElementsByTagName('body')[0],
            videoStarter = document.getElementById('video-play'),
            videoCloser = document.getElementById('popup-close'),
            intWindowHeight = window.innerHeight,
            intWindowWidth = window.innerWidth;

        /**
         * Opens popup YouTube and stops first video
         */
        function handlePopup() {
            popup.classList.add('popup-active');
            body.classList.add('overflow-hidden');
            youtubePlayer.playVideo();
        }

        /**
         * Close popup
         */
        function hidePopup() {
            popup.classList.remove('popup-active');
            body.classList.remove('overflow-hidden');
            youtubePlayer.stopVideo();
        }

        /**
         * Set position of X - video closer
         */
        (function setCloseBtn() {
            let topPosition = ((intWindowHeight - MOROZ.videoConfig.videoHeight) / 2 - 50) + 'px',
                rightPosition;

            if (intWindowWidth > 1024) {
                rightPosition = ((intWindowWidth - MOROZ.videoConfig.videoWidth) / 2 - 50) + 'px';
            } else {
                rightPosition = ((intWindowWidth - MOROZ.videoConfig.videoWidth) / 2 + 20) + 'px';
            }

            videoCloser.style.top = topPosition;
            videoCloser.style.right = rightPosition;
        })();

        videoStarter.addEventListener('click', handlePopup);
        videoCloser.addEventListener('click', hidePopup);
    });
})(jQuery);