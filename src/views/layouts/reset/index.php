<?php
	use App\Enums\Path;
?>

<h1>Reset</h1>

<?php
	$oldPassword = false;
	include Path::COMPONENT_FORMS->value . "/update_password_form.php";
?>
