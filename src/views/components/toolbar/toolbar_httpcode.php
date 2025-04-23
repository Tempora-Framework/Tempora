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

<div class="tempora_toolbar_drop_container">
	<p class="tempora_toolbar_drop_hover_element" title="<?= Lang::translate(key: "TOOLBAR_HTTP_CODE_TITLE") ?>" style="font-weight:bold;color:<?= $httpCodeColor ?>"><i class="ri-code-line"></i> <?= http_response_code() ?></p>
	<div class="tempora_toolbar_drop_element">
		<h1><?= Lang::translate(key: "TOOLBAR_HTTP_CODE_TITLE") ?></h1>
		<table>
			<tr>
				<td>Request method</td>
				<td><?= $_SERVER["REQUEST_METHOD"] ?></td>
			</tr>
			<tr>
				<td>Request URI</td>
				<td><?= $_SERVER["REQUEST_URI"] ?></td>
			</tr>
		</table>
	</div>
</div>
