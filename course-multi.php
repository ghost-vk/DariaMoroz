<?php
/*
Template Name: Записанный курс
Template post type: course
*/
?>
<?php get_header(); ?>
<main>
	<section id="page">
		<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/coursetwerkout.css">
		<svg class="unionLong unionLong_hide" viewBox="0 0 2047 12227">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M212.384 1526.47L212 1526L212.384 1525.66V1525.59H212.459L466.004
				1300.64L160 1026.77V12227H0V824H158.172L158.884 823.363L159.588
				824H160V824.372L577.481 1201.73L1931.94 0L2046.84 102.842L697.657
				1310.36L935.321 1525.18L934.899 1525.59H936.153V1668.71H212.384V1526.47ZM457.166
				1525.59H717.354L587.26 1409.16L457.166 1525.59Z" fill="white" />
		</svg>
		<div style="background-image: url(<?php the_field('background_image'); ?>);" class="courseBg">
			<div class="container container_top">
				<div class="courseTwerkoutTop">
					<span class="courseTwerkoutTop__DM courseTwerkoutTop__DM_desktop">Daria<br>Moroz</span>
					<div class="courseTwerkoutTop__content">
						<div class="courseTwerkoutTop__right">
							<h2><?php the_field('main_title'); ?></h2>
							<div class="courseTwerkoutTop__subTitle">
								<h6><?php the_field('main_subtitle'); ?></h6>
							</div>
							<p class="courseTwerkoutTop__desc text"><?php the_field('short_description'); ?>
							</p>
                            <a href="#packages" class="btnRed"><?php the_field('first_btn_text'); ?></a>
							<span class="courseTwerkoutTop__DM courseTwerkoutTop__DM_mobile">Daria<br>Moroz</span>
						</div>
					</div>
					<div class="skill skill_course">
      
						<?php require_once __DIR__ . "/blocks/about-me-links.php"; // Section with 5 links "About me" ?>

                    </div>
				</div>
			</div>
		</div>
		
        <?php require_once __DIR__ . "/blocks/course-multi-program.php"; // Section course program ?>
		
		<?php require_once __DIR__ . "/blocks/course-multi-packages.php"; // Section course packages ?>

        <?php $wrapper_class = 'courseTwerkoutBot'; ?>
        <?php require_once __DIR__ . "/blocks/course-prepay.php"; // Section prepay ?>
  
		<script src="<?php echo get_template_directory_uri(); ?>/js/courseAdaptive.min.js"></script>
	</section>
</main>
<?php get_footer(); ?>