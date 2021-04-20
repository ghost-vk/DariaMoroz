<?php
/*
Template Name: Обо мне
*/
?>
<?php get_header();?>
<main>
    <!--   MODAL   -->
    <div class="popup-window" id="video-popup">
        <i id="popup-close" class="fas fa-times"></i>
        <div id="player"></div>
    </div>
    
	<section id="page" class="about">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/about.css">
		<svg class="unionLong unionLong_hide" viewBox="0 0 2047 12227">
			<path fill-rule="evenodd" clip-rule="evenodd"
				d="M212.384 1526.47L212 1526L212.384 1525.66V1525.59H212.459L466.004
				1300.64L160 1026.77V12227H0V824H158.172L158.884 823.363L159.588
				824H160V824.372L577.481 1201.73L1931.94 0L2046.84 102.842L697.657
				1310.36L935.321 1525.18L934.899 1525.59H936.153V1668.71H212.384V1526.47ZM457.166
				1525.59H717.354L587.26 1409.16L457.166 1525.59Z" fill="white"/>
		</svg>
		<div class="bg bg_dark bg_cover bg_noRepeat">
			<div class="container container_top">
				<div class="aboutTop">
					<div class="aboutTop__content">
						<img class="aboutTop__mask" src="<?php echo get_template_directory_uri(); ?>/img/mask.png" alt="aboutMask">
						<img class="aboutTop__dasha" src="<?php echo get_template_directory_uri(); ?>/img/about/dashaAbout.png" alt="aboutDasha">
						<span>Daria<br>Moroz</span>
						<svg class="aboutTop__play" id="video-play" width="130" height="130" fill="none" viewBox="0 0 130 130">
							<path d="M58.7023 56.2145L76.1047 64.6262L59.3954 75.39L58.7023 56.2145Z" fill="#FFFFFF"/>
							<path d="M107.095 44.0276C95.4751 20.8164 67.2388 11.4199 44.0276
								23.04C20.8164 34.6601 11.42 62.8965 23.0401 86.1077C34.6602 109.319
								62.8965 118.715 86.1077 107.095C96.3058 101.99 103.837 93.6767 108.091
								83.9916" stroke="#FFFFFF" stroke-width="2"/>
						</svg>
					</div>
					<div class="skill">
      
						<?php require_once __DIR__ . "/blocks/about-me-links.php"; // Section with 5 links "About me" ?>

                    </div>
				</div>
			</div>
		</div>
		<div class="bg bg_dark bg_contain bg_noRepeat">
			<div class="container container_center">
				<div class="aboutSpecial">
					<h3 class="H3 H3_bot">Специализация</h3>
					<div class="aboutSpecial__position">
						<h4><?php the_field('spec_title_1'); ?></h4>
						<p class="text"><?php the_field('spec_description_1'); ?></p>
					</div>
					<div class="aboutSpecial__position">
						<h4><?php the_field('spec_title_2'); ?></h4>
						<p class="text"><?php the_field('spec_description_2'); ?></p>
					</div>
					<div class="aboutSpecial__position">
						<h4><?php the_field('spec_title_3'); ?></h4>
						<p class="text"><?php the_field('spec_description_3'); ?></p>
					</div>
				</div>
				<div class="aboutIm">
					<h3 class="H3 H3_bot">Мои достижения</h3>
					<h1><?php the_field('skill_title'); ?></h1>
                    <?php the_field('skill_items'); ?>
				</div>
			</div>
		</div>
		<div class="container container_bot">
			<div class="aboutSlider">
				<h3 class="H3 H3_top">Моя квалификация...</h3>
				<h1><?php the_field('certificates_title'); ?></h1>
				<div class="aboutSlider__slider">
					<div class="aboutSlider__arrow aboutSlider__arrow_left"></div>
					<div id="sliderSert" class="aboutSlider__track">
						<div class="aboutSlider__trackImg">
                            <?php if(have_rows('certificates')) :
                                while (have_rows('certificates')) : the_row();
                                    $image = get_sub_field('image'); ?>
                                    <img class="aboutSlider__sert" src="<?= esc_url($image); ?>">
                                <?php endwhile; ?>
                            <?php endif; ?>
                            
                            <?php if (have_rows('certificates')) : the_row();
                                for ($i = 1; $i < 22; $i += 1) : // 21 certificate maximum
                                    $certificate_image = get_sub_field('с_' . $i);
                                    if ($certificate_image) : ?>
                                        <img class="aboutSlider__sert" src="<?= $certificate_image; ?>">
									<?php endif; ?>
								<?php endfor; ?>
                            <?php endif; ?>
						</div>
					</div>
					<div class="aboutSlider__arrow aboutSlider__arrow_right"></div>
				</div>
				<div id="dots" class="aboutSlider__sliderDots">
				</div>
				<div class="aboutSlider__popup">
				</div>
			</div>
		</div>
		<script src="<?= get_template_directory_uri(); ?>/js/sliderAbout.min.js"></script>
	</section>
</main>
<?php get_footer();?>