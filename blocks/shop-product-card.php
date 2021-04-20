<div class="<?= $card_class; ?> product-card" data-product="<?= $product_id; ?>">
	<div class="mpowerProducts__img">
		<img src="<?= $image_src; ?> <?= $loading ?>" />
	</div>
	<div class="mpowerProducts__info">
		<div class="mpowerProducts__name">
			<span class="text-bold-18"><?= $product_second_name; ?><br /><?= $product_name; ?></span>
		</div>
		<div class="mpowerProducts__price">
            <?php
            $price = ( $sale_price_min ) ? (int)$sale_price_min : (int)$regular_price_min;
			$price = number_format($price, 0, '', ' ');
			$price .= ' ' . $currency_symbol;
            ?>
			<span class="text-bold-18 price-main"><?= $price; ?></span>
		</div>
	</div>
</div>