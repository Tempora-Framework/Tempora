<?php
	use App\Utils\Lang;
?>

<form class="login" method="POST">
	<h1><?= Lang::translate("LOGIN_TITLE") ?></h1>

	<input
		type="text"
		name="email"
		value="<?= isset($_POST["email"]) ? $_POST["email"] : "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_EMAIL") ?>"
		require
		autofocus
	>
	<input
		type="password"
		name="password"
		value="<?= isset($_POST["password"]) ? $_POST["password"] : "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_PASSWORD") ?>"
		require
	>

	<button type="submit"><?= Lang::translate(key: "LOGIN_SUBMIT") ?></button>
</form>
