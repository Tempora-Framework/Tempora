<?php
use Tempora\Utils\Chronos\Chronos;
use Tempora\Utils\Chronos\Modules\ChronosCookieModule;
use Tempora\Utils\Chronos\Modules\ChronosDumpModule;
use Tempora\Utils\Chronos\Modules\ChronosEnvModule;
use Tempora\Utils\Chronos\Modules\ChronosGetModule;
use Tempora\Utils\Chronos\Modules\ChronosHttpCodeModule;
use Tempora\Utils\Chronos\Modules\ChronosLangModule;
use Tempora\Utils\Chronos\Modules\ChronosMsModule;
use Tempora\Utils\Chronos\Modules\ChronosPageDataModule;
use Tempora\Utils\Chronos\Modules\ChronosPostModule;
use Tempora\Utils\Chronos\Modules\ChronosServerModule;
use Tempora\Utils\Chronos\Modules\ChronosSessionModule;
use Tempora\Utils\Chronos\Modules\ChronosSQLModule;
use Tempora\Utils\Chronos\Modules\ChronosUserModule;

?>

<link rel="stylesheet" href="/vendor/tempora-framework/tempora/assets/styles/chronos.css">
<link rel="stylesheet" href="/vendor/tempora-framework/tempora/assets/styles/remixicon.css">
<script defer src="/vendor/tempora-framework/tempora/assets/scripts/engine.js"></script>
<script defer src="/vendor/tempora-framework/tempora/assets/scripts/chronos.js"></script>

<div class="tempora_chronos">
	<?php
		new Chronos(
			pageData: $pageData ?? [],
			modules: [
				new ChronosMsModule,
				new ChronosHttpCodeModule(httpCode: http_response_code()),
				new ChronosUserModule,
				new ChronosSQLModule,
				new ChronosDumpModule,
				new ChronosSessionModule,
				new ChronosServerModule,
				new ChronosEnvModule,
				new ChronosPageDataModule,
				new ChronosGetModule,
				new ChronosPostModule,
				new ChronosCookieModule,
				new ChronosLangModule
			]
		);
?>
</div>
