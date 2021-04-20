<?php
/*
Template Name: Мероприятие
Template post type: marathon
*/
?>
<?php get_header();?>
<main>
	<section id="page">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/marathontwerk.css">
		<svg class="unionLong unionLong_hide" viewBox="0 0 2047 12227">
			<path fill-rule="evenodd" clip-rule="evenodd"
				d="M212.384 1526.47L212 1526L212.384 1525.66V1525.59H212.459L466.004
				1300.64L160 1026.77V12227H0V824H158.172L158.884 823.363L159.588
				824H160V824.372L577.481 1201.73L1931.94 0L2046.84 102.842L697.657
				1310.36L935.321 1525.18L934.899 1525.59H936.153V1668.71H212.384V1526.47ZM457.166
				1525.59H717.354L587.26 1409.16L457.166 1525.59Z" fill="white"/>
		</svg>
		<div style="background-image: url(<?php the_field('bg_image'); ?>" class="courseBg">
			<div class="container container_top">
				<div class="marathonTop">
					<span class="marathonTop__DM marathonTop__DM_desktop">Daria<br>Moroz</span>
					<div class="marathonTop__content">
						<div class="marathonTop__right">
							<div class="marathonTop__date">
								<h2><?= cut_year_dmy(get_field('marathonStart')); ?></h2>
								<span></span>
								<h2><?= cut_year_dmy(get_field('marathonFinish')); ?></h2>
							</div>
							<div class="marathonTop__time">
								<h6>В <?php the_field('marathonTime'); ?></h6>
							</div>
							<h2><?php the_field('marathonTitle'); ?></h2>
							<p class="text"><?php the_field('marathonDesc'); ?></p>
							<a href="#" class="btnRed scroll-to-free">Участвовать бесплатно</a>
							<span class="marathonTop__DM marathonTop__DM_mobile">Daria<br>Moroz</span>
						</div>
					</div>
					<div class="skill skill_course">
						
						<?php require_once __DIR__ . "/blocks/about-me-links.php"; // Section with 5 links "About me" ?>
                    
                    </div>
				</div>
			</div>
		</div>
		<div class="bg bg_light bg_noRepeat bg_cover">
			<div class="gradient gradient_topBot">
				<div class="container container_center">
					<div class="marathonOne">
						<h3 class="H3 H3_bot">что будет</h3>
						<h1><?php the_field('content_title'); ?></h1>
						<div class="marathonOne__content">
                            <?php the_field('content'); ?>
                        </div>
						<a href="#" class="btnRed scroll-to-free">Участвовать бесплатно</a>
					</div>
				</div>
			</div>
		</div>
        
        <!--   MODAL   -->
        <div class="popup-window" id="video-popup">
            <i id="popup-close" class="fas fa-times"></i>
            <div id="player"></div>
        </div>
        
		<div class="container container_center">
			<div class="marathonFreelesson">
				<h3 class="H3 H3_bot H3_desktop">Бонус для каждого</h3>
				<h3 class="H3 H3_bot H3_mobile">Бонус</h3>
				<h1 id="free-train-title">Бесплатный<br>урок</h1>
				<div class="marathonFreelesson__video">
					<img src="<?php the_field('video_image'); ?>" alt="freeTrain">
                    <picture class="play-btn">
                        <source type="image/svg+xml" srcset="<?= get_template_directory_uri(); ?>/img/icons/play.svg" />
                        <img id="play-marathon" src="<?= get_template_directory_uri(); ?>/img/icons/play.png" />
                    </picture>
                    
            <?php if (is_user_logged_in()) : ?>
                    <a class="btnWhite btnWhite_big alert-btn" href="#" data-alert="addedEvent" data-action="add_event_to_user">Получить урок</a>
                </div>
                <a class="btnWhite btnWhite_mobile alert-btn" href="#" data-alert="addedEvent" data-action="add_event_to_user">Получить урок</a>
            <?php else : ?>
                    <a class="btnWhite btnWhite_big popup-opener" href="#" data-popup="popup-login">Получить урок</a>
                </div>
                <a class="btnWhite btnWhite_mobile popup-opener" href="#" data-popup="popup-login">Получить урок</a>
            <?php endif;?>
			</div>
		</div>
		<div class="bg bg_dark bg_noRepeat bg_cover">
			<div class="gradient gradient_topBot">
				<div class="container container_center">
					<div class="marathonThree">
						<h3 class="H3 H3_bot">Абсолютно всем</h3>
						<h1>Для кого</h1>
						<div class="marathonThree__line">
                            <?php if (have_rows('who')) : the_row(); ?>
                                <div class="marathonThree__pos">
                                    <p class="marathonThree__title text"><?= get_sub_field('who_1'); ?></p>
                                    <p class="marathonThree__text textDefault"><?= get_sub_field('why_1'); ?></p>
                                </div>
                                <div class="marathonThree__pos">
                                    <p class="marathonThree__title text"><?= get_sub_field('who_2'); ?></p>
                                    <p class="marathonThree__text textDefault"><?= get_sub_field('why_2'); ?></p>
                                </div>
                                <div class="marathonThree__pos">
                                    <p class="marathonThree__title text"><?= get_sub_field('who_3'); ?></p>
                                    <p class="marathonThree__text textDefault"><?= get_sub_field('why_3'); ?></p>
                                </div>
                                <div class="marathonThree__pos">
                                    <p class="marathonThree__title text"><?= get_sub_field('who_4'); ?></p>
                                    <p class="marathonThree__text textDefault"><?= get_sub_field('why_4'); ?></p>
                                </div>
                            <?php endif; ?>
						</div>
						<a href="#" class="btnRed popup-opener" data-popup="popup-lid">Записаться на марафон</a>
					</div>
				</div>
				<div class="container container_bot">
					<div class="marathonDaysof">
						<h3 class="H3 H3_bot">Абсолютно всем</h3>
						<h1>дни<br>проведения</h1>
						<div class="marathonDaysof__date">
							<h2><?= cut_year_dmy(get_field('marathonStart')); ?></h2>
							<span></span>
							<h2><?= cut_year_dmy(get_field('marathonFinish')); ?></h2>
						</div>
						<div class="marathonDaysof__time">
							<h6>В <?php the_field('marathonTime'); ?></h6>
						</div>
						<p class="text">Нажмите куда Вам прислать бонусный урок и уведомление о начале марафона, 
							чтобы вы его не пропустили?</p>
						<div class="marathonDaysof__btns">
							<a href="#" class="btnRed popup-opener" data-popup="popup-lid" data-select="vk">Vkontakte</a>
							<a href="#" class="btnCustom popup-opener" data-popup="popup-lid" data-select="tg">Telegram</a>
						</div>
					</div>
				</div>
			</div>
		</div>
        
		<script src="<?php echo get_template_directory_uri(); ?>/js/courseAdaptive.js"></script>
	</section>
</main>

<?php get_footer();?>