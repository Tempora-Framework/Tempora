<?php
	use Tempora\Controllers\Chronos;
?>

<link rel="stylesheet" href="/vendor/tempora-framework/tempora/assets/styles/chronos.css">
<link rel="stylesheet" href="/vendor/tempora-framework/tempora/assets/styles/remixicon.css">
<script defer src="/vendor/tempora-framework/tempora/assets/scripts/engine.js"></script>
<script defer src="/vendor/tempora-framework/tempora/assets/scripts/chronos.js"></script>

<div class="tempora_chronos">
	<?php (new Chronos)(pageData: $pageData ?? []); ?>
</div>
