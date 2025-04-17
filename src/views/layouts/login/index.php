<?php
	use App\Enums\Path;
	use App\Utils\Lang;
?>

<div class="login_container">
	<h1><?= Lang::translate(key: "LOGIN_TITLE") ?></h1>

	<?php include Path::COMPONENT_FORMS->value . "/login_form.php"; ?>
	<?php include Path::COMPONENT_ACTIONS->value . "/reset_password_button.php"; ?>
</div>
