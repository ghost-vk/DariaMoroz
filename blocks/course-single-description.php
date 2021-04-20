<?php $turn_lid = get_field('block_lid_status'); ?>

<div class="courseTwo">
	<h1 class="title__hide">Daria<br>Moroz</h1>
	<div class="courseTwo__right">
		<p class="text"><?php the_field('course_description'); ?></p>
		<?php if ( $turn_lid == true ) : ?>
			<span>Регистрируйся на курс сегодня и получи скидку на обучение!</span>
			<a href="#" class="btnRed popup-opener" data-popup="popup-lid">Зарегистрироваться</a>
		<?php endif; ?>
	</div>
</div>


		