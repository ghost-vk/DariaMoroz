<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

	<!-- styles  main-->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
	
	<!-- styles  popup-->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/popup.min.css">

	<!-- prefetch style -->
	<link rel="prefetch" href="<?php echo get_template_directory_uri(); ?>/css/about.min.css" as="style" />
	<link rel="prefetch" href="<?php echo get_template_directory_uri(); ?>/css/onlineSchool.min.css" as="style" />
	<link rel="prefetch" href="<?php echo get_template_directory_uri(); ?>/css/activity.min.css" as="style" />
	<link rel="prefetch" href="<?php echo get_template_directory_uri(); ?>/css/travel.min.css" as="style" />
	<link rel="prefetch" href="<?php echo get_template_directory_uri(); ?>/css/nutritionPrograms.min.css" as="style" />
	<link rel="prefetch" href="<?php echo get_template_directory_uri(); ?>/css/reviews.min.css" as="style" />
	<link rel="prefetch" href="<?php echo get_template_directory_uri(); ?>/css/courseteacher.min.css" as="style" />
	<link rel="prefetch" href="<?php echo get_template_directory_uri(); ?>/css/coursetwerkout.min.css" as="style" />

	<!-- prefetch js -->
	<link rel="prefetch" src="<?php echo get_template_directory_uri(); ?>/js/sliderCard.min.js" as="script" />
	<link rel="prefetch" src="<?php echo get_template_directory_uri(); ?>/js/travelForm.min.js" as="script" />
	<link rel="prefetch" src="<?php echo get_template_directory_uri(); ?>/js/sliderAbout.min.js" as="script" />

    <!--  Yandex email  -->
    <meta name="yandex-verification" content="2d4fc99af9b0bddb" />

	<style>
			.bg_light { background-image: url(<?php echo get_template_directory_uri(); ?>/img/lightBg.jpg); }
			.bg_dark { background-image: url(<?php echo get_template_directory_uri(); ?>/img/darkBg.jpg); }
	</style>
	
	<?php _wp_render_title_tag(); ?>
    <?php wp_head(); ?>
</head>
<body>
	<header>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/header.css">
	<div class="header">
		<div class="logo">
			<div class="logo__img">
                <a href="<?= home_url(); ?>">
				    <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="logo">
                </a>
			</div>
		</div>
		<div class="header__content">
			<nav class="nav">
                <?php wp_nav_menu( [
                    'theme_location' => 'header_menu',
                    'container' => false,
					'items_wrap' => '%3$s',
                ] ); ?>
    
				<?php global $current_user; wp_get_current_user(); ?>
				<?php if ( is_user_logged_in() ) : ?>
                    <a class="nav__register_desktop poPage" href="<?php bloginfo('wpurl') ?>/privateoffice"><?php echo $current_user->user_firstname  ?></a>
                    <?php $class = (is_page('privateoffice')) ? 'active' : ''; ?>
                    <a class="nav__register_mobile poPage <?= $class; ?>" href="<?= home_url('privateoffice'); ?>">
                        <svg viewBox="0 0 23 21">
                            <path class="mobileFill" fill-rule="evenodd" clip-rule="evenodd"
                                  d="M14.6551 8.56946C15.7391 7.68051 16.4289 6.34252 16.4289 4.84613C16.4289 2.16969
                                14.2223 0 11.5003 0C8.7783 0 6.57171 2.16969 6.57171 4.84613C6.57171 6.34245 7.2614 7.68038
                                8.34526 8.56933C3.52779 10.1103 0 15.0922 0 21H23C23 15.0924 19.4724 10.1106 14.6551 8.56946Z"/>
                        </svg>
                    </a>
                <?php else : ?>
                    <a class="nav__register_desktop poPage popup-opener" href="#" data-popup="popup-login">Вход/Регистрация</a>
                    <a class="nav__register_mobile poPage popup-opener" href="#" data-popup="popup-login">
                        <svg viewBox="0 0 23 21">
                            <path class="mobileFill" fill-rule="evenodd" clip-rule="evenodd"
                                d="M14.6551 8.56946C15.7391 7.68051 16.4289 6.34252 16.4289 4.84613C16.4289 2.16969
                                14.2223 0 11.5003 0C8.7783 0 6.57171 2.16969 6.57171 4.84613C6.57171 6.34245 7.2614 7.68038
                                8.34526 8.56933C3.52779 10.1103 0 15.0922 0 21H23C23 15.0924 19.4724 10.1106 14.6551 8.56946Z"/>
                        </svg>
                    </a>
                <?php endif; ?>
				<?php $class = (is_page('cart') || is_page('checkout')) ? 'active' : ''; ?>
				<a class="nav__cart cartPage <?= $class; ?>" href="<?= wc_get_cart_url(); ?>">
					<svg viewBox="0 0 26.458333 26.458334">
						<g>
							<path
							   d="M 12.800712,0.2354687 A 5.0443428,5.9385672 0 0 0 7.7770051,5.6724686
							   C 6.9771103,5.5207609 6.1757364,5.3320989 5.3714861,5.0956641
							   L 2.7573097,26.099334 H 23.622545 L 20.64223,5.1418101
							   C 19.699479,5.3582213 18.761224,5.5320644 17.824419,5.6824986
							   A 5.0443428,5.9385672 0 0 0 12.800712,0.2354687 Z m -0.05818,1.1295324
							   a 4.0650468,4.7856689 0 0 1 4.05568,4.4800059
							   C 14.091303,6.2025971 11.399157,6.2391108 8.6908641,5.8279537
							   A 4.0650468,4.7856689 0 0 1 12.742531,1.3650011 Z"
                            />
                        </g>
                    </svg>
				</a>

				<div class="nav__btnBar nav__btnBar_close"></div>
				<div class="sidebar sidebar_close">
					<div class="sidebar__wrapper">
						<span class="sidebar__bgText">Daria<br>Moroz</span>
						<div class="sidebar__content">
							<div class="sidebar__links">
								<?php wp_nav_menu( [
									'theme_location' => 'sidebar_menu',
									'container' => false,
									'items_wrap' => '%3$s',
								]); ?>

							</div>
							<span class="sidebar__subText">Тут много крутого, заходи:</span>
							<div class="sidebar__icons">
								<a href="https://www.facebook.com/morozdia" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/facebook.png" alt="fb"></a>
								<a href="https://vk.com/morozdaria" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/vk.png" alt="vk"></a>
								<a href="https://instagram.com/moroz_dia?igshid=vxnghnfpk8pw" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/inst.png" alt="inst"></a>
								<a href="https://youtube.com/c/DariaMorozRussia" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/youtube.png" alt="yt"></a>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</div>
</header>