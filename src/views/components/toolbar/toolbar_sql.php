<?php
	use Tempora\Utils\Lang;
?>

<div class="tempora_toolbar_drop_container">
	<p class="tempora_toolbar_drop_hover_element" title="<?= Lang::translate(key: "TOOLBAR_SQL_TITLE") ?>"><i class="ri-database-2-line"></i> <?= $GLOBALS["toolbar"]["sql_count"] - $toolbarSQLCount ?></p>
	<div class="tempora_toolbar_drop_element">
		<h1><?= Lang::translate(key: "TOOLBAR_SQL_TITLE") ?></h1>
		<table>
			<?php
				foreach ($GLOBALS["toolbar"]["sql_query"] as $query) {
					foreach ($query as $key => $value) {
			?>
				<tr>
					<td><?= $key ?></td>
					<td><?= $value ?></td>
				</tr>
			<?php
					}
				}
			?>
		</table>
	</div>
</div>
