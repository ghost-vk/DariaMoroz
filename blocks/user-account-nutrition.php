<?php $product_ids = get_user_paid_orders( ['nutrition-programs'] ); ?>

<div class="officeContent__nutProg tabs officeContent__noActive" id="nutrition">
	<?php if ( !empty($product_ids) ): ?>
        <?php foreach ( $product_ids as $id ): ?>
            <div class="officeContent__nutProg_week">
                <h2><?php the_field('name', $id); ?></h2>
                <p class="text"><?php the_field('user_account_description', $id); ?></p>
                <?php $link = get_field('link', $id);
                if ( !empty($link) ) : // If set link ?>
                    <a class="btnRed" href="<?= $link; ?>" target="_blank">Скачать</a>
                <?php elseif ( $file_link = get_field('file', $id) ) : // If set file ?>
                    <a class="btnRed" href="<?= $file_link; ?>" target="_blank">Скачать</a>
                <?php else : // If set nothing ?>
                    <h5>Файл не найден, пожалуйста, свяжитесь с нами</h5>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="office-item no-items">
            <h4>На данный момент у вас нет купленных программ питания</h4>
        </div>
    <?php endif; ?>
</div>