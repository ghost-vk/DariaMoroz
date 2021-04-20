<?php if (have_rows('program_theme')) : $i = 1; ?>
	<?php while (have_rows('program_theme')) : the_row(); ?>
		<div class="theme">
			<h3 class="H3 H3_top">Тема <?= $i; ?></h3>
			<h2><?php the_sub_field('title'); ?></h2>
			<h6><?php the_sub_field('subtitle'); ?></h6>
			<div class="theme__content theme__content_close text">
				<?php the_sub_field('description'); ?>
			</div>
			<span class="theme__btn text">Развернуть программу</span>
		</div>
		<?php $i += 1; ?>
	<?php endwhile; ?>
<?php endif; ?>

<div class="fullProgramBtn">
	<a href="<?php the_field('program_link'); ?>" class="btnRed" target="_blank">Скачать полную программу</a>
</div>
