<div class="bg bg_dark bg_noRepeat bg__courseTwerk_cover">
	<div class="container container_center">
		<div class="courseTwerkoutPack">
			<h3 class="H3 H3_top"><?= the_field('package_subtitle'); ?></h3>
			<h1 id="packages-title"><?= the_field('package_title'); ?></h1>
			<div class="courseTwerkoutPack__line" id="packages">
				<?php if (have_rows('products')) : the_row();
					$_pf = new WC_Product_Factory();
					$currency_symbol = get_woocommerce_currency_symbol();
					$active_class = '';
					for ($i = 1; $i < 4; $i += 1) :
						$package_id = get_sub_field('package_' . $i)[0];
						if ($package_id) {
							$students_quantity = get_field('students_count');
							$desc = get_field('description');
							$_product = $_pf->get_product($package_id);
							$price = $_product->get_regular_price();
							$sale_price = $_product->get_sale_price();
							if ($sale_price) { // If activated sale
								$active_class = 'active';
							} else {
								$active_class = 'inactive';
							}
						} ?>
						
						<div class="courseTwerkoutPack__pos">
							<h2><?= $_product->get_title(); ?></h2>
							<p class="text"><?php the_field('students_count', $package_id); ?></p>
							<div class="courseTwerkoutPack__price <?= $active_class; ?>">
								<h6><?= $price . $currency_symbol; ?></h6>
								<?php if ($sale_price) : ?>
									<h4><?= $sale_price . $currency_symbol; ?></h4>
								<?php endif; ?>
							</div>
							
							<div class="courseTwerkoutPack__points">
								<?php if (have_rows('description', $package_id)) : ?>
									<ul>
									<?php while (have_rows('description', $package_id)) : the_row();
										$list_style = '';
										$is_highlight = get_sub_field('highlight');
										if ($is_highlight == true) {
											$list_style = 'courseTwerkoutPack__red';
										}
									?>
										<li class="text <?= $list_style ?>"><?= get_sub_field('text'); ?></li>
									<?php endwhile; ?>
									</ul>
								<?php endif; ?>
							</div>
							
							<a href="#" class="btnRed alert-btn" data-alert="addedToCart" data-product="<?= $package_id; ?>"
                               data-action="add_to_cart"><?php the_field('package_btn_text'); ?></a>
						</div>
				
					<?php endfor; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>