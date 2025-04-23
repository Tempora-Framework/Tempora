<?php
	use App\Utils\Lang;
?>

<div class="tempora_toolbar_drop_container">
	<?php
		$total = $GLOBALS["toolbar"]["lang_count"] +1;
		$rest = $total - $GLOBALS["toolbar"]["lang_error_count"];
	?>

	<p class="tempora_toolbar_drop_hover_element" <?= (($total - $rest) > 0) ? " style='color:red'" : "" ?> title="<?= Lang::translate(key: "TOOLBAR_LANG_TITLE") ?>"><i class="ri-global-line"></i> <?= $rest ?>/<?= $total ?></p>
	<div class="tempora_toolbar_drop_element">
		<h1><?= Lang::translate(key: "TOOLBAR_LANG_TITLE") ?></h1>
		<table>
			<?php
				ksort(array: $GLOBALS["toolbar"]["langs"]);
				foreach ($GLOBALS["toolbar"]["langs"] as $key => $value) {
			?>
				<tr <?= str_contains(haystack: $key, needle: "TOOLBAR_") ? "style='font-style:italic'" : "" ?>>
					<td <?= $value === "Missing entry" ? " style='color:red'" : "" ?>><?= $key ?></td>
					<td <?= $value === "Missing entry" ? " style='color:red'" : "" ?>><?= $value ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
