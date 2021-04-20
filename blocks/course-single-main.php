<?php
$currency_symbol = get_woocommerce_currency_symbol();
$months = array( 'Января' , 'Февраля' , 'Марта' , 'Апреля' , 'Мая' , 'Июня' , 'Июля' , 'Августа' , 'Сентября' , 'Октября' , 'Ноября' , 'Декабря' );

$course_id = get_field('course_product')[0];
$_pf = new WC_Product_Factory();
$_product = $_pf->get_product($course_id);

$price = $_product->get_regular_price();
$price = intval($price);
$price = number_format($price, 0, '', ' ');
$sale_price = $_product->get_sale_price();
$sale_price = intval($sale_price);
$sale_price = number_format($sale_price, 0, '', ' ');

$active_class = '';
if ($sale_price) { // If activated sale
	$active_class = 'active';
} else {
	$active_class = 'inactive';
}

?>

<div class="courseBg">
	<div class="container container_top">
		<div class="courseTop">
			<span class="courseTop__DM courseTop__DM_desktop">Daria<br>Moroz</span>
			<div class="courseTop__content">
				<div class="courseTop__right">
					<h2><?php the_field('main_title'); ?></h2>
					<div class="courseTop__subTitle">
						<?php $date = get_field('start_date');
						$date_timestamp = strtotime($date);
						$new_date_format = date('d ' . $months[date( 'n' )] . ' Y', $date_timestamp);
						if ($new_date_format[0] == '0') { // If first number of month day is 0
						    $new_date_format = preg_replace('/^0/', '', $new_date_format);
                        }
						?>
						<h6>Старт курса: <?= $new_date_format; ?></h6>
						<h6>Длительность: <?php the_field('course_duration'); ?></h6>
					</div>
					<div class="courseTop__price <?= $active_class; ?>">
						<h6><?= $price . $currency_symbol; ?></h6>
						<?php if ( $sale_price ) : // If activated sale ?>
							<div class="courseTop__descount">
								<p class="text">* <?php the_field('sale_condition_text', $course_id); ?></p>
								<h4><?= $sale_price . $currency_symbol; ?></h4>
							</div>
						<?php endif; ?>
					</div>
					<a href="#" class="btnRed alert-btn" data-alert="addedToCart" data-product="<?= $course_id; ?>"
                    data-action="add_to_cart"><?php the_field('first_button_text'); ?></a>
					<span class="courseTop__DM courseTop__DM_mobile">Daria<br>Moroz</span>
				</div>
			</div>
			<div class="skill skill_course">
				<?php require_once __DIR__ . "/about-me-links.php"; // Five links "About me" ?>
			</div>
		</div>
	</div>
</div>
