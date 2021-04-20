<?php

/**
 * Returns EVENT video IDs from event settings
 * @return array
 */
function get_video_ids() {
	$user_id = get_current_user_id();
	$ids = array();
	
	if (have_rows('events_access', 'user_' . $user_id)) { // If user have events
		$j = 0; // Outer counter
		while (have_rows('events_access', 'user_' . $user_id)) {
			the_row();
			$event_id = get_sub_field('event')[0];
			$event_access = get_sub_field('access');
			
			$free_lesson = get_field('free_lesson', $event_id);
			if ($free_lesson) { // If event have free lesson
				$ids["eventVideo_$j" . "_0"] = $free_lesson['video_id'];
			}
			
			if ($event_access) { // If user have access to event
				if (have_rows('lessons', $event_id)) {
					$i = 1; // Inner counter
					while (have_rows('lessons', $event_id)) {
						the_row();
						$ids["eventVideo_$j" . "_$i"] = get_sub_field('video_id');
						$i += 1;
					}
				}
			}
			
			$j += 1;
		}
	}
	
	return $ids;
}

/**
 * Returns COURSE video IDs from course product settings
 * @return array
 */
function get_video_course_ids () {
	$ids = array();
	$courses = get_user_paid_orders(); // Get paid courses IDs (products)
	
	if ( !empty($courses) ) { // If user have purchased courses
		foreach ($courses as $j => $product_id) {
			if (have_rows('lesson', $product_id)) {
				$i = 1; // Inner counter from 1 because haven't free lesson
				while (have_rows('lesson', $product_id)) {
					the_row();
					$ids["courseVideo_$j" . "_$i"] = get_sub_field('video_id');
					$i += 1;
				}
			}
		}
	}
	
	return $ids;
}