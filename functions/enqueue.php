<?php
/**
 * Get minify jQuery from Google CDN
 */
add_action( 'wp_enqueue_scripts', 'add_jquery', 99 );
function add_jquery() {
	wp_enqueue_script( 'jquery' );
	$wp_jquery_ver = $GLOBALS['wp_scripts']->registered['jquery']->ver;
	$jquery_ver = $wp_jquery_ver == '' ? '1.11.0' : $wp_jquery_ver;
	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/'. $jquery_ver .'/jquery.min.js' );
	wp_enqueue_script( 'jquery' );
}

/**
 * Includes front styles
 */
add_action('wp_enqueue_scripts', 'add_styles');
function add_styles() {
	wp_enqueue_style( 'additional', get_template_directory_uri() . '/css/additional/main.css' );
	if (is_page('onlineschool')) { // Онлайн школа
		wp_enqueue_style('slick-styles', get_template_directory_uri() . '/slick/slick.css' );
	}
	if ( is_archive() ) { // Страница архива (Магазина)
		wp_enqueue_style('shop', get_template_directory_uri() . '/css/additional/shop.css' );
	}
	if ( is_page(['user-delete', 'user-agreement', 'privacy']) ) {
		wp_enqueue_style('shop', get_template_directory_uri() . '/css/additional/office.css' );
	}
}

/**
 * Includes admin styles
 */
add_action( 'admin_enqueue_scripts', 'add_admin_styles' );
function add_admin_styles() {
	wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/css/additional/admin.css' );
}

/**
 * Includes scripts
 */
add_action ('wp_enqueue_scripts', 'add_scripts');
function add_scripts () {
	wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/519fd0f28a.js', array(), null, true);
	wp_enqueue_script('uncompleted-function', get_template_directory_uri() . '/js/uncompleted.js', array('jquery'), null, true);
	wp_enqueue_script('active-links', get_template_directory_uri() . '/js/active-links.js', array('jquery'), null, true);
	wp_enqueue_script('smooth-scrolling', get_template_directory_uri() . '/js/smooth-scroll.js', array('jquery'), null, true);
	
	wp_enqueue_script('popup', get_template_directory_uri() . '/js/popup.js', array('jquery'), null, true);
	wp_localize_script('popup', 'dataPage', array(
		'title' => get_the_title(),
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('moroz-nonce'),
		'alert' => array(
			'addedToCart' => get_field('add_to_cart_notification'),
			'addedEvent' => get_field('add_to_user_notification'),
			'addedPrepay' => get_field('add_to_cart_prepay'),
			'addedLastPart' => get_field('add_to_cart_last_part'),
			'mpowerCartNotification' => get_field( 'add_to_cart_mpower', get_option( 'woocommerce_shop_page_id' ) ), // For Mpower_wear page
		),
	) );
	
	if (is_front_page()) { // Главная страница
		wp_enqueue_script('video-main', get_template_directory_uri() . '/js/video-main.js', array('jquery'), null, true);
		wp_localize_script('video-main', 'videoMoroz', array(
			'secondVideoId' => get_field('five_video_link', 33),
			'iconPlaySrc' => get_template_directory_uri() . '/img/icons/play.svg',
			'iconPlayImg' => get_template_directory_uri() . '/img/icons/play.png',
			'iconStopSrc' => get_template_directory_uri() . '/img/icons/stop.svg',
			'iconStopImg' => get_template_directory_uri() . '/img/icons/stop.png',
		) );
	}
	
	if (is_singular('marathon')) { // Мероприятие
		wp_enqueue_script('marathon', get_template_directory_uri() . '/js/marathon.js', array(), null, true);
		wp_localize_script('marathon', 'videoMoroz', array(
			'videoId' => get_field('video_id'),
		) );
		wp_localize_script('popup', 'dataEvent', array(
			'user_id' => get_current_user_id(),
			'event_id' => get_the_ID(),
		));
	}
	
	if (is_page('about')) { // Обо мне
		wp_enqueue_script('about', get_template_directory_uri() . '/js/about.js', array('jquery'), null, true);
		wp_localize_script('about', 'videoMoroz', array(
			'videoId' => get_field('video_id'),
		) );
	}
	
	if (is_page('onlineschool')) { // Архив курсов
		wp_enqueue_script('slick', get_template_directory_uri() . '/slick/slick.min.js', array('jquery'), null, true);
		wp_enqueue_script('online-school', get_template_directory_uri() . '/js/online-school.js', array('slick', 'jquery'), null, true);
	}
	
	if (is_page('privateoffice')) { // Личный кабинет
		wp_enqueue_script('user-account', get_template_directory_uri() . '/js/user-account.js', array('jquery'), null, true);
		wp_enqueue_script('user-account-video', get_template_directory_uri() . '/js/user-account-video.js', array('jquery'), null, true);
		wp_localize_script('user-account-video', 'video', get_video_ids()); // Event video ids
		wp_localize_script('user-account-video', 'videoCourse', get_video_course_ids()); // Course video ids
	}
	
	if ( is_archive() ) { // Страница архива (Магазина)
		wp_enqueue_script('shop-script', get_template_directory_uri() . '/js/shop.js', array('jquery'), null, true);
	}
}


