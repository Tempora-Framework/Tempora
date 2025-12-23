<h1><?= $pageData["error_code"] ?? 500 ?></h1>
<h2><?= htmlspecialchars(string: $pageData["error_message"] ?? "An unexpected error occurred.") ?></h2>

<p><?= $pageLang->translate(key: "ERROR_DEFAULT_MESSAGE") ?></p>

<div class="tile code_block">
	<code>
		<pre><span class="blue">namespace</span> <span class="pale_green">App\Controllers</span>;

<span class="blue">use</span> <span class="pale_green">Tempora</span>\Controllers\Controller;

<span class="blue">class</span> <span class="pale_green">ErrorController</span> <span class="brown">extends</span> <span class="pale_green">Controller</span> <span class="yellow">{</span>
	<span class="brown">public</span> <span class="blue">function</span> <span class="brown">render</span><span class="yellow">()</span></span>: <span class="blue">void</span> <span class="yellow">{</span>
		<span class="green">// <?= $pageLang->translate(key: "CONTROLLER_COMMENT") ?></span>
	<span class="yellow">}</span>
<span class="yellow">}</span></pre>
	</code>
</div>

<div class="controls">
	<a href="/"><?= $pageLang->translate(key: "BACK") ?></a>
	<a href="https://tempora.erickpaoletti.fr/documentation" target="_blank" class="secondary"><?= $pageLang->translate(key: "DOCUMENTATION") ?></a>
</div>
