<?php
/*
Template Name: Отзывы
Template Post Type: page
*/
?>

<?php get_header();?>
<main>
	<section id="page" class="reviews">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reviews.css">
		<svg class="unionLong" viewBox="0 0 2047 12227">
			<path fill-rule="evenodd" clip-rule="evenodd"
				d="M212.384 1526.47L212 1526L212.384 1525.66V1525.59H212.459L466.004
				1300.64L160 1026.77V12227H0V824H158.172L158.884 823.363L159.588
				824H160V824.372L577.481 1201.73L1931.94 0L2046.84 102.842L697.657
				1310.36L935.321 1525.18L934.899 1525.59H936.153V1668.71H212.384V1526.47ZM457.166
				1525.59H717.354L587.26 1409.16L457.166 1525.59Z" fill="white"/>
		</svg>
		<div class="bg bg_dark bg_contain bg_custom">
			<div class="container container_full">
				<div class="reviewsContent">
					<h3 class="H3 H3_top">Самые честные</h3>
					<h1>Отзывы</h1>
                    <?php if (have_rows('review')) : ?>
                        <?php while (have_rows('review')) : the_row();
                            $link = get_sub_field('link');
                            if ($link) {
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
                            }
                            $image = get_sub_field('image');
                            $content = get_sub_field('content'); ?>

                            <div class="review">
                                <div class="review__img">
                                    <img src="<?= $image; ?>">
                                    <a class="text" href="<?= esc_url( $link_url ); ?>"
                                       target="<?= esc_attr( $link_target ); ?>">
                                        <?= esc_html( $link_title ); ?>
                                    </a>
                                </div>
                                <div class="reviewsContent__main">
									<?= $content; ?>
                                </div>
                            </div>
                        
                        <?php endwhile; ?>
                    <?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer();?>