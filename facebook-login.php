<?php
/*
Template Name: Обработчик входа через Facebook
Template Post Type: page
*/
?>
<?php
if ( !empty($_GET['code']) ) { // If have OAuth code
	authenticate_fb();
} else {
    header("Location: " . home_url() );
} ?>
<?php get_header(); ?>
<?php get_footer(); ?>
