<?php
use Tempora\Utils\Lang;

?>

<div class="tempora_chronos_drop_container">
	<p class="tempora_chronos_drop_hover_element" title="<?= Lang::translate(key: "CHRONOS_SERVER_TITLE") ?>"><i class="ri-server-line"></i> <?= count(value: $_SERVER) ?></p>
	<div class="tempora_chronos_drop_element">
		<h1><?= Lang::translate(key: "CHRONOS_SERVER_TITLE") ?></h1>
		<table>
			<?php foreach ($_SERVER as $key => $value) { ?>
				<tr>
					<td><?= $key ?></td>
					<td><?php print_r(value: htmlspecialchars(string: $value)); ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
