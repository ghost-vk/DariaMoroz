/*******************************/
/*******sliderAbout_track*******/
/*******************************/
const sliderSert = document.getElementById('sliderSert'),
			sertTrack = sliderSert.querySelector('.aboutSlider__trackImg'),
			sliderItem = sertTrack.querySelectorAll('.aboutSlider__sert')
			sertDots = document.getElementById('dots')

const arrowLeft = document.querySelector('.aboutSlider__arrow_left'),
			arrowRight = document.querySelector('.aboutSlider__arrow_right')

let width  = window.innerWidth ||
					 document.documentElement.clientWidth ||
					 document.body.clientWidth

let posXStart = 0;
let posXEnd = 0;
let posTrack = 0;
let dotActiv = 0;

let maxPosTrack = -sertTrack.offsetWidth + sliderSert.offsetWidth
let countDot

if(width > 1250) {
	countDot = Math.ceil(sliderItem.length / 3)
} else if(width > 769) {
	countDot = Math.ceil(sliderItem.length / 2)
} else {
	countDot = sliderItem.length
}

for(var i = 0; i < countDot; i++) {
	dotsContent = sertDots.innerHTML
	sertDots.innerHTML = `${dotsContent} 
												<div class="aboutSlider__sliderDot"></div>`
}

const dot = sertDots.querySelectorAll('.aboutSlider__sliderDot')
dot[dotActiv].style.backgroundColor = '#FE182A'

const isLeft = () => {
	posTrack += sliderSert.offsetWidth + 20

	if(posTrack > 0) posTrack = 0
	sertTrack.style.transform = `translateX(${posTrack}px)`

	dot[dotActiv].style.backgroundColor = '#fff'
	dotActiv -= 1
	dot[dotActiv].style.backgroundColor = '#FE182A'
}

const isRight = () => {
	posTrack -= sliderSert.offsetWidth + 20

	if(posTrack < maxPosTrack) posTrack = maxPosTrack
	sertTrack.style.transform = `translateX(${posTrack}px)`

	dot[dotActiv].style.backgroundColor = '#fff'
	dotActiv += 1
	dot[dotActiv].style.backgroundColor = '#FE182A'
}

arrowLeft.addEventListener('click', () => {
	if(posTrack != 0) {
		isLeft()
	}
})

arrowRight.addEventListener('click', () => {
	if(posTrack != maxPosTrack) {
		isRight()
	}
})

sertTrack.addEventListener('touchstart', () => {
	posXStart = event.changedTouches[0].clientX
})

sertTrack.addEventListener('touchend', () => {
	posXEnd = event.changedTouches[0].clientX

	posXMove = Math.abs(posXStart - posXEnd)

	if(posXMove >= 30) {
		if(posXStart > posXEnd && posTrack != maxPosTrack) isRight()
		else if(posXStart < posXEnd && posTrack != 0) isLeft()
	}
	posXEnd = 0;
	posXStart = 0;
})

/*******************************/
/*******sliderAbout_items*******/
/*******************************/
const sliderPopup = document.querySelector('.aboutSlider__popup')

sliderPopup.addEventListener('click', () => {
	sliderPopup.classList.toggle('aboutSlider__popup_open')
})

sliderItem.forEach(i => {
	i.addEventListener('click', () => {
		sliderPopup.innerHTML = ''
		sliderPopup.classList.toggle('aboutSlider__popup_open')
		sliderPopup.append(i.cloneNode())
	})
})

window.addEventListener('scroll', () => {
	if(sliderPopup.classList.contains('aboutSlider__popup_open'))
		sliderPopup.classList.toggle('aboutSlider__popup_open')
})