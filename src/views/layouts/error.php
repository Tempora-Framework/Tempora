<?php
$severity = "";

try {
	switch ($exception->getSeverity()) {
		case E_ERROR:
		case E_CORE_ERROR:
		case E_COMPILE_ERROR:
		case E_USER_ERROR:
		case E_RECOVERABLE_ERROR:
			$severity = "Fatal Error";

			break;
		case E_WARNING:
		case E_CORE_WARNING:
		case E_COMPILE_WARNING:
		case E_USER_WARNING:
			$severity = "Warning";

			break;
		case E_PARSE:
			$severity = "Parse Error";

			break;
		case E_NOTICE:
		case E_USER_NOTICE:
			$severity = "Notice";

			break;
		case E_STRICT:
			$severity = "Strict Notice";

			break;
		case E_DEPRECATED:
		case E_USER_DEPRECATED:
			$severity = "Deprecated";

			break;
		default:
			$severity = "Unknown Error";

			break;
	}
} catch (Throwable $e) {
	$severity = "Exception";
}
?>

<div class="tempora_error_container" id="tempora_error_container">
	<div class="tempora_error" id="tempora_error">
		<i class="ri-close-large-line" id="close"></i>
		<div class="header">
			<p class="title">[<?= $severity ?>] <?= explode(separator: "Stack trace:", string: $exception->getMessage())[0] ?></p>
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

if (count(value: $stackTrace) === 1) {
	?>
				<code class="file_container">
					<p class="trace_info">No file information available.</p>
				</code>
			<?php
}

foreach ($stackTrace as $key => $trace) {
	if (isset($trace["file"])) {
		?>
				<code class="file_container">
					<p class="file"><i class="ri-arrow-<?= $key > 0 ? "down" : "up" ?>-s-line chronos_show_more"></i> <i class="ri-code-line"></i> <?= $trace["file"] ?? "" ?></p>
				<?php
				foreach (file(filename: $trace["file"]) as $number => $line) {
					if ($number < ($trace["line"] - 1) + 5 && $number > ($trace["line"] - 1) - 5) {
						?>
					<div class="line <?= $key > 0 ? "hidden" : "" ?>">
						<p class="line_number"><?= ($number + 1) ?></p>
						<p class="code_content <?= ($trace["line"] - 1) == $number ? "selected" : "" ?>"><?= str_replace(search: "\t", replace: '<span class="tab"></span>', subject: htmlspecialchars(string: $line)) ?></p>
					</div>
				<?php
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
