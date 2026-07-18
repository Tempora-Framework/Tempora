<?php
use Tempora\Utils\Chronos\Chronos;
use Tempora\Utils\Chronos\Modules\ChronosCookieModule;
use Tempora\Utils\Chronos\Modules\ChronosDumpModule;
use Tempora\Utils\Chronos\Modules\ChronosEnvModule;
use Tempora\Utils\Chronos\Modules\ChronosGetModule;
use Tempora\Utils\Chronos\Modules\ChronosHeadersModule;
use Tempora\Utils\Chronos\Modules\ChronosHttpCodeModule;
use Tempora\Utils\Chronos\Modules\ChronosLangModule;
use Tempora\Utils\Chronos\Modules\ChronosMsModule;
use Tempora\Utils\Chronos\Modules\ChronosPageDataModule;
use Tempora\Utils\Chronos\Modules\ChronosPostModule;
use Tempora\Utils\Chronos\Modules\ChronosServerModule;
use Tempora\Utils\Chronos\Modules\ChronosSessionModule;
use Tempora\Utils\Chronos\Modules\ChronosSQLModule;
use Tempora\Utils\Chronos\Modules\ChronosTemporaModule;
use Tempora\Utils\Chronos\Modules\ChronosURLModule;
use Tempora\Utils\Chronos\Modules\ChronosUserModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;

$assetsFiles = [
	"styles/chronos.css",
	"scripts/Chronos/Chronos.js",
	"scripts/Chronos/Utils.js",
	"scripts/Chronos/Windows.js",
	"scripts/chronos.js",
];

$assets = "";
foreach ($assetsFiles as $assetFile) {
	$asset = new ElementBuilder;

	$attributs = [];
	if (str_ends_with(haystack: $assetFile, needle: ".css")) {
		$asset->setElement(element: "link");
		$attributs = [
			"rel" => "stylesheet",
			"href" => "/vendor/tempora-framework/tempora/assets/" . $assetFile
		];
	} else {
		$asset->setElement(element: "script");
		$attributs = [
			"src" => "/vendor/tempora-framework/tempora/assets/" . $assetFile,
			"defer" => ""
		];
	}

	$asset->setAttributs(attributs: $attributs);

	$assets .= $asset->build();
}
?>

<?= $assets ?>
<link href="<?= TEMPORA_REMIXICON_CSS ?>" rel="stylesheet">
<link href="<?= TEMPORA_INTER_FONT ?>" rel="stylesheet">

<div class="tempora_chronos">
	<?php
		(new Chronos(
			pageData: $pageData ?? [],
			modules: [
				new ChronosTemporaModule,
				new ChronosMsModule,
				new ChronosHttpCodeModule(httpCode: http_response_code()),
				new ChronosURLModule,
				new ChronosUserModule,
				new ChronosSQLModule,
				new ChronosDumpModule,
				new ChronosSessionModule,
				new ChronosServerModule,
				new ChronosEnvModule,
				new ChronosPageDataModule,
				new ChronosHeadersModule,
				new ChronosGetModule,
				new ChronosPostModule,
				new ChronosCookieModule,
				new ChronosLangModule
			]
		));
?>
</div>
