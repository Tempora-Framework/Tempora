<?php
	use App\Enums\Path;
	use App\Utils\Lang;
?>

<div class="login_reset_container">
	<h1><?= Lang::translate(key: "LOGIN_RESET_TITLE") ?></h1>

	<?php include Path::COMPONENT_FORMS->value . "/login_reset_form.php"; ?>
</div>
