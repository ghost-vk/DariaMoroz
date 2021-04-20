<?php
if ( wp_doing_ajax() ) { // Add ajax actions only when it necessary
// Modal data
add_action( 'wp_ajax_get_product_data_modal', 'get_product_data_modal' );
add_action( 'wp_ajax_nopriv_get_product_data_modal', 'get_product_data_modal' );
}

/**
 * Get data for display in modal window archive page
 */
function get_product_data_modal() {
	check_ajax_referer( 'moroz-nonce', 'nonce' ); // Check nonce code
	
	$product_id = $_POST['product_id'];
	
	if ( empty($product_id) ) {
		wp_die();
	}
	
	// Basic info
	$product_data['name'] = get_the_title($product_id);
	$product_data['type'] = get_field('type', $product_id);
	
	$product_data['short_description_name'] = get_field('short_description_name', $product_id);
	$product_data['short_description'] = get_field('short_description', $product_id);

	$product_data['composition_name'] = get_field('short_description_second_name', $product_id);
	$product_data['composition'] = get_field('short_description_second', $product_id);
	
	
	// Available sizes and prices
	$product = wc_get_product($product_id);
	$variations = $product->get_available_variations('objects');
	
	$currency_symbol = get_woocommerce_currency_symbol();
	
	foreach ($variations as $variation) {
		$stock_quantity = $variation->get_stock_quantity();
		if ( $stock_quantity < 1 ) {
			continue;
		}
		$variation_id = $variation->get_id();
		$variation_product = wc_get_product($variation_id);
		$attribute = $variation->get_attribute('size');
		
		$sale_price = $variation_product->get_sale_price();
		$regular_price = $variation_product->get_regular_price();
		$price = ($sale_price) ? (int)$sale_price : (int)$regular_price;
		$price = number_format($price, 0, '', ' ') . ' ' . $currency_symbol;
		
		$product_data['variations'][] = array(
			'id' => $variation_id,
			'size' => $attribute,
			'price' => $price,
		);
	}
	
	// Gallery
	$images = get_field('images_modal', $product_id);
	if ( !empty($images) ) {
		for ( $i = 1; $i < 4; $i += 1 ) {
			$preview = $images['preview_' . $i];
			$image = $images['image_' . $i];
			if (isset($preview) && isset($image)) {
				$product_data['images'][] = array(
					'preview' => $preview,
					'image' => $image,
				);
			}
		}
	}
	
	
	wp_send_json($product_data);
	wp_die();
}