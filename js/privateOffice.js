const tab = document.querySelectorAll('.tab')

// const btnPopup = document.getElementById('stickOpenPopup')
const popup = document.getElementById('stickPopup')
const popupBg = popup.querySelector('.stickPopup__area')
const popupBtnClose = popup.querySelector('.stickPopup__closeContainer')

const popupCloseArr = [popupBg, popupBtnClose]

// btnPopup.addEventListener('click', () => {
// 	popup.classList.add('stickPopup_open')
// })


popupCloseArr.forEach(i => {
	i.addEventListener('click', () => {
		popup.classList.remove('stickPopup_open')
	})
})

tab.forEach(t => {
	let tabControl = t.querySelector('.tabControl')
	let tabTriang = t.querySelector('.triang')
	let tabContent = t.querySelector('.tabContent')

	tabControl.addEventListener('click', () => {
		tabControl.classList.toggle('subtitleH3_open')
		tabTriang.classList.toggle('triang_open')
		tabContent.classList.toggle('contentOpen')
	})
})

const varTabs = document.querySelectorAll('.varTabs')
const tabs = document.querySelectorAll('.tabs')

const tabMobile = document.querySelector('.tabMobile')
const triangMobile = document.querySelector('.triang_mobile')
const contentMobile = document.querySelector('.contentMobile')
const spanMobile = document.querySelector('.spanMobile')

let width  = window.innerWidth ||
					 document.documentElement.clientWidth ||
					 document.body.clientWidth

const isControlNav = () => {
	if(width <= 768) {
		tabMobile.addEventListener('click', () => {
			tabMobile.classList.toggle('tabMobile_open')
			triangMobile.classList.toggle('triang_open')
			contentMobile.classList.toggle('officeContent__nav_open')
		})
	}
}

isControlNav()

window.addEventListener('resize', () => {
	width  = window.innerWidth ||
					 document.documentElement.clientWidth ||
					 document.body.clientWidth
})

const isColorHover = (item, color) => {
	!tabs[item.id].classList.contains('officeContent__noActive') ? item.style.color = '#FE182A' : item.style.color = color
}

varTabs.forEach(i => {

	i.addEventListener('mouseover', () => isColorHover(i, '#F5F5F5'))
	i.addEventListener('mouseout', () => isColorHover(i, '#4F4F4F'))

	i.addEventListener('click', () => {
		if(width <= 768) {
			spanMobile.innerHTML = i.textContent
			tabMobile.classList.toggle('tabMobile_open')
			triangMobile.classList.toggle('triang_open')
			contentMobile.classList.toggle('officeContent__nav_open')
		}

		tabs.forEach(a => {
			if(!a.classList.contains('officeContent__noActive'))
				a.classList.add('officeContent__noActive')
		})

		tabs[i.id].classList.remove('officeContent__noActive')

		varTabs.forEach(c => c.style.color = '#4F4F4F')
		i.style.color = '#FE182A'
	})
})
