<?php
use Tempora\Utils\Lang;

$lang = new Lang(filePath: "chronos/chronos", source: TEMPORA_DIR . "/src/assets");

?>

<div class="tempora_chronos_drop_container title" id="tempora_chronos_title">
	<p class="tempora_chronos_drop_hover_element bold tempora_chronos_title" title="<?= $lang->translate(key: "CHRONOS_TITLE") ?>"><img src="/vendor/tempora-framework/tempora/assets/images/chronos.png"></img></p>
</div>
