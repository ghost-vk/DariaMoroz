<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="woocommerce-order-downloads">
	<?php if ( isset( $show_title ) ) : ?>
		<h2 class="woocommerce-order-downloads__title"><?php esc_html_e( 'Downloads', 'woocommerce' ); ?></h2>
	<?php endif; ?>

	<div class="woocommerce-table woocommerce-table--order-downloads shop_table shop_table_responsive order_details">


		<?php foreach ( $downloads as $download ) : ?>
			<div>
				<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
					<div class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
						<?php
						if ( has_action( 'woocommerce_account_downloads_column_' . $column_id ) ) {
							do_action( 'woocommerce_account_downloads_column_' . $column_id, $download );
						} else {
							switch ( $column_id ) {
								case 'download-product':
									if ( $download['product_url'] ) {
										// echo '<a href="' . esc_url( $download['product_url'] ) . '">' . esc_html( $download['product_name'] ) . '</a>';
                                        
                                            ?> 
<div class="oc">
								<div class="tab">
									<div class="oc__subtitle">
                                    <?php 
                                                    $productId = $download['product_id'];
                                                    
                                                   $product = wc_get_product($productId);

                                                ?>
										<h3 class="subtitleH3 tabControl"><?php echo $product->get_attribute('productTitle'); ?></h3>
										<span class="triang"></span>
									</div>
									<div class="oc__content tabContent">
										<div class="oc__stick">
											<div class="oc__stickTitle">
                                                
                                                <h2><?php 
                                                   echo $product->get_attribute('startDate');

                                                ?></h2>
												<span></span>
												<h2>
                                                <?php echo $product->get_attribute('expireDate'); ?>
                                                </h2>
											</div>
                                            
											<h6 class="oc__stickTime">В <?php echo $product->get_attribute('timeStart'); ?></h6>
											<h6 class="oc__stickDesc"><?php echo $product->get_attribute('productText'); ?></h6>
											<span id="stickOpenPopup" class="btnRed">Напомнить перед началом</span>
                                        </div>
                                        <?php  echo do_action('prefix_group_downloadable_products'); ?>

										
									</div>
								</div>
							</div>
						</div>
                                            <?php
                                    } else {
										echo esc_html( $download['product_name'] );
									}
									break;
								
							}
						}
						?>
					</div>
				<?php endforeach; ?>
                    </div>
		<?php endforeach; ?>
                    </div>
                    </div>
