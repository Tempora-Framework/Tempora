<?php
	use App\Utils\Lang;
?>

<div class="item">
	<a class="<?= $element["class"] ?>" href="<?= $element["url"] ?>" title="<?= $element["title"] ?>"><i class="<?= $element["icon"] ?>"></i> <?= Lang::translate(key: $element["title"]) ?></a>
</div>
