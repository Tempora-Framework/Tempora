<?php
	use App\Utils\Lang;
	use App\Utils\System;
?>

<form method="POST">
	<?= System::createCSRF() ?>

	<h1><?= Lang::translate(key: "LOGIN_RESET_TITLE") ?></h1>

	<input
		type="text"
		name="email"
		value="<?= $pageData["form_email"] ?? "" ?>"
		placeholder="<?= Lang::translate(key: "MAIN_EMAIL") ?>"
		required
		autofocus
	>

	<button type="submit"><?= Lang::translate(key: "LOGIN_RESET_PASSWORD") ?></button>
</form>
