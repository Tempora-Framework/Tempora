<?php
	use Tempora\Utils\Git;
?>

	</main>
	<footer>
		<a href="<?= Git::getRepoUrl() ?>/tree/<?= Git::getCommit() ?>" target="_blank"><i class="ri-github-fill"></i> <?= Git::getBranch() . " #" . substr(string: Git::getCommit(), offset: 0, length: 7) ?></a>
	</footer>
</body>
</html>
