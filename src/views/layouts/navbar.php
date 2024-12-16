<?php
	use App\Configs\Path;
	use App\Configs\Role;
	use App\Models\Repositories\UserRepository;
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

<?php if (!empty(array_intersect(UserRepository::getRoles(uid: $_SESSION["user"]["uid"]), [Role::ADMINISTRATOR]))) { ?>

	<div class="item">
		<a href="/dashboard"><?= Lang::translate(key: "NAVBAR_DASHBOARD") ?></a>
	</div>

<?php } ?>

	<div class="item">
		<a href="/disconnect"><?= Lang::translate(key: "NAVBAR_DISCONNECT") ?></a>
	</div>

<?php } ?>

	<div class="item">
		<?php include Path::COMPONENTS . "/actions/lang_selection.php"; ?>
	</div>
</nav>
