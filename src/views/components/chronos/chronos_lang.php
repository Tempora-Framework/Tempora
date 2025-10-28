<?php
use Tempora\Utils\Lang;

?>

<div class="tempora_chronos_drop_container">
	<?php
		$total = $GLOBALS["chronos"]["lang_count"] + 1;
$rest = $total - $GLOBALS["chronos"]["lang_error_count"];
?>

	<p class="tempora_chronos_drop_hover_element <?= (($total - $rest) > 0) ? "red" : "" ?>" title="<?= Lang::translate(key: "CHRONOS_LANG_TITLE") ?>"><i class="ri-global-line"></i> <?= $rest ?>/<?= $total ?></p>
	<div class="tempora_chronos_drop_element">
		<h1><?= Lang::translate(key: "CHRONOS_LANG_TITLE") ?></h1>
		<table>
			<?php
			ksort(array: $GLOBALS["chronos"]["langs"]);
foreach ($GLOBALS["chronos"]["langs"] as $key => $value) {
	?>
				<tr <?= str_contains(haystack: $key, needle: "CHRONOS_") ? "class='italic'" : "" ?>>
					<td <?= $value === $key ? " class='red'" : "" ?>><?= $key ?></td>
					<td <?= $value === $key ? " class='red'" : "" ?>><?= $value ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
