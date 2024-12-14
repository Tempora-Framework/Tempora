<?php
	use App\Utils\Lang;
?>

<h1>Login</h1>

<form method="POST">
	<input
		type="text"
		name="email"
		value="<?= isset($_POST["email"]) ? $_POST["email"] : "" ?>"
		placeholder="<?= Lang::translate("MAIN_EMAIL") ?>"
		require
		autofocus
	>
	<input
		type="password"
		name="password"
		value="<?= isset($_POST["password"]) ? $_POST["password"] : "" ?>"
		placeholder="<?= Lang::translate("MAIN_PASSWORD") ?>"
		require
	>

	<button type="submit"><?= Lang::translate("LOGIN_SUBMIT") ?></button>
</form>
