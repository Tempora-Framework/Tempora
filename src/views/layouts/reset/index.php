<?php
	use Tempora\Enums\Path;
?>

<div class="reset_password_container">
	<h1>Reset</h1>

	<?php
		$oldPassword = false;
		include Path::COMPONENT_FORMS->value . "/update_password_form.php";
	?>
</div>
