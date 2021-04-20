<?php
$exclude_ids_multi = array(); // Showed posts with multi course
$exclude_ids_single = array(); // Showed posts with single course
$today = date("Y-m-d H:i:s");

// Loop checkers
$have_single_course = true;
$have_multi_course = true;
$outer_loop_counter = 0;

// Page settings
$now = new \DateTime('now');

$already_run_text = get_field('already_run_text');
$before_expires_text = get_field('before_expires_text');
$btn_text_about_single = get_field('btn_text_about_single');
$btn_text_about_multi = get_field('btn_text_about_multi');
$btn_mobile_text_about_multi = get_field('btn_mobile_text_about_multi');

$is_card_mini_empty = false;
$has_second_dynamic_row = false;
?>

<?php while ($have_single_course == true || $have_multi_course == true) : // While have courses ?>

    <?php $args_single_course = get_args_for_school_query('course_single', 'waiting', $today, 3, $exclude_ids_single);
		$query = new WP_Query($args_single_course);
		$single_post_count = $query->post_count;
		
		// SINGLE
		if ($have_single_course == true) : // If have single course ?>
            
            <div class="card-mini">
                <?php if ($single_post_count == 3) : // If all three course is waiting ?>
                
                    <?php while($query->have_posts()) : $query->the_post(); ?>
                    
                        <?php $start_day = \DateTime::createFromFormat('Y-m-d H:i:s', get_field('start_date'));
                        $time_between = $now->diff($start_day);
                        $single_expires = $time_between->d;
						$single_expires .= get_word_form(
                            $time_between->d,
                            ' день ',
                            ' дня ',
                            ' дней ');
                        $single_expires .= $time_between->h;
						$single_expires .= get_word_form(
							$time_between->h,
							' час ',
							' часа ',
							' часов ');
                        $single_expires .= $time_between->i;
                        $single_expires .= get_word_form(
							$time_between->i,
							' минута',
							' минуты',
							' минут');
                        
                        $course_link = get_the_permalink();
                        $course_image = get_field('course_image');
                        $course_title = get_the_title();
                        $course_subtitle = get_field('online_school_subtitle');
		
						$exclude_ids_single = collect_exclude_ids($exclude_ids_single); // Push to showed array
                        
                        require __DIR__ . '/school-single-card.php'; // Template for single course ?>
                    
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                
                    <?php if ($outer_loop_counter > 0 ) {
                        $has_second_dynamic_row = true;
                    } ?>
                
                <?php elseif ($single_post_count > 0 && $single_post_count < 3) : // If partial ?>
	
					<?php while ($query->have_posts()) : $query->the_post(); ?>
		
						<?php $start_day = \DateTime::createFromFormat('Y-m-d H:i:s', get_field('start_date'));
						$time_between = $now->diff($start_day);
						$single_expires = $time_between->d;
						$single_expires .= get_word_form(
							$time_between->d,
							' день ',
							' дня ',
							' дней ');
						$single_expires .= $time_between->h;
						$single_expires .= get_word_form(
							$time_between->h,
							' час ',
							' часа ',
							' часов ');
						$single_expires .= $time_between->i;
						$single_expires .= get_word_form(
							$time_between->i,
							' минута',
							' минуты',
							' минут');
		
						$course_link = get_the_permalink();
						$course_image = get_field('course_image');
						$course_title = get_the_title();
						$course_subtitle = get_field('online_school_subtitle');
		
						$exclude_ids_single = collect_exclude_ids($exclude_ids_single); // Push to showed array ?>
		
						<?php require __DIR__ . '/school-single-card.php'; // Template for single course ?>
	
					<?php endwhile;
					wp_reset_postdata(); ?>
	
					<?php $need_post_count = 3 - $single_post_count; // Остается вывести постов
					$args_single_course = get_args_for_school_query('course_single', 'running', $today, $need_post_count, $exclude_ids_single);
	
					$query = new WP_Query($args_single_course);
	
					if ($query->have_posts()) { // If run courses
						while ($query->have_posts()) {
							$query->the_post();
							
							$single_expires = $already_run_text;
							$course_link = get_the_permalink();
							$course_image = get_field('course_image');
							$course_title = get_the_title();
							$course_subtitle = get_field('online_school_subtitle');
							
							$exclude_ids_single = collect_exclude_ids($exclude_ids_single);
							
							require __DIR__ . '/school-single-card.php';
						}
						wp_reset_postdata();
					} ?>
	
					<?php if ($outer_loop_counter > 0 ) {
						$has_second_dynamic_row = true;
					} ?>
                
                <?php else : // Only running courses ?>
                    <?php $args_single_course = get_args_for_school_query('course_single', 'running', $today, 3, $exclude_ids_single);
					$query = new WP_Query($args_single_course);
	
					if ($query->have_posts()) { // If run courses
						while ($query->have_posts()) {
							$query->the_post();
							$single_post_count = $query->post_count;
							
							$single_expires = $already_run_text;
							$course_link = get_the_permalink();
							$course_image = get_field('course_image');
							$course_title = get_the_title();
							$course_subtitle = get_field('online_school_subtitle');
			
							$exclude_ids_single = collect_exclude_ids($exclude_ids_single);
			
							require __DIR__ . '/school-single-card.php';
						}
						wp_reset_postdata();
						
						if ($outer_loop_counter > 0 ) {
							$has_second_dynamic_row = true;
						}
					} ?>
                <?php endif; ?>
            </div>
        
            <?php if ( $single_post_count == 0 ) { // If haven't single courses
				$have_single_course = false; // Don't repeat
				$is_card_mini_empty = true;
			} ?>
        
        <?php endif; ?>

        <?php
        // MULTI
        if ($have_multi_course == true) : // If have multi course ?>
            <?php $bot_class = '';
			$bot__mob_class = '';
            if ($outer_loop_counter > 0) {
                $bot_class .= ' bot_not-first';
            }
            if ($is_card_mini_empty == true ) {
				$bot_class .= ' mt--30';
				$bot__mob_class .= ' mt-50';
            }
			if ($has_second_dynamic_row == true) {
				$bot_class .= ' mt-70';
			}
			?>
            
            <div class="bot <?= $bot_class; ?>">
                <?php if ($outer_loop_counter == 0) : ?>
                    <h3 class="H3 H3_top">лучшее для тебя</h3>
                <?php endif; ?>
				<?php $args_multi_course = get_args_for_school_query('course_multi', '', '', 3, $exclude_ids_multi);
				$query = new WP_Query($args_multi_course);
	
				$multi_post_count = $query->post_count;
	
				if ($query->have_posts()) :
					if ( ! is_mobile() ) : // If desktop device ?>
                        <div class="bot__desktop">
                            <?php while ($query->have_posts()) {
                                $query->the_post();
                                $exclude_ids_multi = collect_exclude_ids($exclude_ids_multi);
                                $image = get_field('course_image');
                                $title = get_the_title();
                                $subtitle = get_field('online_school_subtitle');
                                $link = get_the_permalink();
								
	
								require __DIR__ . '/school-multi-cart.php'; // Template PC card
                            }
							wp_reset_postdata(); ?>
                        </div>
					<?php else : // If mobile device ?>
                        <div class="bot__mob <?= $bot__mob_class; ?>">
                            <div class="bot__slider-wrapper slick-slider">
                                <?php while ($query->have_posts()) {
                                    $query->the_post();
                                    $exclude_ids_multi = collect_exclude_ids($exclude_ids_multi);
									$link = get_the_permalink();
									$image = get_field('course_image_mobile');
									$title = get_the_title();
									$subtitle = get_field('online_school_subtitle');
                                    
                                    require __DIR__ . '/school-multi-cart-mobile.php'; // Template mobile card
                                }
                                wp_reset_postdata(); ?>
                            </div>
                        </div>
					<?php endif; ?>
				<?php endif; ?>
	
				<?php if ($multi_post_count == 0) { // Don't show more if haven't multi course
					$have_multi_course = false;
				} ?>
            
            </div>
        <?php endif; ?>
    
    <?php $outer_loop_counter += 1; ?>
<?php endwhile; ?>

