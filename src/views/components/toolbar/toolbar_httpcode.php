<?php
	use App\Utils\Lang;

	$httpCodeType = substr(http_response_code(), 0, 1);
	$httpCodeClass = "";
	if ($httpCodeType == 2)
		$httpCodeClass = "green";
	if ($httpCodeType == 3)
		$httpCodeClass = "yellow";
	if ($httpCodeType == 4 || $httpCodeType == 5)
		$httpCodeClass = "red";
?>

<div class="tempora_toolbar_drop_container">
	<p class="tempora_toolbar_drop_hover_element <?= $httpCodeClass ?> bold" title="<?= Lang::translate(key: "TOOLBAR_HTTP_CODE_TITLE") ?>"><i class="ri-code-line"></i> <?= http_response_code() ?></p>
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
			<tr>
				<td><?= Lang::translate(key: "MAIN_NAME_OBJECT") ?></td>
				<td><?= $pageData["page_name"] ?></td>
			</tr>
		</table>
	</div>
</div>
