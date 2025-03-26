<?php
	use App\Utils\Lang;
	use App\Utils\System;
?>

<form method="POST">
	<?= System::createCSRF() ?>

	<button name="reset_password" type="submit"><?= Lang::translate(key: "MAIN_PASSWORD_FORGOT") ?></button>
</form>
