<?php
	use App\Utils\Lang;

	$httpCodeType = substr(http_response_code(), 0, 1);
	$httpCodeColor = "";
	if ($httpCodeType == 2)
		$httpCodeColor = "lightgreen";
	if ($httpCodeType == 3)
		$httpCodeColor = "yellow";
	if ($httpCodeType == 4 || $httpCodeType == 5)
		$httpCodeColor = "red";
?>

<p title="<?= Lang::translate(key: "TOOLBAR_HTTP_CODE_TITLE") ?>" style="font-weight:bold;color:<?= $httpCodeColor ?>"><i class="ri-code-line"></i> <?= http_response_code() ?></p>
