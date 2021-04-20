<?php
global $current_user;
$user_name = "";
if ( is_user_logged_in() ) {
	$user_name = $current_user->user_firstname;
}

// VKontakte authorization
$current_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$current_url = explode('?', $current_url);
$current_url = $current_url[0];
$vk_link_params = array (
	'client_id'     => '7780718',
	'redirect_uri'  => 'https://dariamoroz.ru',
	'scope'         => 'email',
	'response_type' => 'code',
	'state'         => $current_url
);
$vk_auth_link = 'https://oauth.vk.com/authorize?' . urldecode(http_build_query($vk_link_params));

// Facebook authorization
$fb_link_params = array(
	'client_id'     => '852472638811925',
	'redirect_uri'  => 'https://dariamoroz.ru/auth-facebook/',
	'scope'         => 'email',
	'response_type' => 'code',
);
$fb_auth_link = 'https://www.facebook.com/dialog/oauth?' . urldecode(http_build_query($fb_link_params));

// Google authorization
$google_auth_params = array(
	'client_id'     => '644128964844-p9f9r9h1het6faieqe9to7ajickvl1no.apps.googleusercontent.com',
	'redirect_uri'  => 'https://dariamoroz.ru/auth-google/',
	'response_type' => 'code',
	'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
);
$google_auth_link = 'https://accounts.google.com/o/oauth2/auth?' . urldecode(http_build_query($google_auth_params));
?>
<div class="moroz-popup" id="popup-lid">
    <?php $lid_action = ( is_singular('course') ) ? 'course_lid' : 'marathon_lid' ; // Action to handle after popup form ?>
	<div class="moroz-popup__window" data-action="<?= $lid_action; ?>">
		<div class="moroz-popup__close-container">
			<div class="moroz-popup__close-btn"></div>
		</div>
		<div class="moroz-popup__title"><p>СВЯЖИТЕСЬ СО МНОЙ</p></div>
		
		<div class="moroz-popup__form">
			<div class="moroz-popup__select">
				<p>Выбери тип связи</p>
				<picture>
					<source type="<?= get_template_directory_uri(); ?>/img/icons/select_down.svg" />
					<img src="<?= get_template_directory_uri(); ?>/img/icons/select_down.png" />
				</picture>
				<select data-name="contact_type">
					<option value="0">Выбери тип связи</option>
					<option value="tg">Telegram</option>
					<option value="vk">ВКонтакте</option>
				</select>
				<span class="error">!Выберите, как нам связаться с вами</span>
			</div>
			<input class="name-input" type="text" placeholder="Ваше имя" data-name="user_name" value="<?= $user_name; ?>">
			<span class="error">!Введите ваше имя</span>
			<input class="contact-input" type="text" placeholder="Ваш контакт" data-name="contact">
			<span class="error">!Оставьте ваш контакт для связи</span>
		</div>
		
		<div class="moroz-popup__submit">
			<a href="#" class="btnRed btn-big popup-submit">Отправить</a>
            <div class="moroz-popup__loader">
                <i class="fas fa-spinner"></i>
            </div>
		</div>
	</div>
</div>

