<?php
	use App\Enums\Path;
?>

<div class="login">
	<?php include Path::COMPONENT_FORMS->value . "/login_form.php"; ?>
	<?php include Path::COMPONENT_ACTIONS->value . "/reset_password_button.php"; ?>
</div>
