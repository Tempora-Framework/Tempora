<?php
	use Tempora\Enums\Path;
	use Tempora\Utils\Lang;
?>

<div class="register_container">
	<h1><?= Lang::translate(key: "REGISTER_TITLE") ?></h1>

	<?php include Path::COMPONENT_FORMS->value . "/register_form.php"; ?>
</div>
