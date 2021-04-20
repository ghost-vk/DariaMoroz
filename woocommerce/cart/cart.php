<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="DM-wrapper">
    <div class="DM-col">
        <form class="DM-cart" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php do_action( 'woocommerce_before_cart_table' ); ?>
            
            <div class="DM-cart-item DM-cart-item-head">
                <p class="text text-gray-2">Мой выбор</p>
                <p class="text text-gray-2 DM-cart-item-head__second">Количество</p>
                <p class="text text-gray-2 DM-cart-item-head__third">Стоимость</p>
            </div>
            
        <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            
            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_permalink = '';
            } ?>
            
                <div class="DM-cart-item  <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                    
                    <div class="DM-cart-item__image">
                        <?php
                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    
                            if ( ! $product_permalink ) {
                                echo $thumbnail; // PHPCS: XSS ok.
                            } else {
                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                            }
                        ?>
                    </div>
                    
                    <div class="DM-cart-item__name text" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                        <?php if ( ! $product_permalink ) {
                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<p class="text-bold text-gray-6" >%s</p>', $_product->get_name() ) , $cart_item, $cart_item_key ) );
                        } else {
                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                        }
                        
                        $description = get_field('cart_description', $product_id);
                        if ( !empty($description) ) { // If product have short description
                            $row_1 = $description['text_1'];
                            if (!empty($row_1)) : ?>
                                <p class="text text-gray-4"><?= $row_1; ?></p>
                            <?php endif;
                            $row_2 = $description['text_2'];
                            if (!empty($row_2)) : ?>
                                <p class="text text-gray-4"><?= $row_2; ?></p>
                            <?php endif;
                        }
                        
                        do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                    
                        // Meta data.
                        echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
                    
                        // Backorder notification.
                        if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                        } ?>
                    </div>
    
                    <div class="DM-cart-item__quantity">
                        <p class="DM-cart-item__mobile text text-gray-2">Количество</p>
                        <p class="cart-numbers-text text-gray-6"><?= $cart_item['quantity']; ?></p>
                    </div>
                    
                    <div class="DM-cart-item__price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                        <p class="DM-cart-item__mobile text text-gray-2">Стоимость</p>
                        <p class="cart-numbers-text text-gray-6"><?= WC()->cart->get_product_price( $_product ); ?></p>
                    </div>
                    
                    <div class="DM-cart-remove">
                <?php
                                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            'woocommerce_cart_item_remove_link',
                                            sprintf(
                                                '<a href="%s" class="DM-cart-remove__link" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fas fa-trash-alt text-gray-2"></i></a>',
                                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                esc_html__( 'Remove this item', 'woocommerce' ),
                                                esc_attr( $product_id ),
                                                esc_attr( $_product->get_sku() )
                                            ),
                                            $cart_item_key
                                        );
                                    ?>
                </div>
                
                </div>
            
        <?php endforeach; ?>
            
            <div class="DM-cart-actions">
                <?php do_action( 'woocommerce_cart_actions' ); ?>
                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
            </div>
            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
            <?php do_action( 'woocommerce_after_cart_table' ); ?>
        </form>
    </div>

    <div class="cart-total">
        <div class="cart-total__row">
    		<h2 class="DM-total mobile-block">Итого</h2>
            <div class="cart-total__spacer"></div>
            <div class="cart-total__price">
                <h3 class="cart-big-numbers text-gray-6"><?= number_format(WC()->cart->total, 0, '.', ' ') . " " . get_woocommerce_currency_symbol(); ?></h3>
            </div>
            <div class="cart-total__button">
                <a href="<?= wc_get_checkout_url() ?>"  class="btnRed">Оплатить</a>
            </div>
        </div>
    </div>

    <!-- <div class="DM-col">
    <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
    
    <div class="DM-cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
    </div> -->

<?php do_action( 'woocommerce_after_cart' ); ?>
</div>

</div>

