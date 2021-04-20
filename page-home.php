<?php
/*
Template Name: Домашняя страница
Template Post Type: page
*/
?>
<?php
if ( !empty($_GET['code']) ) {
	authenticate_vk();
}
?>

<?php get_header(); ?>
<main>
	<section id="page" class="main">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">
	<svg class="unionMain" viewBox="0 0 2047 12227">
		<path fill-rule="evenodd" clip-rule="evenodd"
			d="M212.384 1526.47L212 1526L212.384 1525.66V1525.59H212.459L466.004
			1300.64L160 1026.77V12227H0V824H158.172L158.884 823.363L159.588
			824H160V824.372L577.481 1201.73L1931.94 0L2046.84 102.842L697.657
			1310.36L935.321 1525.18L934.899 1525.59H936.153V1668.71H212.384V1526.47ZM457.166
			1525.59H717.354L587.26 1409.16L457.166 1525.59Z" fill="white"/>
	</svg>
	<div class="bg bg_light bg_noRepeat bg_cover">
		<div class="container container_top">
			<div class="oneBlock">
				<span class="oneBlock__textBg">Daria Moroz</span>
				<img class="oneBlock__dasha" src="<?= get_template_directory_uri(); ?>/img/dup.png" alt="dup">
				<div class="oneBlock__top">
					<div class="oneBlock__title">
						<h2><?= the_field('mainTitleOne'); ?></h2>
					</div>
					<div class="oneBlock__text">
						<p><?= the_field('mainDescOne'); ?></p>
					</div>
					<a class="btnRed" href="<?= the_field('mainBtnTop'); ?>"><?= the_field('mainBtnName'); ?></a>
					<div class="oneBlock__botContent">
						<div class="oneBlock__video" id="video-start-fixed-block">
                            <div id="oneBlock__fixed">
                                <div class="oneBlock__content" id="first-video-block">
                                    <video id="first-video" autoplay loop muted playsinline preload="metadata">
                                        <source src="<?php echo the_field('first_video'); ?>" type="video/mp4" />
                                    </video>
                                    <picture>
                                        <source type="image/svg+xml" srcset="<?= get_template_directory_uri(); ?>/img/icons/stop.svg" />
                                        <img src="<?= get_template_directory_uri(); ?>/img/icons/stop.png" />
                                    </picture>
                                    <div class="oneBlock__sound">
                                        <i class="fas fa-volume-up"></i>
                                    </div>
                                    <div class="oneBlock__closer">
                                        <i class="fas fa-times"></i>
                                    </div>
                                </div>
                            </div>
						</div>
						<span>Daria<br>Moroz</span>
					</div>
				</div>
				<div class="skill">
                    
                    <?php require_once __DIR__ . "/blocks/about-me-links.php"; // Section with 5 links "About me" ?>
                    
				</div>
			</div>
		</div>
	</div>
	<div class="bg bg_light bg_noRepeat bg_cover">
		<div class="gradient gradient_topBot">
			<div class="twoContainer">
				<div class="twoBlock">
					<div class="twoBlock__top">
						<div class="twoBlock__mask">
							<img class="twoBlock__mask-logo" src="<?= get_template_directory_uri(); ?>/img/mask.png" alt="mask">
							<img class="twoBlock__mask-dasha" src="<?= get_template_directory_uri(); ?>/img/dShadow.png" alt="dshadow">
							<h3 class="H3 H3_twoBlock"><?= the_field('third_block_name'); ?></h3>
						</div>
                        <?php if (have_rows('third_block_links')) : the_row(); ?>
                            <div class="twoBlock__varTrain">
                                <a href="<?= get_sub_field('link_1'); ?>"><?= get_sub_field('name_1'); ?></a>
                                <a href="<?= get_sub_field('link_2'); ?>"><?= get_sub_field('name_2'); ?></a>
                                <a href="<?= get_sub_field('link_3'); ?>"><?= get_sub_field('name_3'); ?></a>
                            </div>
                        <?php endif; ?>
					</div>
					<div class="twoBlock__bot">
						<div class="twoBlock__bonus textDefault">
							<span>Что ты получишь?</span>
                            <?php if (have_rows('fourth_block_features')) : the_row(); ?>
                                <p><?= get_sub_field('text_1'); ?></p>
                                <p><?= get_sub_field('text_2'); ?></p>
                                <p><?= get_sub_field('text_3'); ?></p>
                                <p><?= get_sub_field('text_4'); ?></p>
                            <?php endif; ?>
						</div>
						<h1>Бесплатный<br>урок</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container container_center">
		<div class="threeBlock">
			<div class="threeBlock__video">
				<img src="<?= the_field('five_block_image'); ?>" alt="freeTrain">
                <picture class="play-btn">
                    <source type="image/svg+xml" srcset="<?= get_template_directory_uri(); ?>/img/icons/play.svg" />
                    <img id="play-btn" src="<?= get_template_directory_uri(); ?>/img/icons/play.png" />
                </picture>
			</div>
            <div class="popup-window" id="video-home-popup">
                <i id="popup-close" class="fas fa-times"></i>
                <div id="player"></div>
            </div>
			<h3 class="H3 H3_bot H3_desktop">Сомневаешься? Смотри</h3>
			<h3 class="H3 H3_bot H3_mobile">Смотри</h3>
		</div>
	</div>
	<div class="bg bg_dark bg_noRepeat bg_contain">
		<div class="container container_bot">
			<div class="fourBlock">
				<div class="fourBlock__title">
					<h1>Афиша</h1>
					<h3 class="H3 H3_top">Будь в теме</h3>
				</div>
				<div class="card-mini">
					<?php
                    $today = date("Y-m-d");
                    $args = array(
                        'post_type' => 'marathon',
                        'posts_per_page' => 3,
                        'meta_query' => array(
                            'marathon' => array(
								'key' => 'marathonStart',
								'value' => array($today, '2100-01-01'), // From today to 2100 year
								'compare' => 'BETWEEN',
								'type' => 'DATE'
                            ),
                        ),
                        'orderby' => 'marathon',
                        'order' => 'ASC',
                    );
					$myposts = get_posts( $args );
					foreach( $myposts as $post ) :
						setup_postdata($post); ?>
                        <div class="card-mini__card">
                            <div class="card-mini__card-img">
                                <img src="<?php the_field('home_image'); ?>">
                            </div>
                            <div class="card__title">
                                <span><?= cut_year_dmy(get_field('marathonStart')); ?></span>
                                <div class="card__title_lineRed"></div>
                                <span><?= cut_year_dmy(get_field('marathonFinish')); ?></span>
                            </div>
                            <span class="card__subtitle card__subtitle_time">В <?php echo get_field('marathonTime'); ?></span>
                            <p class="card__subtitle card__subtitle_desc"><?php echo get_field('marathonTitle'); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btnRed">Подробнее</a>
                        </div>
                    <?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
</main>
<?php get_footer();?>