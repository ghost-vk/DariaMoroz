<?php

/**
 * @param $num число, от которого будет зависеть форма слова
 * @param $form_for_1 первая форма слова, например Товар
 * @param $form_for_2 вторая форма слова - Товара
 * @param $form_for_5 третья форма множественного числа слова - Товаров
 * @return mixed
 */
function get_word_form($num, $form_for_1, $form_for_2, $form_for_5) {
	$num = abs($num) % 100;
	$num_x = $num % 10;
	if ($num > 10 && $num < 20) // если число принадлежит отрезку [11;19]
		return $form_for_5;
	if ($num_x > 1 && $num_x < 5) // иначе если число оканчивается на 2,3,4
		return $form_for_2;
	if ($num_x == 1) // иначе если оканчивается на 1
		return $form_for_1;
	return $form_for_5;
}


/*
 * Функция создает дубликат поста в виде черновика и редиректит на его страницу редактирования
 */
function true_duplicate_post_as_draft () {
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'true_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('Нечего дублировать!');
	}
	
	/*
	 * получаем ID оригинального поста
	 */
	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	/*
	 * а затем и все его данные
	 */
	$post = get_post( $post_id );
	
	/*
	 * если вы не хотите, чтобы текущий автор был автором нового поста
	 * тогда замените следующие две строчки на: $new_post_author = $post->post_author;
	 * при замене этих строк автор будет копироваться из оригинального поста
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
	
	/*
	 * если пост существует, создаем его дубликат
	 */
	if (isset( $post ) && $post != null) {
		
		/*
		 * массив данных нового поста
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft', // черновик, если хотите сразу публиковать - замените на publish
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
		
		/*
		 * создаем пост при помощи функции wp_insert_post()
		 */
		$new_post_id = wp_insert_post( $args );
		
		/*
		 * присваиваем новому посту все элементы таксономий (рубрики, метки и т.д.) старого
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // возвращает массив названий таксономий, используемых для указанного типа поста, например array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
		
		/*
		 * дублируем все произвольные поля
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
		
		
		/*
		 * и наконец, перенаправляем пользователя на страницу редактирования нового поста
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Ошибка создания поста, не могу найти оригинальный пост с ID=: ' . $post_id);
	}
}
add_action( 'admin_action_true_duplicate_post_as_draft', 'true_duplicate_post_as_draft' );

/**
 * Добавляем ссылку дублирования поста для post_row_actions
 */
function true_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="admin.php?action=true_duplicate_post_as_draft&post=' . $post->ID . '" title="Дублировать этот пост" rel="permalink">Дублировать</a>';
	}
	return $actions;
}

add_filter( 'post_row_actions', 'true_duplicate_post_link', 10, 2 );
add_filter( 'page_row_actions', 'true_duplicate_post_link', 10, 2 );
add_filter( 'course_row_actions', 'true_duplicate_post_link', 10, 2 );
add_filter( 'marathon_row_actions', 'true_duplicate_post_link', 10, 2 );

/**
 * @param $type
 * @param $category
 * @return array
 */
function get_args_for_school_query($category, $type = '', $today = '', $need_post_count = 1, $exclude = []) {
	if ( $category == 'course_single' && isset($today) ) { // Products category
		if ($type == 'waiting') {
			$date_interval = [$today, '2100-01-01 00:00:00'];
			$order = 'ASC';
		} elseif ($type == 'running') {
			$date_interval = ['2000-01-01 00:00:00', $today];
			$order = 'DESC';
		} else {
			return [];
		}
		
		$args = array(
			'post_type' => 'course',
			'post__not_in' => $exclude,
			'posts_per_page' => $need_post_count,
			'meta_query' => array(
				'relation' => 'AND',
				'course_start' => [
					'key' => 'start_date',
					'value' => $date_interval,
					'compare' => 'BETWEEN',
					'type' => 'DATETIME'
				],
				'course_type' => [
					'key' => 'course_category',
					'value' => $category,
					'compare' => '=',
					'type' => 'CHAR'
				]
			),
			'orderby' => 'course_start',
			'order' => $order,
		);
		
		return $args;
		
	} elseif ($category == 'course_multi') {
		
		$order = 'DESC';
		$args = array(
			'post_type' => 'course',
			'post__not_in' => $exclude,
			'posts_per_page' => $need_post_count,
			'meta_query' => array(
				'course_type' => [
					'key' => 'course_category',
					'value' => $category,
					'compare' => '=',
					'type' => 'CHAR'
				]
			),
			'orderby' => 'date',
			'order' => $order,
		);
		return $args;
		
	} else {
		return [];
	}
}

/**
 * @param exclude_ids {Array} - initial array
 * @return exclude_ids {Array} - pushed array
 */
function collect_exclude_ids($exclude_ids) {
	array_push($exclude_ids, get_the_ID());
	return $exclude_ids;
}

/**
 * Check using mobile devices
 * @return false|int
 */
