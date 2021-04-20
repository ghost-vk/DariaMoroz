<?php
/**
* This hooks turn status complete for every order upon payment.
*/
add_filter( 'woocommerce_order_item_needs_processing', 'need_processing_false_filter' );
// See class-wc-order line 1368 to understand the return value
function need_processing_false_filter() {
	return false;
}

/**
 * Set fee status applied after complete order
 */
add_action( 'woocommerce_order_status_completed', 'set_after_fee_applied' );
function set_after_fee_applied( $order_id ) {
	$uncompleted_orders = get_uncompleted_products(true);
	if ( empty($uncompleted_orders) ) {
		return;
	}
	
	$current_order = wc_get_order( $order_id );
	$current_items = $current_order->get_items();
	
	$is_fee_status_updated = false;
	
	foreach ( $uncompleted_orders as $order_wrapper_id => $products ) { // Ордера, в которых есть товары - предоплаты
		foreach ( $products as $prepay_wrapper_product_id ) { // Товары - предоплаты
			
			$prepay_product_ids = get_field('course', $prepay_wrapper_product_id);
			
			foreach ( $prepay_product_ids as $product_id) { // Частично оплаченные товары в товарах - предоплатах
				foreach ($current_items as $item) { // Товары в оплачиваемом заказе
					$current_product_id = $item->get_product_id();
					
					if ( $current_product_id == $product_id ) { // If product in current order is from uncompleted order
						
						$is_updated = update_field( 'is_fee_applied', true, $order_wrapper_id );
						if ( !$is_updated ) {
							error_log('Not updated "is_fee_applied" field, order' . $order_id, 0);
						}
						$is_fee_status_updated = true;
						break;
					}
				}
				
				if ( $is_fee_status_updated == true ) { // If fee applied
					break;
				}
			}
			
			if ( $is_fee_status_updated == true ) {
				$is_fee_status_updated = false; // If fee applied
				continue;
			}
			
		}
	}
}