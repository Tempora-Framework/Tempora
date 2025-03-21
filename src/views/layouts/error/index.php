<?php
	use App\Configs\Path;
?>

<h1><?= $pageData["error_code"] ?></h1>

<p><?= $pageData["error_message"] ?></p>

<?php
	$backPath = "/";
	include Path::COMPONENTS . "/actions/back_button.php";
?>
