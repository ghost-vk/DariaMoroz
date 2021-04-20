<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

            <div class="thank-you">
                <h5>Платеж отклонен системой</h5>
                <div class="thank-you__again">
                    <a href="<?= esc_url( $order->get_checkout_payment_url() ); ?>" class="btnRed">Попробовать ещё раз</a>
                </div>
            </div>

		<?php else : ?>
            
            <div class="thank-you">
                <h5>Благодарим за заказ!</h5>
                
                <?php $thank_you_info = get_field('thank_you_info');
                if ( !empty($thank_you_info) ) : ?>
                    <h6 class="thank-you__info"><?= $thank_you_info; ?></h6>
                <?php endif; ?>
                
                <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                    <li class="woocommerce-order-overview__order order">
						<p class="text text-gray-2">Номер заказа</p>
                        <p class="text"><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    </li>

                    <li class="woocommerce-order-overview__date date">
                        <p class="text text-gray-2">Дата</p>
                        <p class="text"><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    </li>
		
					<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
                        <li class="woocommerce-order-overview__email email">
                            <p class="text text-gray-2">Email</p>
                            <p class="text"><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                        </li>
					<?php endif; ?>

                    <li class="woocommerce-order-overview__total total">
                        <p class="text text-gray-2">Всего</p>
                        <p class="text"><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    </li>
		
					<?php if ( $order->get_payment_method_title() ) : ?>
                        <li class="woocommerce-order-overview__payment-method method">
                            <p class="text text-gray-2">Метод оплаты</p>
                            <p class="text"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></p>
                        </li>
					<?php endif; ?>

                </ul>
            </div>
            

		<?php endif; ?>

		<?php // do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php // do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>
