<?php
//require_once __DIR__ . '/../models/variableProduct.class.php';

$slug_current_category = ( isset($_GET['category']) ) ? $_GET['category'] : 'wear';
$offset = 0;

$currency_symbol = get_woocommerce_currency_symbol();

/**
 * Returns args for query
 * @param $offset {Integer}
 * @param $slug {String}
 * @returns $args {Array}
 */
function get_current_args($slug, $offset) {
    return array(
		'posts_per_page' => 4,
		'product_cat' => $slug,
		'post_type' => 'product',
		'orderby' => 'date',
		'order' => 'desc',
		'offset' => $offset,
	);
}

$args = get_current_args($slug_current_category, $offset);
$the_query = new WP_Query( $args );
$loading = '';

if ( !$the_query->have_posts() ) { // If set unresolved category GET param
	$slug_current_category = 'wear';
	$args = get_current_args($slug_current_category, $offset);
	$the_query = new WP_Query( $args );
}
?>

<div class="mpowerProducts">
	<?php if ( $the_query->have_posts() ) : ?>
		<?php $posts_count = $the_query->post_count; ?>
		<?php while ( $posts_count > 0 ) : ?>
    
            <div class="mpowerProducts__group">
            
            <?php $i = 0; ?>
			<?php while ( $the_query->have_posts() ) : ?>
				<?php
				$the_query->the_post();
				
				// Product data
				$product_name = get_the_title();
				$product_second_name = get_field('type');
				$gallery = get_field('images_archive');
				$product_id = get_the_ID();
				$product = wc_get_product( $product_id );
				$regular_price_min = $product->get_variation_regular_price(); // Min regular price
				$sale_price_min    = $product->get_variation_sale_price(); // Min sale price
				
				?>
                
                <?php if ( $i == 0 ) : // First (tall) product ?>
                
                    <?php
                    $card_class = 'mpowerProducts__tall';
                    $image_src = $gallery['image_1'];
                    ?>
                    <?php require __DIR__ . '/shop-product-card.php'; // Archive product card template ?>
                
                <?php elseif ( $i > 0 && $i < 3 ) : // Second and third (square) product ?>
                
				    <?php
                    $card_class = 'mpowerProducts__small';
					$image_src = $gallery['image_2'];
                    ?>
                
                    <?php if ( $i == 1 ) : // Current post is second in group ?>
                        <div class="mpowerProducts__sub">
                    <?php endif; ?>
                    
                            <?php require __DIR__ . '/shop-product-card.php'; // Archive product card template ?>
                    
                    <?php if ( $posts_count == 2 ) : // Total posts in group 2 ?>
                        </div>
                    <?php elseif ( $posts_count > 2 && $i == 2 ) : // Total posts more 2 and current post is third ?>
                        </div>
                    <?php endif; ?>
    
                <?php else : // Fourth (long) product ?>
	
					<?php
                    $card_class = 'mpowerProducts__long';
					$image_src = $gallery['image_3'];
                    ?>
					<?php require __DIR__ . '/shop-product-card.php'; // Archive product card template ?>
                
                <?php endif; ?>
    
                <?php $i += 1; ?>
    
			<?php endwhile; ?>
            
            </div>
        
			<?php
			$offset += 4;
			$args = get_current_args($slug_current_category, $offset);
			$the_query = new WP_Query( $args );
			$posts_count = $the_query->post_count;
			$loading = ( $offset > 7 ) ? 'loading="lazy"' : '';
			?>
		
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>
</div>