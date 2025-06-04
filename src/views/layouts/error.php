<link rel="stylesheet" href="/vendor/tempora-framework/tempora/assets/styles/error.css">
<script defer src="/vendor/tempora-framework/tempora/assets/scripts/error.js"></script>

<div class="tempora_error_container" id="tempora_error_container">
	<div class="tempora_error" id="tempora_error">
		<i class="ri-close-large-line" id="close"></i>
		<div class="header">
			<p class="title"><?= $exception->getMessage() ?></p>
			<p><?= $exception->getFile() ?> Line <?= $exception->getLine() ?></p>
		</div>
		<div class="trace_container">
			<?php foreach ($exception->getTrace() as $key => $trace) { ?>
				<p class="trace">#<?= $key ?>	<?= $trace["file"] ?? "" ?>(<?= $trace["line"] ?? "" ?>) <i class="ri-arrow-right-long-line"></i> <?= isset($trace["class"]) ? ($trace["class"] . "::") : "" ?><?= ($trace["function"] . "()" ?? "") ?></p>
			<?php }	?>
		</div>

		<div class="separator"></div>

		<div class="file_code_container">
			<?php
				$uniqueTraces = [];
				foreach ($exception->getTrace() as $trace) {
					$key = ($trace["file"] ?? "") . ":" . ($trace["line"] ?? "");
					if (!isset($uniqueTraces[$key])) {
						$uniqueTraces[$key] = $trace;
					}
				}
				$stackTrace = array_values($uniqueTraces);

				foreach ($stackTrace as $key => $trace) {
					if (isset($trace["file"])) {
			?>
				<code class="file_container">
					<p class="file"><i class="ri-arrow-<?= $key > 0 ? "down" : "up" ?>-s-line chronos_show_more"></i> <i class="ri-code-line"></i> <?= $trace["file"] ?? "" ?></p>
				<?php
					if (isset($trace["file"])) {
						foreach (file(filename: $trace["file"]) as $number => $line) {
							if ($number < ($trace["line"] -1) +5 && $number > ($trace["line"] -1) -5) {
				?>
					<div class="line <?= $key > 0 ? "hidden" : "" ?>">
						<p class="line_number"><?= ($number + 1) ?></p>
						<p class="code_content <?= ($trace["line"] -1) == $number ? "selected" : "" ?>"><?= htmlspecialchars(string: $line) ?></p>
					</div>
				<?php
							}
						}
					}
				?>
				</code>
			<?php
					}
				}
			?>
		</div>
	</div>
</div>
