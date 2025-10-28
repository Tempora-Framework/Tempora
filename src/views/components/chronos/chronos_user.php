<?php
	use Tempora\Utils\Lang;
?>

<?php if (isset($_SESSION["user"]["uid"])) { ?>
	<div class="tempora_chronos_drop_container">
		<p class="tempora_chronos_drop_hover_element" id="chronos_user_title" title="<?= Lang::translate(key: "CHRONOS_USER_TITLE") ?>"><i class="ri-user-line"></i></p>
		<div class="tempora_chronos_drop_element">
			<h1><?= Lang::translate(key: "CHRONOS_USER_TITLE") ?></h1>
			<table>
				<tr>
					<td>UID</td>
					<td><?= $_SESSION["user"]["uid"] ?></td>
				</tr>
				<tr>
					<td>Session timeout</td>
					<td id="chronos_ms"><?= ini_get(option: "session.gc_maxlifetime") ?> s</td>
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
