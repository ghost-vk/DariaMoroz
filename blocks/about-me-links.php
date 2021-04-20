<h3 class="H3 H3_bot H3_desktop"><?= the_field('about_me_section_name'); ?></h3>
<h3 class="H3 H3_top H3_mobile"><?= the_field('about_me_section_name'); ?></h3>

<?php for ($i = 1; $i < 6; $i += 1) : ?>
	<?php $link = get_field("about_me_link_" . $i);
	if ($link) {
		$link_url = $link['url'];
		$link_title = $link['title'];
		$link_target = $link['target'] ? $link['target'] : '_self';
	} else {
	    $link = get_field("about_me_link_" . $i, 33); // Home page about me links
        if ( $link ) {
			$link_url = $link['url'];
			$link_title = $link['title'];
			$link_target = $link['target'] ? $link['target'] : '_self';
        }
    }
	?>
	<a href="<?= $link_url; ?>" class="textDefault" target="<?= $link_target ?>"><?= $link_title ?></a>
	<?php if ($i !== 5) : // Don't show separator on the last element ?>
		<div class="skill__redline"></div>
	<?php endif; ?>
<?php endfor; ?>