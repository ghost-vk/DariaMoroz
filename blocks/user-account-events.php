<div class="officeContent__activity tabs officeContent__noActive" id="events">
    <?php $events = get_field('events_access', 'user_' . $user_id); ?>
        <?php if ( !empty($events) ) :
            $events_count = count($events);
			$events_desc = array_reverse($events);
            $j = $events_count - 1; // Outer loop counter ?>
        
            <?php foreach ($events_desc as $event) : ?>
        
                <?php $event_id = $event['event'][0];
                $event_access = $event['access'];
                $access_end = $event['access_end'];
                $start_date = get_field('marathonStart', $event_id);
                $finish_date = get_field('marathonFinish', $event_id);
                $start_time = get_field('marathonTime', $event_id);
                $start_datetime = DateTime::createFromFormat('d/m/Y H:i', $start_date . ' ' . $start_time);
                
                $is_access_end = false;
                if ( !empty($access_end) ) { // If manager set access end field for event
                    $access_end_datetime = \DateTime::createFromFormat('Y-m-d H:i:s', $access_end);
                    if ($now_datetime > $access_end_datetime) { // If access not expired
                        $is_access_end = true;
                    }
                } ?>
        
            <!--  EVENT BODY  -->
			<div class="office-item">
				<div class="office-item__title">
					<h4><?php the_field('user_account_title', $event_id); ?></h4>
					<span class="triang"></span>
				</div>
				<div class="office-item__head-wrapper">
					
					<?php if ( $now_datetime < $start_datetime && $event_access && $is_access_end == false ) : // If event not started ?>
						<h3 class="H3 H3_bot hidden">
							<?= cut_year_dmy($start_date) . ' в ' . $start_time; ?>
						</h3>
					<?php endif; ?>
					
					<div class="office-item__head">
						<div class="card__title">
							<span><?= cut_year_dmy($start_date); ?></span>
							<div class="card__title_lineWhite line-mobile-red"></div>
							<span><?= cut_year_dmy($finish_date); ?></span>
						</div>
						
						<?php if ($now_datetime < $start_datetime) : // If event not started ?>
							<p class="office-item__time card__subtitle">в <?= $start_time; ?></p>
						<?php endif; ?>
                        
                        <?php $class = ( $event_access && $is_access_end == false ) ? '' : 'not-access'; ?>
						<p class="office-item__subtitle card__subtitle <?= $class;  ?>">
							<?php the_field('marathonTitle', $event_id); ?>
						</p>
						
						
						<?php if ($now_datetime < $start_datetime && $event_access && $is_access_end == false ) : // If event not started ?>
							<a href="#" class="btnRed popup-opener" data-popup="popup-reminder_<?= $j; ?>">Напомнить <span>перед началом</span></a>
						<?php endif; ?>
					</div>
				</div>
				
				
				<?php if ( $event_access && have_rows('lessons', $event_id) && $is_access_end == false ) : // If lesson uploaded ?>
					<?php $rows_asc = get_field('lessons', $event_id);
					$rows_desc = array_reverse($rows_asc);
					$lessons_count = count($rows_desc);
					foreach ($rows_desc as $row) : ?>
						<?php $video_id = $row['video_id'];
						$lesson_start = $row['date'];
						$lesson_start_datetime = DateTime::createFromFormat('d/m/Y H:i', $lesson_start . ' ' . $row['time']); ?>
						<div class="office-item__body-wrapper">
							
							<?php if ($now_datetime < $lesson_start_datetime) : // If event not started ?>
								<h3 class="H3 H3_bot hidden">
									<?= cut_year_dmy($lesson_start) . ' в ' . $row['time']; ?>
								</h3>
							<?php endif; ?>
							
							<div class="office-item__body">
								<div class="office-item__name">
									<h4 class="small-red-underline small-transparent-underline text-no-wrap">Урок №<?= $lessons_count; ?></h4>
									<span class="triang"></span>
								</div>
								
								<?php if ($now_datetime < $lesson_start_datetime) : // If event not started ?>
									<div class="office-item__preview office-item__preview-unload">
										<img src="<?= $row['image']; ?>">
										<h5>Начало <?= cut_year_dmy($lesson_start) . ' в ' . $row['time']; ?></h5>
									</div>
								<?php elseif (empty($video_id)) : ?>
									<div class="office-item__preview office-item__preview-unload">
										<img src="<?= $row['image']; ?>">
										<h5>Видео скоро будет загружено</h5>
									</div>
								<?php else : ?>
									<div class="office-item__preview">
										<img src="<?= $row['image']; ?>">
										<picture class="play-btn">
											<source type="image/svg+xml" srcset="<?= get_template_directory_uri(); ?>/img/icons/play.svg" />
											<img class="play-video-btn"
                                                 src="<?= get_template_directory_uri(); ?>/img/icons/play.png"
                                                 data-modal="popup-eventVideo_<?= $j; ?>_<?= $lessons_count; ?>"
                                                 data-player="eventVideo_<?= $j; ?>_<?= $lessons_count; ?>"
                                            />
										</picture>
									</div>
								<?php endif; ?>
							</div>
						</div>
                        <!--   MODAL   -->
                        <div class="popup-window" id="popup-eventVideo_<?= $j; ?>_<?= $lessons_count; ?>">
                            <i class="fas fa-times popup-close"></i>
                            <div id="player-eventVideo_<?= $j; ?>_<?= $lessons_count; ?>"></div>
                        </div>
						<?php $lessons_count -= 1; ?>
					<?php endforeach; ?>
				<?php endif; ?>
				
				<?php $free_lesson = get_field('free_lesson', $event_id); ?>
				<?php if ($free_lesson) : // If free lesson in event ?>
					<div class="office-item__body-wrapper">
						<div class="office-item__body">
							<div class="office-item__name">
								<h4 class="small-red-underline small-transparent-underline text-no-wrap">Урок №0</h4>
								<span class="triang"></span>
							</div>
							<div class="office-item__preview">
								<img src="<?= $free_lesson['image']; ?>">
								<picture class="play-btn">
									<source type="image/svg+xml" srcset="<?= get_template_directory_uri(); ?>/img/icons/play.svg" />
									<img class="play-video-btn"
                                         src="<?= get_template_directory_uri(); ?>/img/icons/play.png"
                                         data-modal="popup-eventVideo_<?= $j; ?>_0"
                                         data-player="eventVideo_<?= $j; ?>_0"
                                    />
								</picture>
							</div>
						</div>
					</div>
                    <!--   MODAL   -->
                    <div class="popup-window" id="popup-eventVideo_<?= $j; ?>_0">
                        <i class="fas fa-times popup-close"></i>
                        <div id="player-eventVideo_<?= $j; ?>_0"></div>
                    </div>
				<?php endif; ?>
			</div>
        
            <!--  EVENT REMINDER  -->
			<?php if ($now_datetime < $start_datetime && $event_access && $is_access_end == false ) : // If event not started ?>
                <div class="moroz-popup" id="popup-reminder_<?= $j; ?>">
                    <div class="moroz-popup__window" data-action="send_reminder" data-event="<?= $event_id; ?>">
                        <div class="moroz-popup__close-container">
                            <div class="moroz-popup__close-btn"></div>
                        </div>
                        <div class="moroz-popup__title title-reminder"><p>НАПОМИНАЛОЧКА</p></div>
                        
                        <div class="moroz-popup__interval">
                            <p class="moroz-popup__date"><?= cut_year_dmy($start_date); ?></p>
                            <p class="moroz-popup__spacer"></p>
                            <p class="moroz-popup__date"><?= cut_year_dmy($finish_date); ?></p>
                        </div>
                        
                        <div class="moroz-popup__time">
                            <p>В <?= $start_time; ?></p>
                        </div>
        
                        <div class="moroz-popup__form">
                            <div class="moroz-popup__select">
                                <p>Выбери тип связи</p>
                                <picture>
                                    <source type="<?= get_template_directory_uri(); ?>/img/icons/select_down.svg" />
                                    <img src="<?= get_template_directory_uri(); ?>/img/icons/select_down.png" />
                                </picture>
                                <select data-name="contact_type">
                                    <option value="0">Выбери тип связи</option>
                                    <option value="tg">Telegram</option>
                                    <option value="vk">ВКонтакте</option>
                                </select>
                                <span class="error">!Выберите, как нам связаться с вами</span>
                            </div>
                            <?php global $current_user;
                            $user_name = $current_user->display_name; ?>
                            <input class="name-input" type="text" placeholder="Ваше имя" data-name="user_name" value="<?= $user_name; ?>">
                            <span class="error">!Введите ваше имя</span>
                            <input class="contact-input" type="text" placeholder="Ваш контакт" data-name="contact">
                            <span class="error">!Оставьте ваш контакт для связи</span>
                        </div>
        
                        <div class="moroz-popup__submit">
                            <a href="#" class="btnRed btn-big popup-submit">Отправить</a>
                            <div class="moroz-popup__loader">
                                <i class="fas fa-spinner"></i>
                            </div>
                        </div>
                    </div>
                </div>
			<?php endif; ?>
        
            <?php $j -= 1; ?>
        <?php endforeach; ?>
	
	<?php else : // If user haven't events ?>
		<div class="office-item no-items">
			<h4><?php the_field('alert_not_events'); ?></h4>
		</div>
	<?php endif; ?>
</div>

<div class="moroz-popup moroz-popup-response" id="popup-response-alt">
    <div class="moroz-popup__window">
        <div class="moroz-popup__close-container">
            <div class="moroz-popup__close-btn"></div>
        </div>
        <div class="moroz-popup__response-wrapper reminder">
            <img src="<?= get_template_directory_uri(); ?>/img/kiss.png" />
            <p class="response-main"><?php the_field('reminder_sended_text'); ?></p>
        </div>
    </div>
</div>