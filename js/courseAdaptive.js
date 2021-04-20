/***********************/
/*******course_bg*******/
/***********************/
const courseBg = document.querySelector('.courseBg');

const controlBg = () => {

	let width  = window.innerWidth ||
					 document.documentElement.clientWidth ||
					 document.body.clientWidth;

	if(width <= 912) {
		courseBg.classList.remove('courseBg_desktop');
		courseBg.classList.add('courseBg_mobile');
	} else {
		courseBg.classList.add('courseBg_desktop');
		courseBg.classList.remove('courseBg_mobile');
	}
}

controlBg();

window.addEventListener('resize', controlBg);

/**************************/
/*******course_theme*******/
/**************************/
const themes = document.getElementById('themes');

if (themes) {
	const theme = themes.querySelectorAll('.theme');

	theme.forEach(i => {
		const themeBtn = i.querySelector('.theme__btn');
		const themeContent = i.querySelector('.theme__content');

		themeBtn.addEventListener('click', () => {
			themeContent.classList.toggle('theme__content_close');

			if (!themeContent.classList.contains('theme__content_close')) {
				themeBtn.innerHTML='Свернуть программу';
			} else {
				themeBtn.innerHTML='Развернуть программу';
			}
		})
	});
}

