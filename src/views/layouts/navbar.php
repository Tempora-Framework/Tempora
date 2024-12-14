<?php
	use App\Utils\Lang;
?>

<nav>
	<div class="item">
		<a href="/"><?= Lang::translate(key: "NAVBAR_HOME") ?></a>
	</div>

<?php if (!isset($_SESSION["user"])) { ?>
	<div class="item">
		<a href="/login"><?= Lang::translate(key: "NAVBAR_LOGIN") ?></a>
	</div>
	<div class="item">
		<a href="/register"><?= Lang::translate(key: "NAVBAR_REGISTER") ?></a>
	</div>
<?php } else { ?>
	<div class="item">
		<a href="/disconnect"><?= Lang::translate(key: "NAVBAR_DISCONNECT") ?></a>
	</div>
<?php } ?>

</nav>
