<?php
	use Tempora\Utils\Git;
	use Tempora\Utils\Lang;
?>

<div class="tempora_chronos_drop_container title" id="tempora_chronos_title">
	<p class="tempora_chronos_drop_hover_element bold tempora_chronos_title" title="<?= Lang::translate(key: "CHRONOS_TITLE") ?>"><img src="/vendor/tempora-framework/tempora/assets/images/chronos.png"></img></p>
	<div class="tempora_chronos_drop_element">
		<h1><?= Lang::translate(key: "CHRONOS_TITLE") ?></h1>
		<table>
			<tr>
				<td><i class="ri-time-line"></i> Tempora</td>
				<td><?= TEMPORA_VERSION ?></td>
			</tr>
			<tr>
				<td>PHP</td>
				<td>v<?= PHP_VERSION ?></td>
			</tr>
			<tr>
				<td>Server</td>
				<td><?= PHP_OS ?> <?= $_SERVER["SERVER_SOFTWARE"] ?></td>
			</tr>
			<tr>
				<td>Memory limit</td>
				<td><?= ini_get(option: "memory_limit") ?></td>
			</tr>
			<tr>
				<td>Memory usage</td>
				<td><?= round(num: memory_get_peak_usage() / 1048576, precision: 2) ?>M</td>
			</tr>
			<?php if (is_dir(filename: APP_DIR . "/.git")) { ?>
				<tr>
					<td><?= APP_NAME ?> Git branch</td>
					<td><a href="<?= Git::getRepoUrl() ?>/tree/<?= Git::getBranch() ?>" target="_blank"><?= Git::getBranch() ?> <i class="ri-external-link-line"></i></a></td>
				</tr>
				<tr>
					<td><?= APP_NAME ?> Git commit</td>
					<td><a href="<?= Git::getRepoUrl() ?>/tree/<?= Git::getCommit() ?>" target="_blank"><?= substr(string: Git::getCommit(), offset: 0, length: 7) ?> <i class="ri-external-link-line"></i></a></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
