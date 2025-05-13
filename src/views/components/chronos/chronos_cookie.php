<?php
	use Tempora\Utils\Lang;
?>

<div class="tempora_chronos_drop_container">
	<p class="tempora_chronos_drop_hover_element" title="<?= Lang::translate(key: "CHRONOS_COOKIE_TITLE") ?>"><i class="ri-cake-3-line"></i> <?= count(value: $_COOKIE) ?></p>
	<div class="tempora_chronos_drop_element">
		<h1><?= Lang::translate(key: "CHRONOS_COOKIE_TITLE") ?></h1>
		<table>
			<?php foreach ($_COOKIE as $key => $value) { ?>
				<tr>
					<td><?= $key ?></td>
					<td><?= $value ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
