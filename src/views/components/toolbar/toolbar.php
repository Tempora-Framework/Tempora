<?php
	use Tempora\Controllers\Toolbar;
?>

<link rel="stylesheet" href="/vendor/tempora-framework/tempora/assets/styles/toolbar.css">
<link rel="stylesheet" href="/vendor/tempora-framework/tempora/assets/styles/remixicon.css">
<script defer src="/vendor/tempora-framework/tempora/assets/scripts/engine.js"></script>
<script defer src="/vendor/tempora-framework/tempora/assets/scripts/toolbar.js"></script>

<div class="tempora_toolbar">
	<?php (new Toolbar)(pageData: $pageData); ?>
</div>
