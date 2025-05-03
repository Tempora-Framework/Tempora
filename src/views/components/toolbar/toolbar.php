<?php
	use Tempora\Controllers\Toolbar;
?>

<link rel="stylesheet" href="/styles/main.css">
<link rel="stylesheet" href="/styles/toolbar.css">
<link rel="stylesheet" href="/styles/remixicon.css">
<script defer src="/scripts/engine.js"></script>
<script defer src="/scripts/toolbar.js"></script>

<div class="tempora_toolbar">
	<?php (new Toolbar)(pageData: $pageData); ?>
</div>
