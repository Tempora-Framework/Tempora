<?php
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Lang;

$tab = (new ElementBuilder)
	->setElement(element: "span")
	->setAttributs(attributs: ["class" => "tab"])
	->build()
;
?>

<?php if ($GLOBALS["chronos"]["dumps"] != []) { ?>
	<div class="tempora_chronos_drop_container">
		<p class="tempora_chronos_drop_hover_element yellow" title="<?= Lang::translate(key: "CHRONOS_DUMPS_TITLE") ?>"><i class="ri-crosshair-2-line"></i> <?= count(value: $GLOBALS["chronos"]["dumps"]) ?></p>
		<div class="tempora_chronos_drop_element">
			<h1><?= Lang::translate(key: "CHRONOS_DUMPS_TITLE") ?></h1>
			<table class="chronos_dumps" cellpadding="0" cellspacing="0">
				<?php
					foreach ($GLOBALS["chronos"]["dumps"] as $value) {
						$result = "";
						if (is_array($value["variable"]) || is_object(value: $value["variable"])) {
							$result = explode(separator: "\n", string: print_r($value["variable"], true));
							foreach ($result as $key => $line) {
								$result[$key] = "<br>" . $tab . htmlspecialchars(string: $line);
							}
							$result = implode($result);
						} else {
							$result = $value["variable"];
						}
						?>
					<tr>
						<td class="min_col"><?= $value["trace"] ?></td>
						<td class="min_col mono"><?= print_r($result, true) ?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
<?php } ?>