<div class="moroz-popup" id="popup-login">
	<div class="moroz-popup__window" data-action="authentication">
		<div class="moroz-popup__close-container">
			<div class="moroz-popup__close-btn"></div>
		</div>
		<div class="moroz-popup__title">
			<p>ВХОД</p>
		</div>
		<div class="moroz-popup__subtitle">
			<p>Войти через</p>
		</div>
        
        <?php require __DIR__ . '/popups-social-login.php'; ?>
		
		<div class="moroz-popup__form">
			<div class="moroz-popup__input-box">
				<input class="email-input" type="text" placeholder="Email" data-name="email">
				<span class="error">!Введите действительный email адрес</span>
			</div>
			<div class="moroz-popup__input-box">
				<input class="password-login-input" type="password" placeholder="Пароль" data-name="password">
				<span class="error">!Не правильный пароль</span>
				
				<svg class="cursor-pointer eye-toggler visible" width="19" height="6" viewBox="0 0 19 6" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.4246 1.0515L17.5539 0.969172C17.8056 0.801214 17.8648 0.469603 17.6905 0.228352C17.5148 -0.0150493 17.1691 -0.0699825 16.9226 0.0956798C8.29805 5.91294 2.01995 0.381967 1.7562 0.144302C1.53364 -0.0566439 1.18293 -0.0464608 0.975677 0.166964C0.767388 0.381249 0.777497 0.716448 0.997829 0.918111C1.00972 0.929012 1.20612 1.10242 1.56457 1.35902L0.459786 3.11676C0.302194 3.36747 0.384855 3.69478 0.644882 3.84811C0.733788 3.89974 0.834736 3.92571 0.932413 3.92571C1.1181 3.92571 1.29889 3.83463 1.404 3.67069L2.48425 1.95339C3.08994 2.3091 3.8666 2.69751 4.79193 3.02568L4.25954 4.74283C4.17137 5.02553 4.33625 5.32043 4.6275 5.40448L4.78628 5.42714C5.02163 5.42714 5.24166 5.27797 5.31332 5.04719L5.84051 3.35356C6.69463 3.57889 7.65014 3.73107 8.68133 3.76722V5.46802C8.68133 5.76234 8.92768 6 9.23275 6C9.53753 6 9.78403 5.76234 9.78403 5.46802V3.75775C10.6838 3.71013 11.6374 3.56082 12.633 3.28687L13.3117 5.01348C13.3963 5.22619 13.6059 5.35643 13.8273 5.35643L14.0224 5.32286C14.3071 5.21845 14.4514 4.91165 14.3432 4.63712L13.6823 2.95482C14.5889 2.62995 15.526 2.20224 16.4939 1.63483L17.3872 2.78529C17.4961 2.92427 17.6621 2.99886 17.8281 2.99886C17.9437 2.99886 18.0592 2.96501 18.1584 2.892C18.4028 2.71558 18.4522 2.38211 18.2702 2.14731L17.4246 1.0515Z" fill="#BDBDBD"/>
				</svg>
				<svg class="cursor-pointer eye-toggler hidden" width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.8856 5.6338C17.7248 5.40371 13.8934 0 8.99992 0C4.10647 0 0.274852 5.40371 0.114223 5.63358C-0.0380743 5.85186 -0.0380743 6.14792 0.114223 6.3662C0.274852 6.59629 4.10647 12 8.99992 12C13.8934 12 17.7248 6.59625 17.8856 6.36638C18.0381 6.14814 18.0381 5.85186 17.8856 5.6338ZM8.99992 10.7586C6.26642 10.7586 3.81047 8.69603 2.38009 7.18782C1.74438 6.51753 1.74381 5.48116 2.37909 4.81047C3.80756 3.30238 6.26089 1.24137 8.99992 1.24137C11.7335 1.24137 14.1894 3.30387 15.6198 4.8122C16.2555 5.48248 16.256 6.51881 15.6208 7.18947C14.1923 8.69756 11.739 10.7586 8.99992 10.7586Z" fill="#333333"/>
					<path d="M8.99991 2.27588C7.03671 2.27588 5.43945 3.94657 5.43945 6.00003C5.43945 8.05349 7.03671 9.72418 8.99991 9.72418C10.9631 9.72418 12.5604 8.05349 12.5604 6.00003C12.5604 3.94657 10.9631 2.27588 8.99991 2.27588ZM8.99991 8.48277C7.69104 8.48277 6.6263 7.36904 6.6263 6.00003C6.6263 4.63102 7.69108 3.51729 8.99991 3.51729C10.3087 3.51729 11.3735 4.63102 11.3735 6.00003C11.3735 7.36904 10.3088 8.48277 8.99991 8.48277Z" fill="#333333"/>
				</svg>
			
			</div>
		</div>
		
		<div class="moroz-popup__forgot">
			<a class="gray-link open-binded" data-popup="popup-recovery" href="#">Восстановить пароль</a>
		</div>
		
		<div class="moroz-popup__submit">
			<a href="#" class="btnRed btn-big popup-submit">Войти</a>
            <div class="moroz-popup__loader">
                <i class="fas fa-spinner"></i>
            </div>
		</div>
		
		<div class="moroz-popup__swap">
			<a class="red-link open-binded" data-popup="popup-registration" href="#">Регистрация</a>
		</div>
  
	</div>
</div>

