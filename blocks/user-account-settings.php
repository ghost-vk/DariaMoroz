<div class="officeContent__settings tabs" id="settings">
	<h3 class="subtitleH3">Смена пароля</h3>
	<form action="" method="POST">
		<input class="password"
			   placeholder="Новый пароль"
			   name="password"
			   type="password"
			   size="30"
			   maxlength="30"
			   minlength="8"
			   required="required"
			   id="newPass">
		
		<input class="text"
			   placeholder="Повторите пароль"
			   name="password_repeat"
			   type="password"
			   maxlength="30"
			   size="30"
			   minlength="8"
			   required="required"
			   id="repeatNewPass">
		
        
        <?php if ( isset($_POST['password']) && isset($_POST['password_repeat']) ) {
			$new_password = change_user_password();
        } ?>
        
        <?php if (isset($new_password) && !empty($new_password)) : // If fired action ?>
            <?php $class = ($new_password['status'] == 'success') ? 'success' : 'error'; ?>
            <p class="<?= $class; ?>"><?= $new_password['message']; ?></p>
        <?php endif; ?>
		
		<button class="btnRed" type="submit">Сохранить</button>
	</form>
	<h3 class="subtitleH3">Выход</h3>
	<a class="btnRed" href="<?= wp_logout_url( home_url() ); ?>">Выйти из профиля</a>
</div>