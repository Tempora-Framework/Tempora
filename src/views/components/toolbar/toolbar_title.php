<?php
	use App\Utils\GitHub;
	use App\Utils\Lang;
?>

<div class="tempora_toolbar_drop_container">
	<p class="tempora_toolbar_drop_hover_element" style="font-weight:bold;" title="<?= Lang::translate(key: "TOOLBAR_TITLE") ?>"><?= Lang::translate(key: "TOOLBAR_TITLE") ?></p>
	<div class="tempora_toolbar_drop_element">
		<table>
			<tr>
				<td><i class="ri-time-line"></i> Tempora</td>
				<td>v<?= TEMPORA_VERSION ?></td>
			</tr>
			<?php if (is_dir(filename: BASE_DIR . "/.git")) { ?>
				<tr>
					<td>Git branch</td>
					<td><a href="https://github.com/SkyWors/Tempora/tree/<?= GitHub::getBranch() ?>" target="_blank"><?= GitHub::getBranch() ?> <i class="ri-external-link-line"></i></a></td>
				</tr>
				<tr>
					<td>Git commit</td>
					<td><a href="https://github.com/SkyWors/Tempora/tree/<?= GitHub::getCommit() ?>" target="_blank"><?= GitHub::getCommit() ?> <i class="ri-external-link-line"></i></a></td>
				</tr>
			<?php } ?>
			<tr>
				<td>Memory usage</td>
				<td><?= round(num: memory_get_usage() / 1048576, precision: 2) ?>M</td>
			</tr>
			<tr>
				<td>Memory limit</td>
				<td><?= ini_get(option: "memory_limit") ?></td>
			</tr>
		</table>
	</div>
</div>
