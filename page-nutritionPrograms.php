<?php
/*
Template Name: Программы питания
*/
?>

<?php get_header();?>
<main>
	<section id="page" class="nutritionPrograms">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/nutritionPrograms.css">
		<svg class="unionLong" viewBox="0 0 2047 12227">
			<path fill-rule="evenodd" clip-rule="evenodd"
				d="M212.384 1526.47L212 1526L212.384 1525.66V1525.59H212.459L466.004
				1300.64L160 1026.77V12227H0V824H158.172L158.884 823.363L159.588
				824H160V824.372L577.481 1201.73L1931.94 0L2046.84 102.842L697.657
				1310.36L935.321 1525.18L934.899 1525.59H936.153V1668.71H212.384V1526.47ZM457.166
				1525.59H717.354L587.26 1409.16L457.166 1525.59Z" fill="white"/>
		</svg>
		<div class="bg bg_dark bg_noRepeat bg_contain">
			<div class="container container_full">
				<div class="nutprogContent">
					<h3 class="H3 H3_top">Питаемся правильно</h3>
					<h1>Программы<br>питания</h1>
					<p class="text"><?php the_field('intro'); ?></p>
					<div class="nutprogContent__varLine">
                        
                        <?php $programs = get_field('programs'); ?>
                        
                        <?php if ( !empty($programs) ) : ?>
                            
                            <?php $_pf = new WC_Product_Factory();
							$currency_symbol = get_woocommerce_currency_symbol();
							
							for ($i = 1; $i < 4; $i += 1) : ?>
                                <?php $product_id = $programs["program_$i"][0];
								$_product = $_pf->get_product($product_id);
								$price = $_product->get_regular_price();
								$sale_price = $_product->get_sale_price();
								$active_class = ($sale_price) ? 'active' : 'inactive';
                                ?>
                            
                                <div class="nutprogContent__var">
                                    <h2><?php the_field('name', $product_id); ?></h2>
                                    <p class="text"><?php the_field('description', $product_id); ?></p>
                                    <div class="nutprogContent__price <?= $active_class; ?>">
                                        <h6><?= $price . $currency_symbol; ?></h6>
                                        <?php if ($sale_price) : ?>
                                            <h4><?= $sale_price . $currency_symbol; ?></h4>
                                        <?php endif; ?>
                                    </div>
                                    <a href="#" class="btnRed alert-btn" data-alert="addedToCart" data-product="<?= $product_id; ?>"
                                       data-action="add_to_cart">Купить</a>
                                </div>
                            <?php endfor; ?>
                        <?php else : ?>
                            <div class="nutprogContent__var">
                                <h2>Кажется нам нечего вам предложить</h2>
                            </div>
                        <?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer();?>