<?php
	use App\Enums\Path;
?>

<h1><?= $pageData["error_code"] ?></h1>

<p><?= $pageData["error_message"] ?></p>

<?php
	$backPath = "/";
	include Path::COMPONENT_ACTIONS->value . "/back_button.php";
?>