function is_mobile() {
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

/**
 * Function validates password
 * @param $password
 * @param $password_repeat
 * @return array
 */
function validate_password($password, $password_repeat) {
	$response = array(
		'status' => 'error',
	);
	if ($password !== $password_repeat) {
		$response['message'] = 'Пароли не совпадают';
		return $response;
	}
	
	if (preg_match ('/[а-яёА-ЯЁ]+/u', $password)) {
		$response['message'] = 'Пароль только из латинских символов';
		return $response;
	}
	
	if (strlen($password) < 8) {
		$response['message'] = 'Пароль должен быть от 8 символов';
		return $response;
	}
	
	if (!preg_match ('/[a-z]/', $password)) {
		$response['message'] = 'Минимум 1 латинская буква';
		return $response;
	}
	
	if (!preg_match ('/[0-9]/', $password)) {
		$response['message'] = 'Минимум 1 цифра';
		return $response;
	}
	
	$response['message'] = 'Пароль успешно изменен';
	$response['status'] = 'success';
	return $response;
}

/**
 * Changes user password
 * @return array
 */
function change_user_password() {
	$password = sanitize_text_field($_POST['password']);
	$password_repeat = sanitize_text_field($_POST['password_repeat']);
	
	if (!isset($password) || !isset($password_repeat)) {
		return [];
	}
	
	$response = validate_password($password, $password_repeat);
	
	$user_id = get_current_user_id();
	wp_set_password( $password, $user_id );
	
	return $response;
}

/**
 * Get user orders to display in user account
 * @return {Array} - product ids
 */
function get_user_paid_orders( $categories = ['course-multi', 'course-single'] ) {
	$current_user = wp_get_current_user();
	if (0 == $current_user->ID) {
		return [];
	}
	// GET USER ORDERS (COMPLETED + PROCESSING)
	$customer_orders = get_posts(array(
		'numberposts' => -1,
		'meta_key' => '_customer_user',
		'meta_value' => $current_user->ID,
		'post_type' => wc_get_order_types(),
		'post_status' => 'wc-completed',
	));
	
	// LOOP THROUGH ORDERS AND GET PRODUCT IDS
	if (!$customer_orders) {
		return [];
	}
	$product_ids = array();
	$now = new \DateTime('now');
	foreach ($customer_orders as $customer_order) {
		$order = wc_get_order($customer_order->ID);
		$wc_order_date = $order->get_date_completed();
		$order_date = $wc_order_date->date('Y-m-d H:i:s');
		$order_datetime_object = \DateTime::createFromFormat('Y-m-d H:i:s', $order_date);
		
		$items = $order->get_items();
		foreach ($items as $item) {
			$product_id = $item->get_product_id();
			
			if (has_term($categories, 'product_cat', $product_id)) {
				
				$count_day_access = get_field('count_day_access', $product_id);
				$order_datetime_object->modify("+$count_day_access day");
				if ( $order_datetime_object < $now ) { // If course access ends
					continue;
				}
				
				$product_ids[] = $product_id;
			}
		}
	}
	return $product_ids;
}

/**
 * Get partial paid user product IDs
 * @returns $ids {Array}
 */
function get_uncompleted_products( $need_order = false ) {
	$current_user = wp_get_current_user();
	if ( 0 == $current_user->ID ) {
		return [];
	}
	// GET USER ORDERS (COMPLETED + PROCESSING)
	$customer_orders = get_posts(array(
		'numberposts' => -1,
		'meta_key' => '_customer_user',
		'meta_value' => $current_user->ID,
		'post_type' => wc_get_order_types(),
		'post_status' => 'wc-completed',
	));
	
	// LOOP THROUGH ORDERS AND GET PRODUCT IDS
	if (!$customer_orders) {
		return [];
	}
	$ids = array();
	foreach ( $customer_orders as $customer_order ) {
		$order = wc_get_order( $customer_order->ID );
		$items = $order->get_items();
		foreach ($items as $item) {
			$product_id = $item->get_product_id();
			
			if ( has_term( ['prepay-course'], 'product_cat', $product_id) ) { // If product in category
				$is_fee_applied = get_field( 'is_fee_applied', $customer_order->ID );
				
				if ( $is_fee_applied == false ) { // If fee is not applied
					
					if ( $need_order == false ) { // Only products
						$ids[] = $product_id;
					} elseif ( $need_order == true ) { // Order + products
						$ids[$customer_order->ID][] = $product_id;
					}
					
				}
			}
		}
	}
	return $ids;
}

/**
 * Send message to Manager
 * @param $message
 */
function curl_send_telegram($message) {
	$chat_id = get_field('manager_telegram_id', 'user_26'); // Get chat ID from admin settings
	
	$token = '1633498213:AAFdNOr4z2FxgA-ACP1pU8sJQdCp1zkTjkQ';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,
		'https://api.telegram.org/bot'.$token.'/sendMessage');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
		'chat_id=' . $chat_id . '&text=' . urlencode($message));
	$result = curl_exec($ch);
	curl_close($ch);
}

/**
 * Construct and send lid message from travel page
 */
function get_travel_lid() {
	$name = $_POST['user_name'];
	$phone = $_POST['user_phone'];
	
	if (!$name || !$phone) {
		return false;
	}
	
	$travel_title = get_field('main_title');
	
	$message = "$name интересуется путешествием $travel_title\r\n";
	$message .= "Просит связаться по контактному номеру: $phone";
	
	curl_send_telegram($message); // Send message to Manager via Telegram
}


/**
 * Removes metabox fields from WooCommerce admin product cards panel
 */
add_action('add_meta_boxes', 'remove_short_description', 999);
function remove_short_description() {
	remove_meta_box( 'postexcerpt', 'product', 'normal'); // Short description
	remove_meta_box( 'tagsdiv-product_tag', 'product', 'side' ); // Product tags
	remove_meta_box( 'woocommerce-product-images',  'product', 'side'); // Products gallery
}

/**
 * Returns URL path
 * @param $s
 * @param false $use_forwarded_host
 * @return string
 */
function get_url_origin( $s, $use_forwarded_host = false ) {
	$ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
	$sp       = strtolower( $s['SERVER_PROTOCOL'] );
	$protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
	$port     = $s['SERVER_PORT'];
	$port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
	$host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
	$host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
	return $protocol . '://' . $host;
}

/**
 * Returns URL path with request URI
 * @param $s
 * @param false $use_forwarded_host
 * @return string
 */
function get_full_url( $s, $use_forwarded_host = false ) {
	return get_url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}