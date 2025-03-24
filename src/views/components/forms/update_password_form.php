<?php
	use App\Utils\System;
	use App\Utils\Lang;
?>

<form class="account" method="POST">
	<?= System::createCSRF() ?>

	<input
		type="password"
		name="old_password"
		value="<?= $pageData["form_update_old_password"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_OLD_PASSWORD") ?>"
	>
	<input
		type="password"
		name="new_password"
		value="<?= $pageData["form_update_new_password"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_NEW_PASSWORD") ?>"
	>
	<input
		type="password"
		name="new_password_confirm"
		value="<?= $pageData["form_update_new_password_confirm"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_CONFIRM") ?>"
	>

	<button type="submit"><?= Lang::translate(key: "MAIN_SAVE") ?></button>
</form>
