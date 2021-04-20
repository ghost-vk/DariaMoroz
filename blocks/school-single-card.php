<div class="card-mini__card card-mini__card-school">
	<div class="card-mini__startTo">
		<img src="<?= get_template_directory_uri(); ?>/img/clock.svg" alt="Осталось времени">
		<div class="card-mini__startText">
			<p class="text"><?= $before_expires_text ?></p>
			<span class="countdown"><?= $single_expires; ?></span>
		</div>
	</div>
	<div class="card-mini__card-img">
		<a href="<?= $course_link ?>">
			<img src="<?= $course_image?>" alt="Изображение курса">
		</a>
	</div>
	<div class="card__title">
		<span><?= $course_title?></span>
	</div>
	<p class="card__subtitle card__subtitle_desc"><?= $course_subtitle ?></p>
	<a href="<?= $course_link ?>" class="btnRed"><?= $btn_text_about_single ?></a>
</div>