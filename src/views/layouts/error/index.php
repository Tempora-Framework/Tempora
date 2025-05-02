<?php
	use App\Enums\Path;
	use App\Utils\Cache\Route;
?>

<h1><?= $pageData["error_code"] ?></h1>

<p><?= $pageData["error_message"] ?></p>

<?php
	$backPath = Route::getPath(name: "app_index_get");
	include Path::COMPONENT_ACTIONS->value . "/back_button.php";
?>
