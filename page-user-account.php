<?php
/*
Template Name: Кабинет пользователя
Template post type: page
*/
?>

<?php
// Main settings
$user_id = get_current_user_id();
$now_datetime = new \DateTime('now');
?>

<?php get_header(); ?>
	<main>
		<section id="page" class="po">
			<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/privateoffice.css">
            <svg class="unionLong" viewBox="0 0 2047 12227">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M212.384 1526.47L212 1526L212.384 1525.66V1525.59H212.459L466.004
                    1300.64L160 1026.77V12227H0V824H158.172L158.884 823.363L159.588
                    824H160V824.372L577.481 1201.73L1931.94 0L2046.84 102.842L697.657
                    1310.36L935.321 1525.18L934.899 1525.59H936.153V1668.71H212.384V1526.47ZM457.166
                    1525.59H717.354L587.26 1409.16L457.166 1525.59Z" fill="white"
                />
		    </svg>
			<div class="bg bg_dark bg_contain bg_noRepeat">
				<div class="container container_full">
					<div class="officeContent">
						<div class="officeContent__title" id="open-menu-btn">
							<h3 class="H3 H3_bot">мой</h3>
							<h1 class="tabMobile">Личный<br>кабинет</h1>
							<span class="triang triang_mobile"></span>
						</div>
						<span class="spanMobile" id="label">Настройки</span>
						
						<!-- NAVIGATION -->
						<ul class="officeContent__nav contentMobile" id="nav-menu">
							<li class="varTabs" id="0" data-tab="courses">Курсы</li>
							<li class="varTabs" id="1" data-tab="events">Мероприятия</li>
							<li class="varTabs" id="2" data-tab="nutrition">Программы питания</li>
							<li class="varTabs" id="3" data-tab="history">История покупок</li>
							<li class="varTabs active" id="4" data-tab="settings">Настройки</li>
						</ul>
						
						<!-- COURSE -->
						<?php require_once __DIR__ . '/blocks/user-account-course.php'; ?>
						
						<!-- EVENTS -->
                        <?php require_once __DIR__ . '/blocks/user-account-events.php'; ?>
						
						<!-- NUTRITION -->
						<?php require_once __DIR__ . '/blocks/user-account-nutrition.php'; ?>
						
						<!-- HISTORY -->
						<?php require_once __DIR__ . '/blocks/user-account-history.php'; ?>
						
						<!-- SETTINGS -->
						<?php require_once __DIR__ . '/blocks/user-account-settings.php'; ?>
					
					</div>
				</div>
			</div>
			
		</section>
	</main>
<?php get_footer();?>