<?php
	use App\Utils\ElementBuilder\ElementBuilder;
	use App\Utils\ElementBuilder\Form;
	use App\Utils\Lang;
?>

<?php
	$form = new Form;
	$form
		->setAttributs(
			attributs: [
				"method" => "POST",
				"class"	=> "login_reset"
			]
		)
		->setCsrf(csrf: true)
	;

	$input = new ElementBuilder;
	$input
		->setElement(element: "input")
		->setAttributs(
			attributs: [
				"type" => "text",
				"name" => "email",
				"value" => $pageData["form_email"] ?? "",
				"placeholder" => Lang::translate(key: "MAIN_EMAIL"),
				"required" => "",
				"autofocus" => ""
			]
		)
	;
	$form->addInput(input: $input);

	$submit = new ElementBuilder;
	$submit
		->setElement(element: "button")
		->setAttributs(
			attributs: [
				"type" => "submit"
			]
		)
		->setContent(content: Lang::translate(key: "LOGIN_RESET_PASSWORD"))
	;
	$form->addInput(input: $submit);

	echo $form->build();
?>
