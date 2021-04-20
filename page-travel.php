<?php
/*
Template Name: Путешествие
Template Post Type: page
*/
?>

<?php get_header();?>
<main>
	<section id="page" class="travel">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/travel.css">
		<svg class="unionLong unionLong_hide" viewBox="0 0 2047 12227">
			<path fill-rule="evenodd" clip-rule="evenodd"
				d="M212.384 1526.47L212 1526L212.384 1525.66V1525.59H212.459L466.004
				1300.64L160 1026.77V12227H0V824H158.172L158.884 823.363L159.588
				824H160V824.372L577.481 1201.73L1931.94 0L2046.84 102.842L697.657
				1310.36L935.321 1525.18L934.899 1525.59H936.153V1668.71H212.384V1526.47ZM457.166
				1525.59H717.354L587.26 1409.16L457.166 1525.59Z" fill="white"/>
		</svg>
		<div style="background-image: url(<?php the_field('main_bg'); ?>);" class="bgTravel">
			<div class="container container_top container_center">
				<div class="topTravel">
					<img src="<?php echo get_template_directory_uri(); ?>/img/dShadow.png" alt="travelDasha">
					<div class="topTravel__content">
						<h3 class="H3 H3_top"><?php the_field('main_subtitle'); ?></h3>
						<h1><?php the_field('main_title'); ?></h1>
						<div class="topTravel__date">
							<div class="topTravel__dateTop">
								<h4><?php the_field('date_start'); ?></h4>
								<h4>&nbsp;-&nbsp;</h4>
							</div>
							<h4><?php the_field('date_end'); ?></h4>
						</div>
						<h5><?php the_field('main_promo'); ?></h5>
						<p class="text"><?php the_field('main_short'); ?></p>
					</div>
					<h1 class="topTravel__titleBot"><?php the_field('program_title'); ?></h1>
				</div>
			</div>
		</div>
		<div class="bg bg_dark bg_contain bg_custom">
			<div class="gradient gradient_topBot">
				<div class="container container_center">
					<div class="scheduleTravel">
						<h3 class="H3 H3_bot"><?php the_field('program_label_1'); ?></h3>
						<div class="travelTextImg">
							<div class="travelTextImg__img travelTextImg__img_land">
								<img src="<?php the_field('program_img_1'); ?>" alt="travelBlock1">
							</div>
							<p class="text"><?php the_field('program_desc_1'); ?></p>
						</div>
						<div class="scheduleTravel__bot">
							<div class="scheduleTravel__timeLine">
                                <!--  SHEDULE BLOCKS  -->
								<div class="scheduleTravel__timePoint">
                                    <?php if (have_rows('program_block_1')) : the_row(); ?>
									<div class="scheduleTravel__time">
										<img src="<?= get_template_directory_uri(); ?>/img/clock.svg" alt="scheduleTravelClock">
										<span><?= get_sub_field('start'); ?>-<?= get_sub_field('finish'); ?></span>
									</div>
									<h6><?= get_sub_field('title'); ?></h6>
									<h6><?= get_sub_field('subtitle'); ?></h6>
                                    <?php endif; ?>
								</div>
        
								<div class="scheduleTravel__timePoint">
									<?php if (have_rows('program_block_2')) : the_row(); ?>
                                        <div class="scheduleTravel__time">
                                            <img src="<?= get_template_directory_uri(); ?>/img/clock.svg" alt="scheduleTravelClock">
                                            <span><?= get_sub_field('start'); ?>-<?= get_sub_field('finish'); ?></span>
                                        </div>
                                        <h6><?= get_sub_field('title'); ?></h6>
                                        <h6><?= get_sub_field('subtitle'); ?></h6>
									<?php endif; ?>
								</div>
        
								<div class="scheduleTravel__timePoint">
									<?php if (have_rows('program_block_3')) : the_row(); ?>
                                        <div class="scheduleTravel__time">
                                            <img src="<?= get_template_directory_uri(); ?>/img/clock.svg" alt="scheduleTravelClock">
                                            <span><?= get_sub_field('start'); ?>-<?= get_sub_field('finish'); ?></span>
                                        </div>
                                        <h6><?= get_sub_field('title'); ?></h6>
                                        <h6><?= get_sub_field('subtitle'); ?></h6>
									<?php endif; ?>
								</div>
							</div>
							<div class="scheduleTravel__ps">
								<p class="text"><?php the_field('program_comment_1'); ?></p>
								<p class="text"><?php the_field('program_comment_2'); ?></p>
							</div>
						</div>
					</div>
					<div class="lcturesTravel">
						<h3 class="H3 H3_bot"><?php the_field('program_label_2'); ?></h3>
						<div class="travelTextImg">
							<div class="travelTextImg__img travelTextImg__img_cube">
								<img src="<?php the_field('program_img_2'); ?>" alt="travelBlock2">
							</div>
							<p class="text"><?php the_field('program_desc_2'); ?></p>
						</div>
					</div>
					<div class="communityTravel">
						<h3 class="H3 H3_bot"><?php the_field('program_label_3'); ?></h3>
						<div class="travelTextImg">
							<p class="text"><?php the_field('program_desc_3'); ?></p>
							<div class="travelTextImg__img travelTextImg__img_cube travelTextImg__order">
								<img src="<?php the_field('program_img_3'); ?>" alt="travelBlock3">
							</div>
						</div>
					</div>
					<div class="homeTravel">
						<h1><?php the_field('placing_title'); ?></h1>
						<h3 class="H3 H3_top"><?php the_field('placing_subtitle'); ?></h3>
						<div class="travelTextImg">
							<div class="travelTextImg__h4">
								<div class="travelTextImg__img travelTextImg__img_land">
								<img src="<?php the_field('placing_img'); ?>" alt="travelHome">
							</div>
							<h4><?php the_field('placing_name'); ?></h4>
							</div>
							<p class="text">
								<?php the_field('placing_desc'); ?>
                                <br><br>
                                <?php $link = get_field('placing_link'); ?>
                                <?php if ( $link ) : ?>
                                    <?php $link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self'; ?>
            
								    <a href="<?= $link_url; ?>" target="<?= $link_target; ?>"><?= $link_title; ?></a>
                                
                                <?php endif; ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bg bg_light bg_noRepeat bg_cover">
			<div class="container container_center">
				<div class="priceTravel">
					<h3 class="H3 H3_top"><?php the_field('price_subtitle'); ?></h3>
					<h1><?php the_field('price_title'); ?></h1>
					<div class="priceTravel__line">
                        <!--  TRAVEL VARIANTS  -->
                        <?php for ($i = 1; $i < 4; $i += 1) : ?>
                            <?php if (have_rows('price_item_' . $i)) : the_row(); ?>
                                <div class="priceTravel__var">
                                    <h4><?= get_sub_field('title'); ?></h4>
                                    <p class="text"><?= get_sub_field('condition'); ?></p>
                                    <h4><?= get_sub_field('price'); ?></h4>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
					</div>
				</div>
    
				<div class="requestTravel">
					<h3 class="H3 H3_bot">Ты не пожалеешь</h3>
					<h1>Оставить<br>заявку</h1>
     
					<?php global $current_user;
					$user_name = "";
					if ( is_user_logged_in() ) {
						$user_name = $current_user->user_firstname;
					} ?>
     
					<form action="" method="POST">
						<input class="text" placeholder="Твое имя красотка" name="user_name" type="text" maxlength="30" value="<?= $user_name; ?>" pattern="[\s A-Za-zА-Яа-яЁё]{3,}" required="required" id="name">
						<input class="text" placeholder="Номер телефона" name="user_phone" type="tel" pattern="[\D 0-9]{17,}" required="required" id="tel">
                        <?php if ( !empty($_POST['user_name']) && !empty($_POST['user_phone']) ) : ?>
                            <?php get_travel_lid(); ?>
                            <h5><?php the_field('form_sended'); ?></h5>
						<?php endif; ?>
                        <button class="btnRed" type="submit">Отправить</button>
					</form>
				</div>
    
			</div>
		</div>
		<div class="container container_bot">
			<div class="contactsTravel">
				<h3 class="H3 H3_bot"><?php the_field('contacts_name'); ?></h3>
				<h1><?php the_field('contacts_title'); ?></h1>
				<h5><?php the_field('contacts_subtitle'); ?></h5>
				<div class="contactsTravel__iconsLine">
					<a href="<?php the_field('contacts_tg'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/travel/travelTelegram.png" alt="travelTelegram"></a>
					<a href="<?php the_field('contacts_instagram'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/travel/travelInst.png" alt="travelInst"></a>
					<a href="<?php the_field('contacts_wa'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/travel/travelWhatsapp.png" alt="travelWhatsapp"></a>
					<a href="mailto:<?php the_field('contacts_email'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/travel/travelMail.png" alt="travelMail"></a>
				</div>
			</div>
		</div>
		<script src="<?php echo get_template_directory_uri(); ?>/js/travelForm.min.js"></script>
	</section>
</main>
<?php get_footer(); ?>