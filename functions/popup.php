<?php
if ( wp_doing_ajax() ) { // Add ajax actions only when it necessary
	// Get lid from marathon page
	add_action( 'wp_ajax_marathon_lid', 'get_marathon_lid' );
	add_action( 'wp_ajax_nopriv_marathon_lid', 'get_marathon_lid' );
	
	// Get lid from dynamic course
	add_action( 'wp_ajax_course_lid', 'get_course_lid' );
	add_action( 'wp_ajax_nopriv_course_lid', 'get_course_lid' );
	
	// Registration user
	add_action( 'wp_ajax_registration', 'register_user' );
	add_action( 'wp_ajax_nopriv_registration', 'register_user' );
	
	// Authentication user
	add_action( 'wp_ajax_authentication', 'authenticate_user' );
	add_action( 'wp_ajax_nopriv_authentication', 'authenticate_user' );
	
	// Authentication user
	add_action( 'wp_ajax_send_reset_link', 'send_reset_link' );
	add_action( 'wp_ajax_nopriv_send_reset_link', 'send_reset_link' );
	
	// Reset password
	add_action( 'wp_ajax_reset_password', 'reset_user_password' );
	add_action( 'wp_ajax_nopriv_reset_password', 'reset_user_password' );
	
	// Add to cart
	add_action( 'wp_ajax_add_to_cart', 'add_to_cart' );
	add_action( 'wp_ajax_nopriv_add_to_cart', 'add_to_cart' );
	
	// Sending reminder
	add_action( 'wp_ajax_send_reminder', 'send_remind_message' );
	add_action( 'wp_ajax_nopriv_send_reminder', 'send_remind_message' );
}

/**
 * Get marathon lid data from form and send to telegram
 */
function get_marathon_lid() {
	check_ajax_referer( 'moroz-nonce', 'nonce' ); // Check nonce code
	
	$name = strip_tags(trim($_POST['user_name']));
	$contact = strip_tags(trim($_POST['contact']));
	$type = strip_tags(trim($_POST['contact_type']));
	$title = $_POST['title'];
	
	$message = $name . " интересуется мероприятием '". $title . "'\r\nВот контакт: " . $contact .
		"\r\nХочет связаться в " . $type;
	curl_send_telegram($message); // Sending via Telegram
	
	$user_id = $_POST['user_id'];
	$event_id = $_POST['event_id'];
	
	if (isset($user_id) && isset($event_id)) {
		add_event_to_user($user_id, $event_id);
	}
	
	echo "ok"; // Just a test
	
	wp_die();
}


/**
 * Get lid from dynamic course
 */
function get_course_lid() {
	check_ajax_referer( 'moroz-nonce', 'nonce' ); // Check nonce code
	
	$response = [];
	
	$name = strip_tags(trim($_POST['user_name']));
	$contact = strip_tags(trim($_POST['contact']));
	$type = strip_tags(trim($_POST['contact_type']));
	$title = $_POST['title'];
	
	$message = $name . " хочет зарегистрироваться на курс '". $title . "'\r\nВот контакт: " . $contact .
		"\r\nПросит связаться в " . $type;
	curl_send_telegram($message); // Sending via Telegram
	
	$response["message"] = "Спасибо за регистрацию, с вами свяжется наш менеджер";
	
	wp_send_json($response);
	wp_die();
}


/**
 * Register and authenticate user (need to update page)
 */
