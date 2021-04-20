<?php
require_once __DIR__ . '/../models/thirdPartyUser.class.php';

/**
 * VK authorization handler
 */
function authenticate_vk() {
	$params = array(
		'client_id'     => '7780718', // App ID
		'client_secret' => 'N5lHOjcP87ucJ6KwPsyj', // App secret key
		'redirect_uri'  => 'https://dariamoroz.ru',
		'code'          => $_GET['code']
	);
	
	// Get access_token
	$data = file_get_contents('https://oauth.vk.com/access_token?' . urldecode( http_build_query($params)) );
	$data = json_decode( $data, true );
	
	if ( empty($data['access_token']) ) {
		return false;
	}
	
	// Get user data
	$params = array(
		'v'            => '5.52',
		'uids'         => $data['user_id'],
		'access_token' => $data['access_token'],
	);
	
	$info = file_get_contents('https://api.vk.com/method/users.get?' . urldecode(http_build_query($params)));
	$info = json_decode($info, true);
	$user_id = $info['response'][0]['id'];
	$user_first_name = $info['response'][0]['first_name'];
	
	
	if ( empty($user_id) ) {
		return false;
	}
	
	$username = 'vk_' . $user_id;
	$user_from_vk = new MOROZ\ThirdPartyUser($username, $user_first_name);
	
	if ( !username_exists($username) ) { // Register if haven't that user
		$user_from_vk->register_user();
	}
	
	$user_from_vk->authorize_user();
	
}

/**
 * Facebook authorization handler
 */
function authenticate_fb() {
	$params = array(
		'client_id'     => '852472638811925', // App ID
		'client_secret' => '5c514c088bbcba3e049b0faf8e9109bb', // App secret code
		'redirect_uri'  => 'https://dariamoroz.ru/auth-facebook/', // Handler
		'code'          => $_GET['code']
	);
	
	// Get access_token
	$data = file_get_contents('https://graph.facebook.com/oauth/access_token?' . urldecode(http_build_query($params)));
	$data = json_decode($data, true);
	
	if ( empty($data['access_token']) ) {
		return false;
	}
	
	$params = array(
		'access_token' => $data['access_token'],
		'fields'       => 'id,first_name'
	);
	
	// Get user data
	$info = file_get_contents('https://graph.facebook.com/me?' . urldecode(http_build_query($params)));
	$info = json_decode($info, true);
	
	$user_id = $info['id'];
	
	if ( !$user_id ) {
		return false;
	}
	$username = 'fb_' . $info['id'];
	$user_first_name = $info['first_name'];
	$user_from_fb = new MOROZ\ThirdPartyUser($username, $user_first_name);
	
	if ( !username_exists($username) ) { // Register if haven't that user
		$user_from_fb->register_user();
	}
	
	$user_from_fb->authorize_user();
	
	header("Location: " . home_url() );
}

/**
 * Google authorization handler
 */
function authenticate_google() {
	// Send code and get token (POST).
	$params = array(
		'client_id' => '644128964844-p9f9r9h1het6faieqe9to7ajickvl1no.apps.googleusercontent.com',
		'client_secret' => 'AeBPUbt4Q7HxQEWOneipp4IV',
		'redirect_uri' => 'https://dariamoroz.ru/auth-google/',
		'grant_type' => 'authorization_code',
		'code' => $_GET['code']
	);
	
	$ch = curl_init('https://accounts.google.com/o/oauth2/token');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$data = curl_exec($ch);
	curl_close($ch);
	
	$data = json_decode($data, true);
	if ( empty($data['access_token']) ) {
		return false;
	}
	
	// Get user data
	$params = array(
		'access_token' => $data['access_token'],
		'id_token' => $data['id_token'],
		'token_type' => 'Bearer',
		'expires_in' => 3599
	);
	
	$info = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?' . urldecode(http_build_query($params)));
	$info = json_decode($info, true);
	
	$first_name = $info['given_name'];
	$user_id = $info['id'];
	
	$username = 'google_' . $user_id;
	$user_from_fb = new MOROZ\ThirdPartyUser($username, $first_name);
	if ( !username_exists($username) ) { // Register if haven't that user
		$user_from_fb->register_user();
	}
	
	$user_from_fb->authorize_user();
	
	header("Location: " . home_url() );
	
}







