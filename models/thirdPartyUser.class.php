<?php
namespace MOROZ;

class ThirdPartyUser {
	private $username;
	private $first_name;
	
	/**
	 * Constructor
	 * @param $username {String}
	 * @param $first_name {String}
	 */
	public function __construct($username, $first_name) {
		$this->username = $username;
		$this->first_name = $first_name;
	}
	
	/**
	 * Register new user
	 */
	public function register_user() {
		if ( !isset($this->username) || !isset($this->first_name) ) {
			return false;
		}
		$new_user_id = wp_insert_user(
			array(
				'user_login' => $this->username,
				'user_pass' => wp_generate_password( 15, true, true ),
			)
		);
		if ( ! is_wp_error( $new_user_id ) ) { // If not error
			update_user_meta($new_user_id, 'first_name', $this->first_name);
		}
	}
	
	/**
	 * Authorize user by login
	 * @return false
	 */
	public function authorize_user() {
		if ( !isset($this->username) || !isset($this->first_name) ) {
			return false;
		}
		
		$user = get_user_by( 'login', $this->username );

		if ( !is_wp_error( $user ) ) {
			$user_id = $user->ID;
			
			wp_clear_auth_cookie();
			clean_user_cache( $user_id );
			wp_set_current_user( $user_id );
			wp_set_auth_cookie( $user_id );
			update_user_caches( $user );
		}
	}
	
}