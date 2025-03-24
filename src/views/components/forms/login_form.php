<?php
	use App\Utils\Lang;
	use App\Utils\System;
?>

<form class="login" method="POST">
	<?= System::createCSRF() ?>

	<h1><?= Lang::translate(key: "LOGIN_TITLE") ?></h1>

	<input
		type="text"
		name="email"
		value="<?= $pageData["form_email"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_EMAIL") ?>"
		required
		autofocus
	>
	<input
		type="password"
		name="password"
		value="<?= $pageData["form_password"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_PASSWORD") ?>"
		required
	>

	<button type="submit"><?= Lang::translate(key: "LOGIN_SUBMIT") ?></button>
</form>
