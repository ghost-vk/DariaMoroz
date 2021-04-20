<?php if (have_rows('plan_what')) : the_row(); // Program head block data
	$program = array(
		"title_main" => get_sub_field('title_main'),
		'title_3' => get_sub_field('title_3'),
		'subtitle_3' => get_sub_field('subtitle_3'),
	);
	
	$type = get_sub_field('type');
	if ($type == "default") {
	    $count = count(get_field('module')); // Modules count
		$program['title_1'] = $count;
		$program['subtitle_1'] = get_word_form($count, 'модулей', 'модуля', 'модуль');
		
		$video_count = 0;
		
		$product_ids = get_field('products');
		if ( !empty($product_ids) ) {
            $package_id = $product_ids['package_1'][0];
			$video_count = count(get_field('lesson', $package_id));
        }
		
		$program['title_2'] = $video_count;
		$program['subtitle_2'] = 'видео';
	} elseif ($type == "custom") {
		$program['title_1'] = get_sub_field('title_1');
		$program['title_2'] = get_sub_field('title_2');
		$program['subtitle_1'] = get_sub_field('subtitle_1');
		$program['subtitle_2'] = get_sub_field('subtitle_2');
	} ?>
	
	<div class="bg bg_light bg_noRepeat bg__courseTwerk_contain">
		<div class="container container_center">
			<div class="courseTwerkoutProgram">
				<h1><?php the_field('plan_title'); ?></h1>
				<div class="courseTwerkoutProgram__line">
					<h3 class="H3 H3_bot"><?= $program['title_main']; ?></h3>
					<div class="courseTwerkoutProgram__pos">
						<span><?= $program['title_1']; ?></span>
						<h6><?= $program['subtitle_1']; ?></h6>
					</div>
					<div class="courseTwerkoutProgram__pos">
						<span><?= $program['title_2']; ?></span>
						<h6><?= $program['subtitle_2']; ?></h6>
					</div>
					<div class="courseTwerkoutProgram__pos">
						<span><?= $program['title_3']; ?></span>
						<h6><?= $program['subtitle_3']; ?></h6>
					</div>
				</div>
				<div class="courseTwerkoutProgram__modules">
					<?php if (have_rows('module')): $i = 1; // If have modules ?>
						<?php while (have_rows('module')): the_row(); ?>
							<div class="module">
								<h3 class="H3 H3_top"><?= $i; ?> модуль</h3>
								<h2><?= get_sub_field('name'); ?></h2>
								
								<?php $type = get_sub_field('type');
								if ($type == "only_description") : // Only description module ?>
									<div class="module__pos">
										<h6><?= get_sub_field('description'); ?></h6>
									</div>
								<?php elseif ($type == "with_lesson") : // Module with lessons ?>
									<?php if (have_rows('lesson')) : $j = 1; ?>
										<?php while (have_rows('lesson')) : the_row(); ?>
											<div class="module__pos">
												<h6>урок №<?= $j; ?></h6>
												<p class="text"><?php the_sub_field('text'); ?></p>
											</div>
											<?php $j += 1; ?>
										<?php endwhile; ?>
									<?php endif; ?>
								<?php endif ?>
							</div>
							<?php $i += 1; ?>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php endif ?>

