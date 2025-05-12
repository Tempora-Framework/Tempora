<?php
	use Tempora\Utils\Lang;
?>

<div class="tempora_chronos_drop_container">
	<p class="tempora_chronos_drop_hover_element" title="<?= Lang::translate(key: "CHRONOS_PAGEDATA_TITLE") ?>"><i class="ri-folder-2-line"></i> <?= count(value: $pageData) ?></p>
	<div class="tempora_chronos_drop_element">
		<h1><?= Lang::translate(key: "CHRONOS_PAGEDATA_TITLE") ?></h1>
		<table>
			<?php foreach ($pageData as $key => $value) { ?>
				<tr>
					<td><?= $key ?></td>
					<td><?php print_r(value: $value); ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
