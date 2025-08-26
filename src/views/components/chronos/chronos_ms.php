<?php
	use Tempora\Utils\Lang;
?>

<p title="<?= Lang::translate(key: "CHRONOS_MS_TITLE") ?>" id="tempora_chronos_ms"><i class="ri-time-line"></i> <?= round(num: (microtime(as_float: true) - $GLOBALS["chronos"]["ms_count"]) *1000, precision: 2) ?>ms</p>