<div class="moroz-popup" id="popup-registration">
	<div class="moroz-popup__window" data-action="registration">
		<div class="moroz-popup__close-container">
			<div class="moroz-popup__close-btn"></div>
		</div>
		<div class="moroz-popup__title">
			<p>РЕГИСТРАЦИЯ</p>
		</div>
		<div class="moroz-popup__subtitle">
			<p>Войти через</p>
		</div>
  
		<?php require __DIR__ . '/popups-social-login.php'; ?>
		
		<div class="moroz-popup__form">
			<div class="moroz-popup__input-box">
				<input class="name-input" type="text" placeholder="Ваше имя" data-name="name">
				<span class="error">!Вы не указали, как вас зовут</span>
			</div>
			<div class="moroz-popup__input-box">
				<input class="password-input" type="password" placeholder="Пароль" data-name="password">
				<span class="error">!Не правильный пароль</span>
				<svg class="cursor-pointer eye-toggler visible" id="" width="19" height="6" viewBox="0 0 19 6" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.4246 1.0515L17.5539 0.969172C17.8056 0.801214 17.8648 0.469603 17.6905 0.228352C17.5148 -0.0150493 17.1691 -0.0699825 16.9226 0.0956798C8.29805 5.91294 2.01995 0.381967 1.7562 0.144302C1.53364 -0.0566439 1.18293 -0.0464608 0.975677 0.166964C0.767388 0.381249 0.777497 0.716448 0.997829 0.918111C1.00972 0.929012 1.20612 1.10242 1.56457 1.35902L0.459786 3.11676C0.302194 3.36747 0.384855 3.69478 0.644882 3.84811C0.733788 3.89974 0.834736 3.92571 0.932413 3.92571C1.1181 3.92571 1.29889 3.83463 1.404 3.67069L2.48425 1.95339C3.08994 2.3091 3.8666 2.69751 4.79193 3.02568L4.25954 4.74283C4.17137 5.02553 4.33625 5.32043 4.6275 5.40448L4.78628 5.42714C5.02163 5.42714 5.24166 5.27797 5.31332 5.04719L5.84051 3.35356C6.69463 3.57889 7.65014 3.73107 8.68133 3.76722V5.46802C8.68133 5.76234 8.92768 6 9.23275 6C9.53753 6 9.78403 5.76234 9.78403 5.46802V3.75775C10.6838 3.71013 11.6374 3.56082 12.633 3.28687L13.3117 5.01348C13.3963 5.22619 13.6059 5.35643 13.8273 5.35643L14.0224 5.32286C14.3071 5.21845 14.4514 4.91165 14.3432 4.63712L13.6823 2.95482C14.5889 2.62995 15.526 2.20224 16.4939 1.63483L17.3872 2.78529C17.4961 2.92427 17.6621 2.99886 17.8281 2.99886C17.9437 2.99886 18.0592 2.96501 18.1584 2.892C18.4028 2.71558 18.4522 2.38211 18.2702 2.14731L17.4246 1.0515Z" fill="#BDBDBD"/>
				</svg>
				<svg class="cursor-pointer eye-toggler hidden" width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.8856 5.6338C17.7248 5.40371 13.8934 0 8.99992 0C4.10647 0 0.274852 5.40371 0.114223 5.63358C-0.0380743 5.85186 -0.0380743 6.14792 0.114223 6.3662C0.274852 6.59629 4.10647 12 8.99992 12C13.8934 12 17.7248 6.59625 17.8856 6.36638C18.0381 6.14814 18.0381 5.85186 17.8856 5.6338ZM8.99992 10.7586C6.26642 10.7586 3.81047 8.69603 2.38009 7.18782C1.74438 6.51753 1.74381 5.48116 2.37909 4.81047C3.80756 3.30238 6.26089 1.24137 8.99992 1.24137C11.7335 1.24137 14.1894 3.30387 15.6198 4.8122C16.2555 5.48248 16.256 6.51881 15.6208 7.18947C14.1923 8.69756 11.739 10.7586 8.99992 10.7586Z" fill="#333333"/>
					<path d="M8.99991 2.27588C7.03671 2.27588 5.43945 3.94657 5.43945 6.00003C5.43945 8.05349 7.03671 9.72418 8.99991 9.72418C10.9631 9.72418 12.5604 8.05349 12.5604 6.00003C12.5604 3.94657 10.9631 2.27588 8.99991 2.27588ZM8.99991 8.48277C7.69104 8.48277 6.6263 7.36904 6.6263 6.00003C6.6263 4.63102 7.69108 3.51729 8.99991 3.51729C10.3087 3.51729 11.3735 4.63102 11.3735 6.00003C11.3735 7.36904 10.3088 8.48277 8.99991 8.48277Z" fill="#333333"/>
				</svg>
			</div>
			<div class="moroz-popup__input-box">
				<input class="password-repeat-input" type="password" placeholder="Повторите пароль" data-name="password-repeat">
				<span class="error">!Пароли не совпадают</span>
				<svg class="cursor-pointer eye-toggler visible" id="" width="19" height="6" viewBox="0 0 19 6" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.4246 1.0515L17.5539 0.969172C17.8056 0.801214 17.8648 0.469603 17.6905 0.228352C17.5148 -0.0150493 17.1691 -0.0699825 16.9226 0.0956798C8.29805 5.91294 2.01995 0.381967 1.7562 0.144302C1.53364 -0.0566439 1.18293 -0.0464608 0.975677 0.166964C0.767388 0.381249 0.777497 0.716448 0.997829 0.918111C1.00972 0.929012 1.20612 1.10242 1.56457 1.35902L0.459786 3.11676C0.302194 3.36747 0.384855 3.69478 0.644882 3.84811C0.733788 3.89974 0.834736 3.92571 0.932413 3.92571C1.1181 3.92571 1.29889 3.83463 1.404 3.67069L2.48425 1.95339C3.08994 2.3091 3.8666 2.69751 4.79193 3.02568L4.25954 4.74283C4.17137 5.02553 4.33625 5.32043 4.6275 5.40448L4.78628 5.42714C5.02163 5.42714 5.24166 5.27797 5.31332 5.04719L5.84051 3.35356C6.69463 3.57889 7.65014 3.73107 8.68133 3.76722V5.46802C8.68133 5.76234 8.92768 6 9.23275 6C9.53753 6 9.78403 5.76234 9.78403 5.46802V3.75775C10.6838 3.71013 11.6374 3.56082 12.633 3.28687L13.3117 5.01348C13.3963 5.22619 13.6059 5.35643 13.8273 5.35643L14.0224 5.32286C14.3071 5.21845 14.4514 4.91165 14.3432 4.63712L13.6823 2.95482C14.5889 2.62995 15.526 2.20224 16.4939 1.63483L17.3872 2.78529C17.4961 2.92427 17.6621 2.99886 17.8281 2.99886C17.9437 2.99886 18.0592 2.96501 18.1584 2.892C18.4028 2.71558 18.4522 2.38211 18.2702 2.14731L17.4246 1.0515Z" fill="#BDBDBD"/>
				</svg>
				<svg class="cursor-pointer eye-toggler hidden" width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.8856 5.6338C17.7248 5.40371 13.8934 0 8.99992 0C4.10647 0 0.274852 5.40371 0.114223 5.63358C-0.0380743 5.85186 -0.0380743 6.14792 0.114223 6.3662C0.274852 6.59629 4.10647 12 8.99992 12C13.8934 12 17.7248 6.59625 17.8856 6.36638C18.0381 6.14814 18.0381 5.85186 17.8856 5.6338ZM8.99992 10.7586C6.26642 10.7586 3.81047 8.69603 2.38009 7.18782C1.74438 6.51753 1.74381 5.48116 2.37909 4.81047C3.80756 3.30238 6.26089 1.24137 8.99992 1.24137C11.7335 1.24137 14.1894 3.30387 15.6198 4.8122C16.2555 5.48248 16.256 6.51881 15.6208 7.18947C14.1923 8.69756 11.739 10.7586 8.99992 10.7586Z" fill="#333333"/>
					<path d="M8.99991 2.27588C7.03671 2.27588 5.43945 3.94657 5.43945 6.00003C5.43945 8.05349 7.03671 9.72418 8.99991 9.72418C10.9631 9.72418 12.5604 8.05349 12.5604 6.00003C12.5604 3.94657 10.9631 2.27588 8.99991 2.27588ZM8.99991 8.48277C7.69104 8.48277 6.6263 7.36904 6.6263 6.00003C6.6263 4.63102 7.69108 3.51729 8.99991 3.51729C10.3087 3.51729 11.3735 4.63102 11.3735 6.00003C11.3735 7.36904 10.3088 8.48277 8.99991 8.48277Z" fill="#333333"/>
				</svg>
			</div>
			<div class="moroz-popup__input-box">
				<input class="email-input" type="text" placeholder="Email" data-name="email">
				<span class="error">!Не верно указан email</span>
			</div>
			<div class="moroz-popup__policy">
				<div class="moroz-popup__agree-wrapper">
					<div class="moroz-popup__checkbox">
						<svg class="hidden check-icon" width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12.4556 0.179484C12.2163 -0.0598279 11.8284 -0.0598279 11.589 0.179484L4.2478 7.5208L1.42594 4.69895C1.18666 4.45964 0.798702 4.45966 0.559366 4.69895C0.320055 4.93824 0.320055 5.32619 0.559366 5.5655L3.81451 8.8206C4.05373 9.05989 4.44197 9.05972 4.68109 8.8206L12.4556 1.04606C12.6949 0.806773 12.6949 0.418795 12.4556 0.179484Z" fill="#FE182A"/>
						</svg>
						<input class="popup-checkbox agree-input" type="checkbox" data-name="policy" />
						<span class="error">!Это обязательно</span>
					</div>
					<div class="moroz-popup__agree-text">
						<p>Принимаю условия <a href="<?= home_url('/user-agreement'); ?>" target="_blank">соглашения</a></p>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="moroz-popup__submit">
			<a href="#" class="btnRed btn-big popup-submit">Регистрация</a>
            <div class="moroz-popup__loader">
                <i class="fas fa-spinner"></i>
            </div>
		</div>
		
		<div class="moroz-popup__swap">
			<a class="red-link open-binded" data-popup="popup-login" href="#">Войти</a>
		</div>
	
	</div>
