<?php
	use App\Utils\Lang;
?>

<div class="tempora_toolbar_drop_container">
	<p class="tempora_toolbar_drop_hover_element" title="<?= Lang::translate(key: "TOOLBAR_SESSION_TITLE") ?>"><i class="ri-database-line"></i> <?= count(value: $_SESSION) ?></p>
	<div class="tempora_toolbar_drop_element">
		<h1><?= Lang::translate(key: "TOOLBAR_SESSION_TITLE") ?></h1>
		<table>
			<?php foreach ($_SESSION as $key => $value) { ?>
				<tr>
					<td><?= $key ?></td><td><?php print_r(value: $value); ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
