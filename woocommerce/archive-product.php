<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

global $page_id;
$page_id = get_option( 'woocommerce_shop_page_id' );
?>

	<main>
		<section id="page" class="mer">
			<svg class="unionLong" viewBox="0 0 2047 12227">
				<path fill-rule="evenodd" clip-rule="evenodd"
					  d="M212.384 1526.47L212 1526L212.384 1525.66V1525.59H212.459L466.004
				1300.64L160 1026.77V12227H0V824H158.172L158.884 823.363L159.588
				824H160V824.372L577.481 1201.73L1931.94 0L2046.84 102.842L697.657
				1310.36L935.321 1525.18L934.899 1525.59H936.153V1668.71H212.384V1526.47ZM457.166
				1525.59H717.354L587.26 1409.16L457.166 1525.59Z" fill="white"/>
			</svg>
			<div class="bg bg_dark bg_contain bg_custom">
				<div class="container container_full">
					<div class="title shop-title">
						<h1>Каталог<br />Mpower_wear</h1>
                        
                        <?php if ( !get_field('is_not_ready', $page_id) == true ) : ?>
						    <h3 class="H3 H3_bot">Выбери то что нужно</h3>
                        <?php endif; ?>
                        
					</div>
					
                    <?php if ( !get_field('is_not_ready', $page_id) == true ) : ?>
                    
                        <div class="archiveWrapper">
          
                            <?php require_once __DIR__ . '/../blocks/shop-sidebar.php'; // Sidebar with categories ?>
                            
                            <?php require_once __DIR__ . '/../blocks/shop-products.php'; // Products in Mpower_wear eShop ?>
                            
                        </div>
                        
                        <?php require_once __DIR__ . '/../blocks/shop-modal.php'; // Modal window to view product ?>
                    
                    <?php else : ?>

                        <div class="coming-soon">
                            <h5><?php the_field('not_ready_text', $page_id); ?></h5>
                            <img src="<?php the_field('not_ready_image', $page_id); ?>" />
                        </div>
                    
                    <?php endif; ?>
     
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>