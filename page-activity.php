<?php
/*
Template Name: Архив мероприятий
Template Post Type: page
*/
?>

<?php get_header();?>

<?php // Collects data
$data = array(
    'title' => array(),
    'background' => array(),
    'start_date' => array(),
    'end_time' => array(),
    'start_time' => array(),
    'link' => array(),
);
$today = date("Y-m-d");
$args = array(
    'post_type' => 'marathon',
    'posts_per_page' => -1,
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
$posts = get_posts( $args );

foreach($posts as $i => $post) {
	setup_postdata($post);
	$data['title'][$i] = get_field('marathonTitle');
	$data['background'][$i] = get_field('bg_in_events');
	$data['start_date'][$i] = cut_year_dmy( get_field('marathonStart') );
	$data['end_time'][$i] = cut_year_dmy( get_field('marathonFinish') );
	$data['start_time'][$i] = get_field('marathonTime');
	$data['link'][$i] = get_the_permalink();
}
wp_reset_postdata();

$button_text = get_field('link_text'); // Button text in marathon card
?>

<main>
	<section id="page" class="mer">
		<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/activity.min.css">
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
				<div class="title">
					<h1><?php the_field('title'); ?></h1>
					<h3 class="H3 H3_top"><?php the_field('label'); ?></h3>
				</div>
				<div class="contentMer__desktop">
					<?php $posts_count = count($data['title']);
                    for ($i = 0; $i < $posts_count; $i += 1) :
                        if ($i > 4) {
                            $lazy = 'loading="lazy"';
                        } else {
							$lazy = '';
                        } ?>
                        <div class="card-big">
                            <div class="card-big__img">
                                <img src="<?= $data['background'][$i]; ?>" alt="card" <?= $lazy; ?>>
                            </div>
                            <div class="card-big__content">
                                <div class="card__title">
                                    <span><?= $data['start_date'][$i]; ?></span>
                                    <div class="card__title_lineWhite"></div>
                                    <span><?= $data['end_time'][$i]; ?></span>
                                </div>
                                <span class="card__subtitle card__subtitle_time"><?= $data['start_time'][$i]; ?></span>
                                <p class="card__subtitle card__subtitle_desc"><?= $data['title'][$i]; ?></p>
                                <a href="<?= $data['link'][$i]; ?>" class="card__details">
                                    Узнать подробнее
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/activity/arrow.png" alt="arrow" <?= $lazy; ?>>
                                </a>
                            </div>
                            <a class="btnWhite btnWhite_big" href="<?= $data['link'][$i]; ?>"><?= $button_text; ?></a>
                        </div>
                    <?php endfor; ?>
				</div>
				<div class="contentMer__mobile">
					<?php for($i = 0; $i < $posts_count; $i += 1) :
						if ($i > 4) {
							$lazy = 'loading="lazy"';
						} else {
							$lazy = '';
						} ?>
                        <div class="card-mini__card">
                            <div class="card-mini__card-img">
                                <img src="<?= get_template_directory_uri(); ?>/img/activity/main.jpg" alt="afisha1" <?= $lazy; ?>>
                            </div>
                            <div class="card__title">
                                <span><?= $data['start_date'][$i]; ?></span>
                                <div class="card__title_lineRed"></div>
                                <span><?= $data['end_time'][$i]; ?></span>
                            </div>
                            <span class="card__subtitle card__subtitle_time">В <?= $data['start_time'][$i] ?></span>
                            <p class="card__subtitle card__subtitle_desc"><?= $data['title'][$i]; ?></p>
                            <a href="<?= $data['link'][$i]; ?>" class="card__details">
                                    Узнать подробнее
                                <img src="<?php echo get_template_directory_uri(); ?>/img/activity/arrow.png" alt="arrow" <?= $lazy; ?>>
                            </a>
                            <a href="<?= $data['link'][$i]; ?>" class="btnWhite"><?= $button_text; ?></a>
                        </div>
                    <?php endfor; ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php require_once __DIR__ . "/blocks/uncompleted.html"; // Popup with message about uncompleted function ?>

<?php get_footer();?>