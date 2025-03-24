<?php
	use App\Utils\Lang;
	use App\Utils\System;
?>

<form class="register" method="POST">
	<?= System::createCSRF() ?>

	<h1><?= Lang::translate(key: "REGISTER_TITLE") ?></h1>

	<input
		type="text"
		name="name"
		value="<?= $pageData["form_name"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_NAME") ?>"
		required
		autofocus
	>
	<input
		type="text"
		name="surname"
		value="<?= $pageData["form_surname"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_SURNAME") ?>"
		required
	>
	<input
		type="text"
		name="email"
		value="<?= $pageData["form_email"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_EMAIL") ?>"
		required
	>
	<input
		type="password"
		name="password"
		value="<?= $pageData["form_password"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_PASSWORD") ?>"
		required
	>
	<input
		type="password"
		name="password_confirm"
		value="<?= $pageData["form_password_confirm"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "REGISTER_PASSWORD_CONFIRM") ?>"
		required
	>

	<button type="submit"><?= Lang::translate(key: "REGISTER_SUBMIT") ?></button>
</form>
