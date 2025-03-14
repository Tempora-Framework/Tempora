<?php
	use App\Utils\Lang;
?>

<form class="register" method="POST">
	<h1><?= Lang::translate(key: "REGISTER_TITLE") ?></h1>

	<input
		type="text"
		name="name"
		value="<?= $_POST["name"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_NAME") ?>"
		require
		autofocus
	>
	<input
		type="text"
		name="surname"
		value="<?= $_POST["surname"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_SURNAME") ?>"
		require
	>
	<input
		type="text"
		name="email"
		value="<?= $_POST["email"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_EMAIL") ?>"
		require
	>
	<input
		type="password"
		name="password"
		value="<?= $_POST["password"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_PASSWORD") ?>"
		require
	>
	<input
		type="password"
		name="password_confirm"
		value="<?= $_POST["password_confirm"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "REGISTER_PASSWORD_CONFIRM") ?>"
		require
	>

	<button type="submit"><?= Lang::translate(key: "REGISTER_SUBMIT") ?></button>
</form>
