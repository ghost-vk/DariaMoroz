<?php
/**
 * Custom initialize of SMTP in PHP Mailer
 */
add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email( $phpmailer ) {
if ( ! is_object( $phpmailer ) ) {
	$phpmailer = (object) $phpmailer;
}
	$phpmailer->Mailer     = 'smtp';
	$phpmailer->Host       = SMTP_HOST;
	$phpmailer->SMTPAuth   = SMTP_AUTH;
	$phpmailer->Port       = SMTP_PORT;
	$phpmailer->Username   = SMTP_USER;
	$phpmailer->Password   = SMTP_PASS;
	$phpmailer->SMTPSecure = SMTP_SECURE;
	$phpmailer->From       = SMTP_FROM;
	$phpmailer->FromName   = SMTP_NAME;
}

/**
 * Logs error PHP Mailer
 */
add_action('wp_mail_failed', 'log_mailer_errors', 10, 1);
function log_mailer_errors( $wp_error ){
	
	// add error to .log file
	error_log( $wp_error->get_error_message() );
}