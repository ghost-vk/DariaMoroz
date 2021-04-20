<?php 
//Functions file © ANDRV
add_theme_support( 'woocommerce' );
add_theme_support( 'title-tag' );

add_filter( 'registration_redirect', 'ckc_registration_redirect' );
function ckc_registration_redirect() {
    return home_url();
}

/**
 * Add utils for enqueue
 */
require_once __DIR__ . '/functions/enqueue-utils.php';

/**
 * Add styles and scripts
 */
require_once __DIR__ . '/functions/enqueue.php';

/**
 * Add menus
 */
require_once __DIR__ . '/functions/menus.php';

/**
 * Add utils function
 */
require_once __DIR__ . '/functions/utils.php';

/**
 * Add popup actions
 */
require_once __DIR__ . '/functions/popup.php';

/**
 * Add functions to work with events
 */
require_once __DIR__ . '/functions/events.php';

/**
 * Date functions
 */
require_once __DIR__ . '/functions/date.php';

/**
 * Add SMTP
 */
require_once __DIR__ . '/functions/smtp.php';

/**
 * Payment utils
 */
require_once __DIR__ . '/functions/payment.php';

/**
 * Third party authentication
 */
require_once __DIR__ . '/functions/auth.php';

/**
 * Add partial paid fee
 */
require_once __DIR__ . '/functions/fee.php';

/**
 * Add shop AJAX functions
 */
require_once __DIR__ . '/functions/shop.php';


