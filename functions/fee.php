<?php
/**
 * Add fee to cart if user have partial paid products
 */
add_action( 'woocommerce_cart_calculate_fees', 'woo_add_cart_fee' );
function woo_add_cart_fee( ) {
	$uncompleted_products = get_uncompleted_products();
	if ( empty($uncompleted_products) ) {
		return;
	} else {
		
		foreach ( $uncompleted_products as $uncompleted_product_id ) { // Partial part products
			$prepay_product_ids = get_field('course', $uncompleted_product_id);
			$is_fee_add = false;
			
			foreach ($prepay_product_ids as $prepay_id) {
				
				foreach ( WC()->cart->get_cart() as $cart_item ) {
					$product_id = $cart_item['product_id'];
					
					if ( $prepay_id == $product_id ) {
						$_pf = new WC_Product_Factory();
						$_product = $_pf->get_product($uncompleted_product_id);
						$paid_part = (int)$_product->get_regular_price(); // Paid part
						
						$saved_price = (int)get_field('saved_price', $prepay_id); // Saved price after prepay
						
						$_product = $_pf->get_product($prepay_id);
						$full_price = (int)$_product->get_regular_price(); // Full price
						
						$sale_price = (int)$_product->get_sale_price(); // Sale price
						
						if ( !$sale_price ) { // If sale expired
							$fee = - ($full_price - $saved_price + $paid_part);
							
							WC()->cart->add_fee("fee$product_id", $fee, false);
							$is_fee_add = true;
							break;
						}
					}
				}
				
				if ( $is_fee_add == true ) { // Only once
					break;
				}
				
			}
			
			if ( $is_fee_add == true ) { // Only once
				break;
			}
			
		}
	}
}
