<?php
	use Tempora\Utils\Lang;
?>

<?php
	$tempSQL = [];
	$tempSQLCount = 0;
	foreach ($GLOBALS["toolbar"]["sql_query"] as $query) {
		foreach ($query as $key => $value) {
			if (in_array(needle: $value, haystack: $tempSQL)) {
				$tempSQLCount++;
			} else {
				array_push($tempSQL, $value);
			}
		}
	}
?>

<div class="tempora_toolbar_drop_container">
	<p class="tempora_toolbar_drop_hover_element <?= ($tempSQLCount > 0 ? " yellow" : "") ?>" title="<?= Lang::translate(key: "TOOLBAR_SQL_TITLE") ?>"><i class="ri-database-2-line"></i> <?= $GLOBALS["toolbar"]["sql_count"] - $toolbarSQLCount ?> <?= ($tempSQLCount > 0 ? "(" . $tempSQLCount . "<i class=\"ri-arrow-up-double-line\"></i>)" : "") ?></p>
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
