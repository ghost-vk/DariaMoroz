<div class="tester" style="display: none">
    <p>Вывод полей товара</p>
    <p>
    <?php
    $product_id = 896;
    
    // Basic info
    $product_name = get_the_title($product_id);
    echo $product_name . '<br>';
    
    $product_type = get_field('type', $product_id);
	echo $product_type . '<br>';

	$short_description_name = get_field('short_description_name', $product_id);
	$short_description = get_field('short_description', $product_id);
	echo $short_description_name . ' ' . $short_description . '<br>';

	$composition_name = get_field('short_description_second_name', $product_id);
	$composition = get_field('short_description_second', $product_id);
	echo $composition_name . ' ' . $composition . '<br>';
	
	
	// Available sizes and prices
    $product = wc_get_product($product_id);
    $variations = $product->get_available_variations('objects');
    
    $currency_symbol = get_woocommerce_currency_symbol();
    
    foreach ( $variations as $variation ) {
        $variation_id = $variation->get_id();
        $variation_product = wc_get_product($variation_id);
        $stock_quantity = $variation->get_stock_quantity();
        $attribute = $variation->get_attribute('size');
        
        $sale_price = $variation_product->get_sale_price();
        $regular_price = $variation_product->get_regular_price();
        $price = ($sale_price) ? (int)$sale_price : (int)$regular_price;
        $price = number_format($price, 0, '', ' ') . ' ' . $currency_symbol;
        
        echo 'Variation ID: ' . $variation_id . '<br>';
        echo 'In stock: ' . $stock_quantity . '<br>'; // returns int
        echo 'Size: ' . $attribute . '<br>';
        echo 'Price: ' . $price . '<br>';
        
        
        
        echo '<br>';
    }
    
    // Gallery
    $images = get_field( 'images_modal', $product_id );
    if ( !empty($images) ) {
		for ( $i = 1; $i < 4; $i += 1 ) {
			$preview = $images['preview_' . $i];
			$image = $images['image_' . $i];
			if ( isset($preview) && isset($image) ) {
			    echo 'Preview: ' . $preview . '<br>';
			    echo 'Image: ' . $image . '<br>';
			    echo '<br>';
            }
        }
    }
    ?>
    </p>
</div>

<div class="productModal" id="productModal">
    <div class="productModal__window">
        <div class="productModal__loader">
            <div class="lds-dual-ring"></div>
        </div>
        <div class="productModal__close" id="modalCloseBtn">
            <div class="productModal__x"></div>
        </div>
        <div class="productModal__track" id="previewBox">
            <div class="productModal__square">
                <img src="<?= get_stylesheet_directory_uri(); ?>/img/shop/square_view.png" />
            </div>
            <div class="productModal__square">
                <img src="<?= get_stylesheet_directory_uri(); ?>/img/shop/square_view.png" />
            </div>
            <div class="productModal__square">
                <img src="<?= get_stylesheet_directory_uri(); ?>/img/shop/square_view.png" />
            </div>
        </div>
        <div class="productModal__view">
            <img id="currentImageTag" src />
            <span class="productModal__water">mpower<br />wear</span>
        </div>
        <div class="productModal__body">
            

            <div class="productModal__info">
                <div class="productModal__main">
                    <p class="productModal__name" id="productName"></p>
                    <p class="productModal__label product-label" id="descriptionLabel"></p>
                    <p class="productModal__description product-text" id="productDescription"></p>
                    <p class="productModal__label product-label" id="compositionLabel">Состав:</p>
                    <p class="productModal__description product-text" id="compositionHolder"></p>
                </div>
                <div class="productModal__sizebox">
                    <p class="productModal__label product-label">Размеры:</p>
                    <ul class="sizes" id="productSizes"></ul>
                </div>
                <div class="productModal__price">
                    <span id="productPrice"></span>
                </div>
            </div>
            
            <div class="productModal__button alert-btn" id="productAddBtn"
                 data-alert="mpowerCartNotification" data-action="add_to_cart" data-product>
                <span>В корзину</span>
            </div>
        </div>
    </div>
</div>