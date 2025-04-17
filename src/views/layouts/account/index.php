<?php
	use App\Enums\Path;
	use App\Utils\Lang;
?>

<div class="account_container">
	<h1><?= Lang::translate(key: "ACCOUNT_TITLE") ?></h1>

	<?php include Path::COMPONENT_FORMS->value . "/update_password_form.php"; ?>
</div>
