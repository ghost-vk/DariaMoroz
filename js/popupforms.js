/*************************/
/*******popup close*******/
/*************************/
const popup = document.querySelector('.popup')
const closePopup = popup.querySelectorAll('.closePopup')

closePopup.forEach(i => {
	i.addEventListener('click', () => {
		popup.classList.toggle('popup_open')
	})
})

/******************************/
/*******password control*******/
/******************************/
const popupForm = document.getElementById('popupForm')
const passBlock = popupForm.querySelectorAll('.popup__passBlock')

const eyeImg = {
	close : 'img/eyeclose.png',
	open : 'img/eyeopen.png'
}

passBlock.forEach(b => {
	let eye = b.querySelector('.eye')
	let pass = b.querySelector('.password')
	eye.addEventListener('click', () => {
		if(pass.type == 'text') {
			eye.src = `${eyeImg.close}`
			pass.type = 'password'
		} else {
			eye.src = `${eyeImg.open}`
			pass.type = 'text'
		}
	})
})