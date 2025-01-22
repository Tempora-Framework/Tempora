<?php
	use App\Utils\GitHub;
?>

	</main>
	<footer>
		<a href="https://github.com/SkyWors/PHP-MVC-Template/tree/<?= GitHub::getCommit() ?>" target="_blank"><i class="ri-github-fill"></i> <?= GitHub::getBranch() . " #" . substr(string: GitHub::getCommit(), offset: 0, length: 7) ?></a>
	</footer>
</body>
</html>
