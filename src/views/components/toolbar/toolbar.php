<?php
	use App\Enums\Path;
	use App\Enums\Role;
	use App\Models\Repositories\UserRepository;

	$toolbarSQLCount = 0;
	if (isset($_SESSION["user"]["uid"])) {
		$toolbarSQLCount = 2;
		$userInfo = UserRepository::getInformations(uid: $_SESSION["user"]["uid"]);

		$roleFormat = [];
		foreach (UserRepository::getRoles(uid: $_SESSION["user"]["uid"]) as $role) {
			array_push($roleFormat, Role::from(value: $role)->name);
		}

		for ($i = 0; $i < $toolbarSQLCount; $i++) {
			array_pop(array: $GLOBALS["toolbar"]["sql_query"]);
		}
	}
?>

<link rel="stylesheet" href="/styles/main.css">
<link rel="stylesheet" href="/styles/toolbar.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css">

<div class="tempora_toolbar">
	<?php include Path::COMPONENT_TOOLBAR->value . "/toolbar_title.php"; ?>
	<?php include Path::COMPONENT_TOOLBAR->value . "/toolbar_ms.php"; ?>
	<?php include Path::COMPONENT_TOOLBAR->value . "/toolbar_httpcode.php"; ?>
	<?php include Path::COMPONENT_TOOLBAR->value . "/toolbar_user.php"; ?>
	<?php include Path::COMPONENT_TOOLBAR->value . "/toolbar_sql.php"; ?>
	<?php include Path::COMPONENT_TOOLBAR->value . "/toolbar_pagedata.php"; ?>
	<?php include Path::COMPONENT_TOOLBAR->value . "/toolbar_get.php"; ?>
	<?php include Path::COMPONENT_TOOLBAR->value . "/toolbar_post.php"; ?>
	<?php include Path::COMPONENT_TOOLBAR->value . "/toolbar_cookie.php"; ?>
	<?php include Path::COMPONENT_TOOLBAR->value . "/toolbar_lang.php"; ?>
</div>
