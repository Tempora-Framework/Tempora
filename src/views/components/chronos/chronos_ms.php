<?php
use Tempora\Utils\Lang;

$time = round(num: (microtime(as_float: true) - $GLOBALS["chronos"]["ms_count"]) * 1000, precision: 2);
?>

<div class="tempora_chronos_drop_container">
	<p title="<?= Lang::translate(key: "CHRONOS_MS_TITLE") ?>" id="tempora_chronos_ms"><i class="ri-time-line"></i> <?= $time ?>ms</p>
	<div class="tempora_chronos_drop_element">
		<h1><?= Lang::translate(key: "CHRONOS_MS_TITLE") ?></h1>
		<table class="chronos_minifier" cellpadding="0" cellspacing="0">
			<tr>
				<td class="min_col"><?= APP_NAME ?></td>
				<td class="min_col"><?= $time ?>ms</td>
			</tr>
		</table>

		<h1><?= Lang::translate(key: "CHRONOS_MINIFIER_MS_TITLE") ?></h1>
		<table class="chronos_minifier" cellpadding="0" cellspacing="0">
			<?php
				foreach ($GLOBALS["chronos"]["minifier"] as $value) {
					?>
				<tr>
					<td class="min_col"><?= $value["file"] ?></td>
					<td class="min_col"><?= $value["time"] ?>ms</td>
				</tr>
			<?php
				}
?>
			<tr>
				<td class="min_col"><?= Lang::translate(key: "MAIN_TOTAL") ?></td>
				<td class="min_col"><?= array_sum(array_column(array: $GLOBALS["chronos"]["minifier"], column_key: "time")) ?>ms</td>
			</tr>
		</table>

		<h1><?= Lang::translate(key: "CHRONOS_IMAGES_MS_TITLE") ?></h1>
		<table class="chronos_minifier" cellpadding="0" cellspacing="0">
			<?php
	foreach ($GLOBALS["chronos"]["images_ms"] as $value) {
		?>
				<tr>
					<td class="min_col"><?= $value["file"] ?></td>
					<td class="min_col"><?= $value["time"] ?>ms</td>
				</tr>
			<?php
	}
?>
			<tr>
				<td class="min_col"><?= Lang::translate(key: "MAIN_TOTAL") ?></td>
				<td class="min_col"><?= array_sum(array_column(array: $GLOBALS["chronos"]["images_ms"], column_key: "time")) ?>ms</td>
			</tr>
		</table>

		<h1><?= Lang::translate(key: "CHRONOS_SQL_TITLE") ?></h1>
		<table class="chronos_minifier" cellpadding="0" cellspacing="0">
			<tr>
				<td><?= Lang::translate(key: "MAIN_TOTAL") ?></td>
				<td><?= array_sum(array_column(array: $GLOBALS["chronos"]["sql_query"], column_key: "time")) ?>ms</td>
			</tr>
		</table>
	</div>
</div>
