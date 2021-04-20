<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) : ?>
        <div class="checkout-login-required">
            <h5><?php the_field('need_to_authorized'); ?></h5>
            <a class="btnRed popup-opener" href="#" data-popup="popup-login">Войти / Зарегистрироваться</a>
        </div>
	<?php return; ?>
<?php endif; ?>

<?php $customer_info = get_field('customer_info');
if ( !empty($customer_info) ) : ?>
    <div class="customer-info">
        <p class="text"><?= $customer_info; ?></p>
    </div>
<?php endif; ?>

<form name="checkout" method="post" class="DM-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="DM-row" id="customer_details">
			<div class="DM-col">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="DM-col col-200">
                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
 
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