function register_user() {
	check_ajax_referer( 'moroz-nonce', 'nonce' ); // Check nonce code
	
	$name = $_POST['name'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	$response = array(
		'message' => 'not',
		'success' => 'not',
		'action' => 'reload',
	);
	
	if ( email_exists($email) ) { // Already registered email
		$response["message"] = "Пользователь с таким email уже существует";
		$response["success"] = "not";
	} else {
		$new_user_id = wp_insert_user(
			array(
				'user_login' => $email,
				'user_email' => $email,
				'user_pass' => $password,
			)
		);
		
		if ( ! is_wp_error( $new_user_id ) ) { // If not error
			update_user_meta( $new_user_id, 'first_name', $name );
			$response["message"] = "Вы успешно зарегистрировались";
			$response["success"] = "yes";
			
			$signon = wp_signon(array(
				'user_login' => $email,
				'user_password' => $password,
				'remember' => true,
			));
			
			if ( !is_wp_error( $signon ) ) { // If not error
				// Set cookies
				wp_clear_auth_cookie();
				clean_user_cache( $signon->ID );
				wp_set_current_user( $signon->ID );
				wp_set_auth_cookie( $signon->ID );
				update_user_caches( $signon );
			}
			
		} else {
			$response["message"] = "Упс... Что-то пошло не так";
			$response["success"] = "not";
		}
	}
	
	wp_send_json($response);
	wp_die();
}

/**
 * Authenticates user (need to reload page)
 */
function authenticate_user() {
	check_ajax_referer( 'moroz-nonce', 'nonce' ); // Check nonce code
	
	$password = $_POST['password'];
	$email = $_POST['email'];
	$response = array(
		"action" => "reload",
	);
	
	if (! email_exists($email)) {
		$response["message"] = "Такого пользователя не существует";
		$response["success"] = "not";
	} else {
		$signon = wp_signon(array(
			'user_login' => $email,
			'user_password' => $password,
			'remember' => true,
		));
		
		if ( !is_wp_error( $signon ) ) { // If not error
			// Set cookies
			wp_clear_auth_cookie();
			clean_user_cache( $signon->ID );
			wp_set_current_user( $signon->ID );
			wp_set_auth_cookie( $signon->ID );
			update_user_caches( $signon );
			
			$response["message"] = "Добро пожаловать!";
			$response["success"] = "yes";
		} else {
			$response["message"] = "Введённые логин/пароль не верны";
			$response["success"] = "not";
		}
	}
	
	wp_send_json($response);
	wp_die();
}

/**
 * Send link to reset password
 */
function send_reset_link() {
	check_ajax_referer( 'moroz-nonce', 'nonce' ); // Check nonce code
	$response = array();
	
	$email = $_POST['email'];
	$user = get_user_by( 'email', $email ); // Login = email
	
	if (!email_exists($email) || !$user) {
		$response["message"] = "Такого пользователя не существует $email";
	} elseif (is_user_logged_in() ) {
		$response["message"] = "Вы уже авторизованы, перезагрузите страницу";
	} else {
		$key = get_password_reset_key($user);

		$rp_link = home_url() . "/?action=rp&key=$key&login=" . rawurlencode($email);

		$email_content  = "Кто-то запросил сброс пароля на сайте " . home_url() . "\r\n\r\n";
		$email_content .= "Если это были не вы, проигнорируйте это сообщение, как будто ничего не было :)\r\n\r\n";
		$email_content .= "Для восстановления пароля перейдите по следующей ссылке: " . $rp_link;
		
		$headers = [
			'From: Дарья Мороз <support@dariamoroz.ru>',
			'content-type: text/plain',
		];
		
		// Send email
		$is_send = wp_mail( $email, 'Восстановление пароля', $email_content, $headers );
		if ( $is_send == true ) {
			$response["message"] = "Ссылка для сброса пароля была выслана на email: " . $email;
		} else {
			$response["message"] = "Произошла ошибка, попробуйте ещё раз";
		}
	}
	
	wp_send_json($response);
	wp_die();
}

/**
 * Reset password
 */
function reset_user_password() {
	check_ajax_referer( 'moroz-nonce', 'nonce' ); // Check nonce code
	$response = array(
		"action" => "reload",
	);
	
	$key = $_POST['key'];
	$login = $_POST['login'];
	$new_password = $_POST['password'];
	$response["key"] = $key;
	$response["login"] = $login;
	$response["password"] = $new_password;
	
	$user = check_password_reset_key( $key, $login );
	
	if (!is_wp_error($user) && isset($new_password)) {
		$response["message"] = "Ваш пароль изменён!";
		$response["success"] = "yes";
		reset_password($user, $new_password);
		
		$signon = wp_signon(array(
			'user_login' => $login,
			'user_password' => $new_password,
			'remember' => true,
		));
		
		if ( !is_wp_error( $signon ) ) { // If not error
			// Set cookies
			wp_clear_auth_cookie();
			clean_user_cache( $signon->ID );
			wp_set_current_user( $signon->ID );
			wp_set_auth_cookie( $signon->ID );
			update_user_caches( $signon );
		}
	} else {
		$response["message"] = "Упс... Что-то пошло не так";
		$response["success"] = "no";
	}
	
	wp_send_json($response);
	wp_die();
}

/**
 * Add product to cart via ajax
 */
function add_to_cart() {
	check_ajax_referer( 'moroz-nonce', 'nonce' ); // Check nonce code
	
	global $woocommerce;
	
	$product_id = $_POST['product'];
	if ( isset($product_id) ) {
		$woocommerce->cart->add_to_cart( $product_id );
	}
	
	wp_die();
}

/**
 * Constructs and send remind message via AJAX
 */
function send_remind_message() {
	check_ajax_referer( 'moroz-nonce', 'nonce' ); // Check nonce code
	$response = array(
		"reminder" => true,
	);
	
	$user_name = $_POST['user_name'];
	$contact = $_POST['contact'];
	$contact_type = $_POST['contact_type'];
	$event_id = $_POST['event_id'];
	
	$event_title = get_the_title($event_id);
	$event_time = cut_year_dmy( get_field('marathonStart') );
	
	$message = "Запрос напоминания\r\n\r\n";
	$message .= "$user_name просит напомнить ему о мероприятии $event_title (старт в $event_time)\r\n";
	$message .= "В $contact_type. Вот его контакт: $contact";
	
	curl_send_telegram($message); // Sending via Telegram
	
	$response['message'] = $message;
	
	wp_send_json($response);
	wp_die();
}


