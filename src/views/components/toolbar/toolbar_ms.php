<?php
	use App\Utils\Lang;
?>

<p title="<?= Lang::translate(key: "TOOLBAR_MS_TITLE") ?>"><i class="ri-time-line"></i> <?= round(num: (microtime(as_float: true) - $GLOBALS["toolbar"]["ms_count"]) *1000, precision: 2) ?>ms</p>
