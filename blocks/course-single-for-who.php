<h3 class="H3 H3_bot"><?php the_field('for_who_subtitle'); ?></h3>
<h1><?php the_field('for_who_title'); ?></h1>
<div class="courseThree__line">
	<?php if (have_rows('groups')) : the_row(); ?>
		<?php for ($i = 1; $i < 5; $i += 1) : // 4 types ?>
			<div class="courseThree__pos">
				<p class="courseThree__title text"><?php the_sub_field('title_' . $i); ?></p>
				<p class="courseThree__text textDefault"><?php the_sub_field('text_' . $i); ?></p>
			</div>
		<?php endfor; ?>
	<?php endif; ?>
</div>

<?php $course_id = get_field('course_product')[0]; ?>

<a href="#" class="btnRed alert-btn" data-alert="addedToCart" data-product="<?= $course_id; ?>"
   data-action="add_to_cart"><?php the_field('for_who_button_text'); ?></a>