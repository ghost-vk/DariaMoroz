<?php
$prepay_status = get_field('prepay_status');
?>


<div class="container container_bot">
	<div class="<?= $wrapper_class; ?>">
		<?php if ( $prepay_status == true ) : // If prepay ON ?>
			<?php $prepay_product_id = get_field('prepay')[0]; ?>
			<h3 class="H3 H3_top">Твоя выгода</h3>
			<h1>не упусти</h1>
			<h6>ВНЕСИТЕ ПРЕДОПЛАТУ - ЗАФИКСИРУЙТЕ МИНИМАЛЬНУЮ ЦЕНУ</h6>
			<a href="#" class="btnRed alert-btn" data-alert="addedPrepay" data-product="<?= $prepay_product_id; ?>"
			   data-action="add_to_cart">Внесите предоплату</a>
		<?php endif; ?>
	</div>
</div>

