<link rel="stylesheet" href="/vendor/tempora-framework/tempora/assets/styles/error.css">

<div class="tempora_error_container">
	<div class="tempora_error">
		<div class="header">
			<p class="title"><?= $exception->getMessage() ?></p>
			<p><?= $exception->getFile() ?> <?= $exception->getLine() ?></p>
		</div>
		<div class="trace_container">
			<?php foreach ($exception->getTrace() as $key => $trace) { ?>
				<p class="trace">#<?= $key ?>	<?= $trace["file"] ?>(<?= $trace["line"] ?>) <?= ($trace["class"] ?? "") ?> <?= ($trace["function"] . "()" ?? "") ?></p>
			<?php }	?>
		</div>
	</div>
</div>
