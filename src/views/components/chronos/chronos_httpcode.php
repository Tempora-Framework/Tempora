<?php
use Tempora\Utils\Lang;

$httpCodeType = substr(string: http_response_code(), offset: 0, length: 1);
$httpCodeClass = match ($httpCodeType) {
	"1" => "blue",
	"2" => "green",
	"3" => "yellow",
	"4", "5" => "red"
};
?>

<div class="tempora_chronos_drop_container">
	<p class="tempora_chronos_drop_hover_element <?= $httpCodeClass ?> bold" title="<?= Lang::translate(key: "CHRONOS_HTTP_CODE_TITLE") ?>"><i class="ri-code-line"></i> <?= http_response_code() ?></p>
	<div class="tempora_chronos_drop_element">
		<h1><?= Lang::translate(key: "CHRONOS_HTTP_CODE_TITLE") ?></h1>
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
				<td><?= $pageData["page_name"] ?? "" ?></td>
			</tr>
		</table>
	</div>
</div>
