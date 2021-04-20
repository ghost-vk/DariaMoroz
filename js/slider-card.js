/*******************************/
/*******sliderAbout_track*******/
/*******************************/
const cardTrack = document.getElementsByClassName('cardTrack');
const dotsConteiner = document.querySelector('.bot__dots');

var cards;

const dot = dotsConteiner.querySelectorAll('.bot__dot')
dot[dotActiv].style.backgroundColor = '#FE182A'

for (var i = 0, max = cardTrack.length; i < max; i += 1) {
	let posXStart = 0;
	let posXEnd = 0;
	let posTrack = 0;
	let dotActiv = 0;

	cards = cardTrack.querySelectorAll('.card-mini__slider')

	let maxPosTrack = -(cards.length * 100) + 100

	for(var j = 0; j < cards.length; i++) {
		dotsContent = dotsConteiner.innerHTML
		dotsConteiner.innerHTML = `${dotsContent} 
														<div class="bot__dot"></div>`
	}

	cardTrack.addEventListener('touchstart', () => {
		posXStart = event.changedTouches[0].clientX
	})

	cardTrack.addEventListener('touchend', () => {
		posXEnd = event.changedTouches[0].clientX

		posXMove = Math.abs(posXStart - posXEnd)

		if(posXMove >= 30) {
			if(posXStart > posXEnd && posTrack != maxPosTrack) {
				dot[dotActiv].style.backgroundColor = '#fff'
				dotActiv += 1
				dot[dotActiv].style.backgroundColor = '#FE182A'

				posTrack -= 100
				cardTrack.style.transform = `translateX(${posTrack}%)`

			} else if(posXStart < posXEnd && posTrack != 0) {
				dot[dotActiv].style.backgroundColor = '#fff'
				dotActiv -= 1
				dot[dotActiv].style.backgroundColor = '#FE182A'

				posTrack += 100
				cardTrack.style.transform = `translateX(${posTrack}%)`
			}
		}
		posXEnd = 0;
		posXStart = 0;
	})

}



/*******************************/
/*******sliderAbout_items*******/
/*******************************/