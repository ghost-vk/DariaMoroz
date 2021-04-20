<?php
/*
Template Name: Тестовая страница
Template Post Type: page
*/
?>

<?php
$user_id = get_current_user_id();

add_event_to_user($user_id, 90);

$new_events = get_field('events_access', 'user_' . $user_id);

?>

<div class="tester">
	<?php foreach ($new_events as $event) : ?>
		<p>Event: <?php var_dump($event); ?></p>
	<?php endforeach; ?>
</div>