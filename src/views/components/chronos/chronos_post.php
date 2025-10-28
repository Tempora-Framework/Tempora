<?php
use Tempora\Utils\Lang;

?>

<div class="tempora_chronos_drop_container">
	<p class="tempora_chronos_drop_hover_element" title="<?= Lang::translate(key: "CHRONOS_POST_TITLE") ?>"><i class="ri-mail-line"></i> <?= count(value: $_POST) ?></p>
	<div class="tempora_chronos_drop_element">
		<h1><?= Lang::translate(key: "CHRONOS_POST_TITLE") ?></h1>
		<table>
			<?php foreach ($_POST as $key => $value) { ?>
				<tr>
					<td><?= $key ?></td>
					<td><?php print_r(value: $value); ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
