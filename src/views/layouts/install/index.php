<h1>Tempora</h1>
<h2>Installation in progress</h2>

<p>Your application is almost ready.<br>Complete the remaining steps to start using Tempora.</p>

<!-- Steps -->
<section class="tile">
	<ul class="steps">

	<?php foreach ($pageData["install_needed"] as $step) { ?>
		<li class="step">
			<i class="badge ri-close-line"></i>
			<div>
			<h3><?= $pageLang->translate(key: $step["title"]) ?></h3>
			<p><?= $pageLang->translate(key: $step["message"]) ?></p>
			</div>
		</li>
	<?php } ?>

	</ul>
</section>

<div class="controls">
	<a href="/"><i class="ri-refresh-line"></i> <?= $pageLang->translate(key: "REFRESH") ?></a>
	<a href="https://tempora.erickpaoletti.fr/documentation" target="_blank" class="secondary"><i class="ri-file-search-line"></i> <?= $pageLang->translate(key: "DOCUMENTATION") ?></a>
</div>
