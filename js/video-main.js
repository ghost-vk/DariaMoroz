/**
 * @namespace MOROZ
 */
var MOROZ = MOROZ || {};

/**
 * Settings object
 */
MOROZ.videoConfig = {
    firstVideoBox: 'first-video-block',
    secondOpener: 'play-btn',
    popup: 'video-home-popup',
    popupCloser: 'popup-close',
    videoWidth: 640,
    videoHeight: 360,
    soundMutedIcon: '<i class="fas fa-volume-mute"></i>',
    soundNotMutedIcon: '<i class="fas fa-volume-up"></i>'
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
        videoId: videoMoroz.secondVideoId
    });
}


(function () {
    let secondVideoStarter = document.getElementById(MOROZ.videoConfig.secondOpener),
        secondVideoCloser = document.getElementById(MOROZ.videoConfig.popupCloser),
        popup = document.getElementById(MOROZ.videoConfig.popup),
        body = document.getElementsByTagName('body')[0],
        firstVideoBlock = document.getElementById('first-video-block'),
        firstVideo = firstVideoBlock.children[0],
        firstVideoPictureTag = firstVideoBlock.children[1],
        firstVideoPlayToggler = firstVideoPictureTag.children[1],
        firstVideoSoundToggler = firstVideoBlock.children[2],
        firstVideoRipper = firstVideoBlock.children[3],
        startFixedBlock = document.getElementById('video-start-fixed-block'), // From top of this block video is fixed
        startFixedBlockTop = startFixedBlock.getBoundingClientRect().top + window.scrollY,
        intViewportHeight = window.innerHeight,
        intViewportWidth = window.innerWidth,
        currentScroll,
        currentScrollBottom,
        startOffset = startFixedBlockTop - 50,
        videoSectionWrapper = document.getElementsByClassName('oneBlock__top')[0],
        fixedBlock = document.getElementById('oneBlock__fixed'),
        footerTop = document.getElementsByTagName('footer')[0].getBoundingClientRect().top + window.scrollY,
        endOffset = footerTop - 50,
        isRip = false; // Set true if user click X on first video block


    /**
     * Opens popup YouTube and stops first video
     */
    function handlePopup() {
        popup.classList.add('popup-active');
        body.classList.add('overflow-hidden');
        youtubePlayer.playVideo();
        if (!firstVideo.paused) {
            togglePlayer();
        }
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
     * Changes central video icon
     * @param paused {Boolean}
     */
    function changePlayIcon(paused) {
        let src, srcset;

        if (paused === true) {
            src = videoMoroz.iconStopImg;
            srcset = videoMoroz.iconStopSrc;
        } else {
            src = videoMoroz.iconPlayImg;
            srcset = videoMoroz.iconPlaySrc;
        }

        firstVideoPictureTag.children[0].setAttribute('srcset', srcset);
        firstVideoPictureTag.children[1].setAttribute('src', src);
    }

    /**
     * Resume and stop the video
     */
    function togglePlayer() {
        changePlayIcon(firstVideo.paused); // Change central icon
        if (firstVideo.paused) {
            firstVideo.play();
        } else {
            firstVideo.pause();
        }
    }

    /**
     * Turn on/off video sound
     */
    function toggleSound() {
        if (firstVideo.muted === true) {
            firstVideo.muted = false;
            firstVideoSoundToggler.innerHTML = MOROZ.videoConfig.soundMutedIcon;
        } else {
            firstVideo.muted = true;
            firstVideoSoundToggler.innerHTML = MOROZ.videoConfig.soundNotMutedIcon;
        }
    }

    /**
     * First stage fixed position
     */
    function setVideoFixedFirst() {
        fixedBlock.classList.add('active_1');
        fixedBlock.classList.remove('active_2');
        videoSectionWrapper.classList.add('active');
    }

    /**
     * Second stage fixed position
     */
    function setVideoFixedSecond() {
        fixedBlock.classList.add('active_2');
        fixedBlock.classList.remove('active_1');
    }

    /**
     * Unset fixed position
     */
    function setVideoStatic() {
        fixedBlock.classList.remove('active_1');
        videoSectionWrapper.classList.remove('active');
    }

    /**
     * Set up position of first video
     */
    function setVideoPosition() {
        if (isRip === true) {
            return;
        }
        currentScroll = window.scrollY;
        currentScrollBottom = currentScroll + intViewportHeight;
        console.log()
        if (currentScroll > startOffset && currentScrollBottom <= endOffset) {
            setVideoFixedFirst();
        } else if (currentScrollBottom > endOffset) {
            setVideoFixedSecond();
        } else {
            setVideoStatic();
        }
    }

    /**
     * Detach video and delete X icon from first video
     */
    function ripVideo() {
        fixedBlock.classList.remove('active_1');
        fixedBlock.classList.remove('active_2');
        videoSectionWrapper.classList.remove('active');
        firstVideoRipper.innerHTML = '';
        isRip = true;
        if (!firstVideo.paused) {
            togglePlayer();
        }
    }

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

        secondVideoCloser.style.top = topPosition;
        secondVideoCloser.style.right = rightPosition;
    })();

    /**
     * Event listeners
     */
    secondVideoStarter.addEventListener('click', handlePopup);
    secondVideoCloser.addEventListener('click', hidePopup);
    firstVideo.addEventListener('click', togglePlayer, false);
    firstVideoPlayToggler.addEventListener('click', togglePlayer, false);
    firstVideoSoundToggler.addEventListener('click', toggleSound, false);
    firstVideoRipper.addEventListener('click', ripVideo);

    if (intViewportWidth > 1024) { // Only desctops
        window.addEventListener('scroll', setVideoPosition);
    }

})();


