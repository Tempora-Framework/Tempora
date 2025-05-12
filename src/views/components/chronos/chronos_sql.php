<?php
	use Tempora\Utils\Lang;
?>

<?php
	$tempSQL = [];
	$tempSQLCount = 0;
	foreach ($GLOBALS["chronos"]["sql_query"] as $value) {
		if (in_array(needle: $value["query"], haystack: $tempSQL)) {
			$tempSQLCount++;
		} else {
			array_push($tempSQL, $value["query"]);
		}
	}
?>

<div class="tempora_chronos_drop_container">
	<p class="tempora_chronos_drop_hover_element <?= ($tempSQLCount > 0 ? " yellow" : "") ?>" title="<?= Lang::translate(key: "CHRONOS_SQL_TITLE") ?>"><i class="ri-database-2-line"></i> <?= $GLOBALS["chronos"]["sql_count"] - $chronosSQLCount ?> <?= ($tempSQLCount > 0 ? "(" . $tempSQLCount . "<i class=\"ri-arrow-up-double-line\"></i>)" : "") ?></p>
	<div class="tempora_chronos_drop_element">
		<h1><?= Lang::translate(key: "CHRONOS_SQL_TITLE") ?></h1>
		<table class="chronos_sql" cellpadding="0" cellspacing="0">
			<?php
				foreach ($GLOBALS["chronos"]["sql_query"] as $value) {
			?>
				<tr>
					<td class="min_col"><?= $value["time"] ?>ms</td>
					<td class="min_col"><?= $value["class"] ?></td>
					<td class="min_col"><?= $value["function"] ?>()</td>
					<td class="min_col">Line <?= $value["line"] ?></td>
					<td><?= $value["query"] ?></td>
				</tr>
			<?php
				}
			?>
		</table>
	</div>
</div>
