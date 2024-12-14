<h1>Index</h1>
<?php
	use App\Utils\Lang;

	$temp = "Test";
	echo Lang::translate(
		key: "NAME",
		options: [
			"name" => $temp,
			"surname" => "Test"
		]
	);
?>
