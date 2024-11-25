<h1>Index</h1>
<?php
	use App\Configs\Database;
	use App\Utils\Lang;
	use App\Utils\System;

	$temp = "Test";
	echo Lang::translate(
		key: "NAME",
		options: [
			"name" => $temp,
			"surname" => "Test"
		]
	);
	echo "<br>" . System::uidGen(16, Database::USERS);
?>
