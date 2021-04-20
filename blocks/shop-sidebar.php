<?php global $page_id; ?>
<div class="sidebarCats">
	<div class="sidebarCats__opener" id="catsOpener">
		<picture>
			<source type="image/svg+xml" srcset="<?= get_template_directory_uri(); ?>/img/icons/cats_opener.svg" />
			<img src="<?= get_template_directory_uri(); ?>/img/icons/cats_opener.png" />
		</picture>
	</div>

    <div class="sidebarCats__closer hidden" id="catsCloser">
        <picture>
            <source type="image/svg+xml" srcset="<?= get_template_directory_uri(); ?>/img/icons/cats_closer.svg" />
            <img src="<?= get_template_directory_uri(); ?>/img/icons/cats_closer.png" />
        </picture>
    </div>
	
	<div class="sidebarCats__window" id="catsWindow">
        <?php for ( $i = 1; $i < 3; $i += 1 ) : ?>
        
			<?php $group = get_field('sidebar_' . $i, $page_id); ?>
			<?php if ( !empty($group) ) : ?>
                <div class="sidebarCats__group">
                    <span><?= $group['name']; ?></span>
					<?php $categories = $group['categories']; ?>
			
					<?php if ( !empty($categories) ) : ?>
                        <ul>
                            <?php $current_url = get_full_url( $_SERVER ); ?>
							<?php foreach ( $categories as $cat_id ) : ?>
								<?php
                                $cat_term = get_term_by( 'id', $cat_id['cat'], 'product_cat' );
                                $url = home_url('/mpower_wear/?category=' . $cat_term->slug);
                                $class = ( $current_url === $url ) ? 'text-red' : '';
                                ?>
                                <li><a href="<?= $url; ?>" class="text-gray-2 <?= $class; ?>"><?= $cat_term->name; ?></a></li>
							<?php endforeach; ?>
                        </ul>
					<?php endif; ?>

                </div>
			<?php endif; ?>
        
        <?php endfor; ?>
		
	</div>
</div>