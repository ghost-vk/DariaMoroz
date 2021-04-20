/**************************/
/*******nav__sidebar*******/
/**************************/
const nav = document.querySelector('.nav')
const sidebarBtn = nav.querySelector('.nav__btnBar')
const sidebar = nav.querySelector('.sidebar')

const isOpenSidebar = () => {
	sidebarBtn.classList.toggle('nav__btnBar_close')
	sidebarBtn.classList.toggle('nav__btnBar_open')
	sidebar.classList.toggle('sidebar_open')
}

sidebarBtn.addEventListener('click', () => isOpenSidebar())

/******************/
/*******page*******/
/******************/


const isColor = pageClass => {
	const pagePos = nav.querySelector(pageClass)
		if(pageClass == '.poPage') {
			const svgPo = document.querySelector('.mobileFill')
			svgPo.style.fill = '#FE182A'
			pagePos.innerHTML = 'Личный кабинет'
			pagePos.style.backgroundColor = 'transparent'
		}

		pagePos.style.color = '#FE182A'
		pagePos.style.fontSize = '15px'
		pagePos.style.fontWeight = '600'
}

if (typeof pageId !== "undefined") {
	switch(pageId.className) {
		case 'main': isColor('.mainPage'); break
		case 'about': isColor('.aboutPage'); break
		case 'mer': isColor('.merPage'); break
		case 'online': isColor('.onlinePage'); break
		case 'travel': isColor('.travelPage'); break
		case 'reviews': isColor('.rewPage'); break
		case 'nutritionPrograms': isColor('.nutritionProgramsPage'); break
		case 'po': isColor('.poPage'); break
	}
}


/*********************************/
/*******WindowEventListener*******/
/*********************************/
window.addEventListener('scroll', () => {
	if(sidebar.classList.contains('sidebar_open'))
		isOpenSidebar()
})