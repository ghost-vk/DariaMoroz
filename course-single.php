<?php
/*
Template Name: Динамический курс
Template post type: course
*/
?>
<?php get_header();?>
<main>
	<section id="page">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/courseteacher.css">
		<svg class="unionLong unionLong_hide" viewBox="0 0 2047 12227">
			<path fill-rule="evenodd" clip-rule="evenodd"
				d="M212.384 1526.47L212 1526L212.384 1525.66V1525.59H212.459L466.004
				1300.64L160 1026.77V12227H0V824H158.172L158.884 823.363L159.588
				824H160V824.372L577.481 1201.73L1931.94 0L2046.84 102.842L697.657
				1310.36L935.321 1525.18L934.899 1525.59H936.153V1668.71H212.384V1526.47ZM457.166
				1525.59H717.354L587.26 1409.16L457.166 1525.59Z" fill="white"/>
		</svg>
		
        <?php require_once __DIR__ . "/blocks/course-single-main.php"; // Main info about course ?>
        
		<div class="bg bg_light bg_noRepeat bg_cover bg_three">
			<div class="container container_center">
				
				<?php require_once __DIR__ . "/blocks/course-single-description.php"; // Course description ?>

                <div class="courseThree">
					<?php require_once __DIR__ . "/blocks/course-single-for-who.php"; // "For who" section ?>
				</div>
    
			</div>
		</div>
		<div class="container container_center">
			<div class="courseProgram">
				<h1>Программа</h1>
				<div id="themes" class="courseProgram__content">
                    <?php require_once __DIR__ . "/blocks/course-single-program.php"; // "For who" section ?>
					
				</div>
			</div>
		</div>
		
		<?php $wrapper_class = 'courseBot'; ?>
		<?php require_once __DIR__ . "/blocks/course-prepay.php"; // Section prepay ?>

        <script src="<?php echo get_template_directory_uri(); ?>/js/courseAdaptive.min.js"></script>
	</section>
</main>
<?php get_footer();?>