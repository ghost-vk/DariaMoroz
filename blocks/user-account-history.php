<div class="officeContent__historyShop tabs officeContent__noActive" id="history">
	<?php $customer_orders = get_posts( array(
		'numberposts' => -1,
		'meta_key' => '_customer_user',
		'meta_value' => get_current_user_id(),
		'post_type' => wc_get_order_types(),
		'post_status' => 'wc-completed',
	) );
	
	if ( $customer_orders ) : ?>
        <div class="DM-cart-item DM-cart-item-head">
            <p class="text text-gray-2">Мой выбор</p>
            <p class="text text-gray-2 DM-cart-item-head__second">Количество</p>
            <p class="text text-gray-2 DM-cart-item-head__third">Стоимость</p>
        </div>
		<?php foreach ( $customer_orders as $post_order ) : ?>
            <?php $order = wc_get_order($post_order->ID);
			$items = $order->get_items(); ?>
			<?php foreach ( $items as $item ) : ?>
				<?php $item_id = $item->get_product_id();
				$product = wc_get_product( $item_id ); ?>

                <div class="DM-cart-item cart_item">

                    <div class="DM-cart-item__image">
						<?php $image_id  = $product->get_image_id();
						$image_url = wp_get_attachment_image_url( $image_id, 'full' );
                        if ( !$image_url ) {
                            $image_placeholder = get_field('placeholder_image');
							echo "<img src='$image_placeholder'>";
						} else {
							echo "<img src='$image_url'>";
						} ?>
                    </div>

                    <div class="DM-cart-item__name text">
                        <p class="text-bold text-gray-6" ><?= $product->get_name(); ?></p>
                        <?php $description = get_field('cart_description', $item_id);
						if ( !empty($description) ) : // If product have short description
							$row_1 = $description['text_1'];
							if (!empty($row_1)) : ?>
                                <p class="text text-gray-4"><?= $row_1; ?></p>
							<?php endif;
							$row_2 = $description['text_2'];
							if (!empty($row_2)) : ?>
                                <p class="text text-gray-4"><?= $row_2; ?></p>
							<?php endif; ?>
						<?php endif; ?>
                    </div>

                    <div class="DM-cart-item__quantity">
                        <p class="DM-cart-item__mobile text text-gray-2">Количество</p>
                        <p class="cart-numbers-text text-gray-6"><?= $item->get_quantity(); ?></p>
                    </div>

                    <div class="DM-cart-item__price">
                        <p class="DM-cart-item__mobile text text-gray-2">Стоимость</p>
                        <p class="cart-numbers-text text-gray-6"><?= number_format($item->get_total(), 0, '.', ' ') . " " . get_woocommerce_currency_symbol(); ?></p>
                    </div>

                </div>
			<?php endforeach; ?>
		<?php endforeach; ?>
    <?php else : ?>
        <div class="office-item no-items">
            <h4>На данный момент нет выполненных заказов</h4>
        </div>
	<?php endif; ?>

</div>