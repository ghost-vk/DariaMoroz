<?php
/*
Template Name: Онлайн школа
*/
?>
<?php get_header(); ?>
<main>
	<section id="page" class="online">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/onlineSchool.css">
		<svg class="unionLong" viewBox="0 0 2047 12227">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M212.384 1526.47L212 1526L212.384 1525.66V1525.59H212.459L466.004
				1300.64L160 1026.77V12227H0V824H158.172L158.884 823.363L159.588
				824H160V824.372L577.481 1201.73L1931.94 0L2046.84 102.842L697.657
				1310.36L935.321 1525.18L934.899 1525.59H936.153V1668.71H212.384V1526.47ZM457.166
				1525.59H717.354L587.26 1409.16L457.166 1525.59Z" fill="white" />
		</svg>
		<div class="bg bg_dark bg_contain bg_custom">
			<div class="container container_full">
				<div class="content">
					<div class="title">
						<h1>Онлайн<br>школа</h1>
						<h3 class="H3 H3_top">Не упусти шанс</h3>
					</div>
                    
                    <?php require_once __DIR__ . '/blocks/online-school-posts.php'; // posts ?>
                    
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>