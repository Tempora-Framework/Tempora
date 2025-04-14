<?php
	use App\Enums\Role;
	use App\Models\Repositories\UserRepository;
	use App\Utils\Lang;

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

	$httpCodeType = substr(http_response_code(), 0, 1);
	$httpCodeColor = "";
	if ($httpCodeType == 2)
		$httpCodeColor = "lightgreen";
	if ($httpCodeType == 3)
		$httpCodeColor = "yellow";
	if ($httpCodeType == 4 || $httpCodeType == 5)
		$httpCodeColor = "red";
?>

<link rel="stylesheet" href="/styles/main.css">
<link rel="stylesheet" href="/styles/toolbar.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css">

<div class="tempora_toolbar">
	<p class="tempora_toolbar_title"><?= Lang::translate(key: "TOOLBAR_TITLE") ?></p>

	<p title="<?= Lang::translate(key: "TOOLBAR_MS_TITLE") ?>"><i class="ri-time-line"></i> <?= round(num: (microtime(as_float: true) - $GLOBALS["toolbar"]["ms_count"]) *1000, precision: 2) ?>ms</p>

	<p title="<?= Lang::translate(key: "TOOLBAR_HTTP_CODE_TITLE") ?>" style="font-weight:bold;color:<?= $httpCodeColor ?>"><i class="ri-code-line"></i> <?= http_response_code() ?></p>

	<?php if (isset($_SESSION["user"]["uid"])) { ?>
		<div class="tempora_toolbar_drop_container">
			<p class="tempora_toolbar_drop_hover_element" title="<?= Lang::translate(key: "TOOLBAR_USER_TITLE") ?>"><i class="ri-user-line"></i> <?= $userInfo["email"] ?></p>
			<div class="tempora_toolbar_drop_element">
				<table>
					<tr>
						<td>UID</td>
						<td><?= $_SESSION["user"]["uid"] ?></td>
					</tr>
					<tr>
						<td>Session timeout</td>
						<td><?= ini_get(option: "session.gc_maxlifetime") ?> s</td>
					</tr>
					<tr>
						<td><?= Lang::translate(key: "MAIN_EMAIL") ?></td>
						<td><?= $userInfo["email"] ?></td>
					</tr>
					<tr>
						<td><?= Lang::translate(key: "MAIN_NAME") ?></td>
						<td><?= $userInfo["name"] ?></td>
					</tr>
					<tr>
						<td><?= Lang::translate(key: "MAIN_SURNAME") ?></td>
						<td><?= $userInfo["surname"] ?></td>
					</tr>
					<tr>
						<td><?= Lang::translate(key: "MAIN_ROLE") ?></td>
						<td><?= join(array: $roleFormat, separator: ", ") ?></td>
					</tr>
				</table>
			</div>
		</div>
	<?php } ?>

	<div class="tempora_toolbar_drop_container">
		<p class="tempora_toolbar_drop_hover_element" title="<?= Lang::translate(key: "TOOLBAR_SQL_TITLE") ?>"><i class="ri-database-2-line"></i> <?= $GLOBALS["toolbar"]["sql_count"] - $toolbarSQLCount ?></p>
		<div class="tempora_toolbar_drop_element">
			<table>
				<?php foreach ($GLOBALS["toolbar"]["sql_query"] as $query) { ?>
					<tr>
						<td><?= $query ?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>

	<div class="tempora_toolbar_drop_container">
		<p class="tempora_toolbar_drop_hover_element" title="<?= Lang::translate(key: "TOOLBAR_PAGEDATA_TITLE") ?>"><i class="ri-folder-2-line"></i> <?= count(value: $pageData) ?></p>
		<div class="tempora_toolbar_drop_element">
			<table>
				<?php foreach ($pageData as $key => $value) { ?>
					<tr>
						<td><?= $key ?></td><td><?= is_array($value) ? join(separator: ", ", array: $value) : $value ?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>

	<div class="tempora_toolbar_drop_container">
		<p class="tempora_toolbar_drop_hover_element" title="<?= Lang::translate(key: "TOOLBAR_GET_TITLE") ?>"><i class="ri-corner-down-left-line"></i> <?= count(value: $_GET) ?></p>
		<div class="tempora_toolbar_drop_element">
			<table>
				<?php foreach ($_GET as $key => $value) { ?>
					<tr>
						<td><?= $key ?></td><td><?= $value ?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>

	<div class="tempora_toolbar_drop_container">
		<p class="tempora_toolbar_drop_hover_element" title="<?= Lang::translate(key: "TOOLBAR_POST_TITLE") ?>"><i class="ri-mail-line"></i> <?= count(value: $_POST) ?></p>
		<div class="tempora_toolbar_drop_element">
			<table>
				<?php foreach ($_POST as $key => $value) { ?>
					<tr>
						<td><?= $key ?></td><td><?= $value ?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>

	<div class="tempora_toolbar_drop_container">
		<p class="tempora_toolbar_drop_hover_element" title="<?= Lang::translate(key: "TOOLBAR_COOKIE_TITLE") ?>"><i class="ri-cake-3-line"></i> <?= count(value: $_COOKIE) ?></p>
		<div class="tempora_toolbar_drop_element">
			<table>
				<?php foreach ($_COOKIE as $key => $value) { ?>
					<tr>
						<td><?= $key ?></td><td><?= $value ?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>

	<div class="tempora_toolbar_drop_container">
		<?php
			$total = $GLOBALS["toolbar"]["lang_count"] +1;
			$rest = $total - $GLOBALS["toolbar"]["lang_error_count"];
		?>

		<p class="tempora_toolbar_drop_hover_element" <?= (($total - $rest) > 0) ? " style='color:red'" : "" ?> title="<?= Lang::translate(key: "TOOLBAR_LANG_TITLE") ?>"><i class="ri-global-line"></i> <?= $rest ?>/<?= $total ?></p>
		<div class="tempora_toolbar_drop_element">
			<table>
				<?php
					ksort($GLOBALS["toolbar"]["langs"]);
					foreach ($GLOBALS["toolbar"]["langs"] as $key => $value) {
				?>
					<tr>
						<td <?= $value === "Missing entry" ? " style='color:red'" : "" ?>><?= $key ?></td>
						<td <?= $value === "Missing entry" ? " style='color:red'" : "" ?>><?= $value ?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>