</div>

<div class="moroz-popup" id="popup-recovery">
	<div class="moroz-popup__window" data-action="send_reset_link">
		<div class="moroz-popup__close-container">
			<div class="moroz-popup__close-btn"></div>
		</div>
		<div class="moroz-popup__title">
			<p>ВОССТАНОВЛЕНИЕ<br />ПАРОЛЯ</p>
		</div>
		
		<div class="moroz-popup__form">
			<div class="moroz-popup__input-box">
				<input class="email-input" type="text" placeholder="Email" data-name="email">
				<span class="error">!Введите ваш email</span>
			</div>
		</div>
		
		<div class="moroz-popup__submit">
			<a href="#" class="btnRed btn-big popup-submit">Отправить</a>
            <div class="moroz-popup__loader">
                <i class="fas fa-spinner"></i>
            </div>
		</div>
	</div>
</div>

<?php $popup_class = "";
if ( isset($_GET['action']) ) {
    if ($_GET['action'] == "rp") {
		$key = $_GET['key'];
		$login = $_GET['login'];
	
		$is_ok = check_password_reset_key( $key, $login );
	
		if (!is_wp_error($is_ok)) {
			$popup_class = "active";
		}
    }
} ?>
<div class="moroz-popup <?= $popup_class; ?>" id="popup-new-password">
	<div class="moroz-popup__window" data-action="reset_password">
		<div class="moroz-popup__close-container">
			<div class="moroz-popup__close-btn"></div>
		</div>
		<div class="moroz-popup__title">
			<p>ВОССТАНОВЛЕНИЕ<br />ПАРОЛЯ</p>
		</div>
		
		<div class="moroz-popup__form">
			<div class="moroz-popup__input-box">
				<input class="password-input" type="password" placeholder="Новый пароль" data-name="password">
				<span class="error">!Пароль должен содержать минимум 8 символов</span>
				<svg class="cursor-pointer eye-toggler visible" id="" width="19" height="6" viewBox="0 0 19 6" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.4246 1.0515L17.5539 0.969172C17.8056 0.801214 17.8648 0.469603 17.6905 0.228352C17.5148 -0.0150493 17.1691 -0.0699825 16.9226 0.0956798C8.29805 5.91294 2.01995 0.381967 1.7562 0.144302C1.53364 -0.0566439 1.18293 -0.0464608 0.975677 0.166964C0.767388 0.381249 0.777497 0.716448 0.997829 0.918111C1.00972 0.929012 1.20612 1.10242 1.56457 1.35902L0.459786 3.11676C0.302194 3.36747 0.384855 3.69478 0.644882 3.84811C0.733788 3.89974 0.834736 3.92571 0.932413 3.92571C1.1181 3.92571 1.29889 3.83463 1.404 3.67069L2.48425 1.95339C3.08994 2.3091 3.8666 2.69751 4.79193 3.02568L4.25954 4.74283C4.17137 5.02553 4.33625 5.32043 4.6275 5.40448L4.78628 5.42714C5.02163 5.42714 5.24166 5.27797 5.31332 5.04719L5.84051 3.35356C6.69463 3.57889 7.65014 3.73107 8.68133 3.76722V5.46802C8.68133 5.76234 8.92768 6 9.23275 6C9.53753 6 9.78403 5.76234 9.78403 5.46802V3.75775C10.6838 3.71013 11.6374 3.56082 12.633 3.28687L13.3117 5.01348C13.3963 5.22619 13.6059 5.35643 13.8273 5.35643L14.0224 5.32286C14.3071 5.21845 14.4514 4.91165 14.3432 4.63712L13.6823 2.95482C14.5889 2.62995 15.526 2.20224 16.4939 1.63483L17.3872 2.78529C17.4961 2.92427 17.6621 2.99886 17.8281 2.99886C17.9437 2.99886 18.0592 2.96501 18.1584 2.892C18.4028 2.71558 18.4522 2.38211 18.2702 2.14731L17.4246 1.0515Z" fill="#BDBDBD"/>
				</svg>
				<svg class="cursor-pointer eye-toggler hidden" width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.8856 5.6338C17.7248 5.40371 13.8934 0 8.99992 0C4.10647 0 0.274852 5.40371 0.114223 5.63358C-0.0380743 5.85186 -0.0380743 6.14792 0.114223 6.3662C0.274852 6.59629 4.10647 12 8.99992 12C13.8934 12 17.7248 6.59625 17.8856 6.36638C18.0381 6.14814 18.0381 5.85186 17.8856 5.6338ZM8.99992 10.7586C6.26642 10.7586 3.81047 8.69603 2.38009 7.18782C1.74438 6.51753 1.74381 5.48116 2.37909 4.81047C3.80756 3.30238 6.26089 1.24137 8.99992 1.24137C11.7335 1.24137 14.1894 3.30387 15.6198 4.8122C16.2555 5.48248 16.256 6.51881 15.6208 7.18947C14.1923 8.69756 11.739 10.7586 8.99992 10.7586Z" fill="#333333"/>
					<path d="M8.99991 2.27588C7.03671 2.27588 5.43945 3.94657 5.43945 6.00003C5.43945 8.05349 7.03671 9.72418 8.99991 9.72418C10.9631 9.72418 12.5604 8.05349 12.5604 6.00003C12.5604 3.94657 10.9631 2.27588 8.99991 2.27588ZM8.99991 8.48277C7.69104 8.48277 6.6263 7.36904 6.6263 6.00003C6.6263 4.63102 7.69108 3.51729 8.99991 3.51729C10.3087 3.51729 11.3735 4.63102 11.3735 6.00003C11.3735 7.36904 10.3088 8.48277 8.99991 8.48277Z" fill="#333333"/>
				</svg>
			</div>
			<div class="moroz-popup__input-box">
				<input class="password-repeat-input" type="password" placeholder="Повторите пароль" data-name="password-repeat">
				<span class="error">!Указанные пароли не совпадают</span>
				<svg class="cursor-pointer eye-toggler visible" width="19" height="6" viewBox="0 0 19 6" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.4246 1.0515L17.5539 0.969172C17.8056 0.801214 17.8648 0.469603 17.6905 0.228352C17.5148 -0.0150493 17.1691 -0.0699825 16.9226 0.0956798C8.29805 5.91294 2.01995 0.381967 1.7562 0.144302C1.53364 -0.0566439 1.18293 -0.0464608 0.975677 0.166964C0.767388 0.381249 0.777497 0.716448 0.997829 0.918111C1.00972 0.929012 1.20612 1.10242 1.56457 1.35902L0.459786 3.11676C0.302194 3.36747 0.384855 3.69478 0.644882 3.84811C0.733788 3.89974 0.834736 3.92571 0.932413 3.92571C1.1181 3.92571 1.29889 3.83463 1.404 3.67069L2.48425 1.95339C3.08994 2.3091 3.8666 2.69751 4.79193 3.02568L4.25954 4.74283C4.17137 5.02553 4.33625 5.32043 4.6275 5.40448L4.78628 5.42714C5.02163 5.42714 5.24166 5.27797 5.31332 5.04719L5.84051 3.35356C6.69463 3.57889 7.65014 3.73107 8.68133 3.76722V5.46802C8.68133 5.76234 8.92768 6 9.23275 6C9.53753 6 9.78403 5.76234 9.78403 5.46802V3.75775C10.6838 3.71013 11.6374 3.56082 12.633 3.28687L13.3117 5.01348C13.3963 5.22619 13.6059 5.35643 13.8273 5.35643L14.0224 5.32286C14.3071 5.21845 14.4514 4.91165 14.3432 4.63712L13.6823 2.95482C14.5889 2.62995 15.526 2.20224 16.4939 1.63483L17.3872 2.78529C17.4961 2.92427 17.6621 2.99886 17.8281 2.99886C17.9437 2.99886 18.0592 2.96501 18.1584 2.892C18.4028 2.71558 18.4522 2.38211 18.2702 2.14731L17.4246 1.0515Z" fill="#BDBDBD"/>
				</svg>
				<svg class="cursor-pointer eye-toggler hidden" width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.8856 5.6338C17.7248 5.40371 13.8934 0 8.99992 0C4.10647 0 0.274852 5.40371 0.114223 5.63358C-0.0380743 5.85186 -0.0380743 6.14792 0.114223 6.3662C0.274852 6.59629 4.10647 12 8.99992 12C13.8934 12 17.7248 6.59625 17.8856 6.36638C18.0381 6.14814 18.0381 5.85186 17.8856 5.6338ZM8.99992 10.7586C6.26642 10.7586 3.81047 8.69603 2.38009 7.18782C1.74438 6.51753 1.74381 5.48116 2.37909 4.81047C3.80756 3.30238 6.26089 1.24137 8.99992 1.24137C11.7335 1.24137 14.1894 3.30387 15.6198 4.8122C16.2555 5.48248 16.256 6.51881 15.6208 7.18947C14.1923 8.69756 11.739 10.7586 8.99992 10.7586Z" fill="#333333"/>
					<path d="M8.99991 2.27588C7.03671 2.27588 5.43945 3.94657 5.43945 6.00003C5.43945 8.05349 7.03671 9.72418 8.99991 9.72418C10.9631 9.72418 12.5604 8.05349 12.5604 6.00003C12.5604 3.94657 10.9631 2.27588 8.99991 2.27588ZM8.99991 8.48277C7.69104 8.48277 6.6263 7.36904 6.6263 6.00003C6.6263 4.63102 7.69108 3.51729 8.99991 3.51729C10.3087 3.51729 11.3735 4.63102 11.3735 6.00003C11.3735 7.36904 10.3088 8.48277 8.99991 8.48277Z" fill="#333333"/>
				</svg>
			</div>
		</div>
		
		<div class="moroz-popup__submit">
			<a href="#" class="btnRed btn-big popup-submit">Сменить пароль</a>
            <div class="moroz-popup__loader">
                <i class="fas fa-spinner"></i>
            </div>
		</div>
	</div>
</div>

<div class="moroz-popup moroz-popup-response" id="popup-response">
	<div class="moroz-popup__window">
		<div class="moroz-popup__close-container">
			<div class="moroz-popup__close-btn"></div>
		</div>
		<div class="moroz-popup__response-wrapper">
			<picture>
				<source type="image/svg+xml" srcset="<?= get_template_directory_uri(); ?>/img/icons/letter_response.svg" />
				<img src="<?= get_template_directory_uri(); ?>/img/icons/letter_response.png" />
			</picture>
			<p class="response-main">Спасибо! В скором времени мы с вами свяжемся.</p>
		</div>
	</div>
</div>

<div class="moroz-popup moroz-popup-response" id="alert-message">
    <div class="moroz-popup__window">
        <div class="moroz-popup__response-wrapper">
            <picture>
                <source type="image/svg+xml" srcset="<?= get_template_directory_uri(); ?>/img/icons/letter_response.svg" />
                <img src="<?= get_template_directory_uri(); ?>/img/icons/letter_response.png" />
            </picture>
            <p class="response-main"></p>
        </div>
    </div>
</div>