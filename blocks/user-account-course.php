<?php $product_ids = get_user_paid_orders(); // Full paid products ?>
<?php $uncompleted_products = get_uncompleted_products(); // Partial paid products ?>


<!--<div class="tester">-->
<!--	--><?php
//    $test = get_uncompleted_products(true);
//    var_dump($test); ?>
<!--</div>-->

<div class="officeContent__course tabs officeContent__noActive" id="courses">
    
    <!--  PURCHASES  -->
    <?php if ( !empty($product_ids) || !empty($uncompleted_products) ) : // If user have paid courses ?>
	
		<?php foreach ( $uncompleted_products as $uncompleted_product_id ) : // Prepay products (Holds product with sale) ?>
            <?php $prepay_product_ids = get_field('course', $uncompleted_product_id); ?>
            <?php foreach ($prepay_product_ids as $product_id) : // Products with sale?>
            
                <div class="office-item mb--10 active">
                    <div class="office-item__title">
                        <h4><?php the_field('user_account_title', $product_id); ?></h4>
                        <span class="triang"></span>
                    </div>
                    <div class="office-item__body-wrapper" style="display: block;">
                        <div class="office-item__body">
                            <div class="office-item__row">
                                <div class="office-item__image">
                                    <img src="<?= get_stylesheet_directory_uri(); ?>/img/kiss.png" />
                                </div>
                                <div class="office-item__info prepay">
                                    <div class="prepay__title">
                                        <p class="text-bold"><?= get_the_title($product_id); ?></p>
                                    </div>
                                    <div class="prepay__short">
                                        <?php $cart_description = get_field('cart_description', $product_id); ?>
                                        <?php if ( !empty($cart_description) ) : // Description from cart ?>
                                            <?php if ( $first_cart_row = $cart_description['text_1'] ) : ?>
                                                <p class="text-gray-4"><?= $first_cart_row; ?></p>
                                            <?php endif; ?>
                                            <?php if ( $second_cart_row = $cart_description['text_2'] ) : ?>
                                                <p class="text-gray-4"><?= $second_cart_row; ?></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="prepay__description">
                                        <p><?php the_field('user_account_description', $product_id); ?></p>
                                    </div>
                                </div>
    
                                <?php
								$_pf = new WC_Product_Factory();
								$currency_symbol = get_woocommerce_currency_symbol();
								$_product = $_pf->get_product($uncompleted_product_id);
								
								$paid_part = $_product->get_regular_price(); // Paid part
                                $paid_part_num = (int)$paid_part;
                                $paid_part = number_format($paid_part, 0, '', ' ');
                                
                                $saved_price = (int)get_field('saved_price', $product_id);
                                
                                $rest = $saved_price - $paid_part_num;
                                $rest = number_format($rest, 0, '', ' ');
                                
                                ?>
                                
                                <div class="office-item__buttons prepay">
                                    <div class="prepay__current">
                                        <p class="text-gray-2">Внесена предоплата</p>
                                        <p><?= $paid_part . ' ' . $currency_symbol; ?></p>
                                    </div>
                                    <div class="prepay__rest">
                                        <p class="text-gray-2">Осталось доплатить</p>
                                        <p><?= $rest . ' ' . $currency_symbol; ?></p>
                                    </div>
                                    <div class="prepay__button">
                                        <a href="#" class="btnRed alert-btn" data-alert="addedLastPart" data-product="<?= $product_id; ?>"
                                           data-action="add_to_cart">Оплатить остаток</a>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php endforeach; ?>
		<?php endforeach; ?>
    
        <?php foreach( $product_ids as $j => $product_id ) : ?>
        
            <div class="office-item mb--10">
                <div class="office-item__title">
                    <h4><?php the_field('user_account_title', $product_id); ?></h4>
                    <span class="triang"></span>
                </div>
                
				<?php if ( have_rows('lesson', $product_id) ) : $i = 1; // If course have lesson ?>
					<?php while ( have_rows('lesson', $product_id) ) : the_row(); ?>
			
						<?php $video_id = get_sub_field('video_id');
						$image = get_sub_field('image'); ?>

                        <!--   COURSE BODY   -->
                        <div class="office-item__body-wrapper">
                            <div class="office-item__body">
                                <div class="office-item__name">
                                    <h4 class="small-red-underline small-transparent-underline text-no-wrap">Урок №<?= $i; ?></h4>
                                    <span class="triang"></span>
                                </div>
					
								<?php if (empty($video_id)) : // If event not started ?>
									<?php $lesson_date = get_sub_field('date');
									$lesson_time = get_sub_field('time'); ?>
                                    <div class="office-item__preview office-item__preview-unload">
                                        <img src="<?= $image; ?>">
                                        <h5><?= "Начало $lesson_date в $lesson_time"; ?></h5>
                                    </div>
								<?php else : // Video uploaded ?>
                                    <div class="office-item__preview">
                                        <img src="<?= $image; ?>">
                                        <picture class="play-btn">
                                            <source type="image/svg+xml" srcset="<?= get_template_directory_uri(); ?>/img/icons/play.svg" />
                                            <img class="play-video-btn"
                                                 src="<?= get_template_directory_uri(); ?>/img/icons/play.png"
                                                 data-modal="popup-courseVideo_<?= $j; ?>_<?= $i; ?>"
                                                 data-player="courseVideo_<?= $j; ?>_<?= $i; ?>"
                                            />
                                        </picture>
                                    </div>
								<?php endif; ?>
                            </div>
                        </div>
                        <!--   MODAL   -->
                        <div class="popup-window" id="popup-courseVideo_<?= $j; ?>_<?= $i; ?>">
                            <i class="fas fa-times popup-close"></i>
                            <div id="player-courseVideo_<?= $j; ?>_<?= $i; ?>"></div>
                        </div>
                        <?php $i += 1; ?>
					<?php endwhile; ?>
				<?php endif; ?>
            
            </div>
            
        
        <?php endforeach; ?>
    <?php else : ?>
        <div class="office-item no-items">
            <h4><?php the_field('alert_not_courses'); ?></h4>
        </div>
    <?php endif; ?>
</div>