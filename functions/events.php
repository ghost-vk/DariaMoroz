<?php

/**
 * Function adds event without paid access to user
 * @param $user_id {Integer}
 * @param $event_id {Integer}
 * @return {Boolean}
 */
function add_event_to_user ($user_id, $event_id) {
	$exists_events = get_field('events_access', 'user_' . $user_id);
	
	if (isset($exists_events) && gettype($exists_events) == 'array') { // If user have event
		
		foreach ($exists_events as $event) { // Check is user have this event
			if ( $event_id == $event['event'][0] ) {
				return false;
			}
		}
		
		$new_access = array(
			'event' => [ $event_id ],
			'access' => false,
		);
		array_push($exists_events, $new_access);
		$is_updated = update_field( 'events_access', $exists_events, 'user_' . $user_id );
		
		return $is_updated;
	} else { // If user haven't event
		$exists_events = [];
		$new_access = array(
			'event' => [ $event_id ],
			'access' => false,
		);
		array_push($exists_events, $new_access);
		$is_updated = update_field( 'events_access', $exists_events, 'user_' . $user_id );
		
		return $is_updated;
	}
}

if ( wp_doing_ajax() ) { // Add ajax actions only when it necessary
	
	// Add event to user
	add_action( 'wp_ajax_add_event_to_user', 'add_event_to_user_handle' );
	add_action( 'wp_ajax_nopriv_add_event_to_user', 'add_event_to_user_handle' );
}

/**
 * Add event to user via ajax
 */
function add_event_to_user_handle() {
	check_ajax_referer( 'moroz-nonce', 'nonce' ); // Check nonce code
	
	$user_id = $_POST['user_id'];
	$event_id = $_POST['event_id'];
	
	if (isset($user_id) && isset($event_id)) {
		add_event_to_user($user_id, $event_id);
	}
	
	wp_die();
}