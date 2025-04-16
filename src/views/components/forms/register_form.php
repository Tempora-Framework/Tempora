<?php
	use App\Utils\ElementBuilder\ElementBuilder;
	use App\Utils\ElementBuilder\Form;
	use App\Utils\Lang;
?>

<?php
	$form = new Form();
	$form
		->setAttributs(
			attributs: [
				"method" => "POST",
				"class"	=> "register"
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
				"name" => "name",
				"value" => $pageData["form_name"] ?? "",
				"placeholder" => Lang::translate(key: "MAIN_NAME"),
				"required" => "",
				"autofocus" => ""
			]
		)
	;
	$form->addInput(input: $input);

	$input = new ElementBuilder;
	$input
		->setElement(element: "input")
		->setAttributs(
			attributs: [
				"type" => "text",
				"name" => "surname",
				"value" => $pageData["form_surname"] ?? "",
				"placeholder" => Lang::translate(key: "MAIN_SURNAME"),
				"required" => ""
			]
		)
	;
	$form->addInput(input: $input);

	$input = new ElementBuilder;
	$input
		->setElement(element: "input")
		->setAttributs(
			attributs: [
				"type" => "text",
				"name" => "email",
				"value" => $pageData["form_email"] ?? "",
				"placeholder" => Lang::translate(key: "MAIN_EMAIL"),
				"required" => ""
			]
		)
	;
	$form->addInput(input: $input);

	$input = new ElementBuilder;
	$input
		->setElement(element: "input")
		->setAttributs(
			attributs: [
				"type" => "password",
				"name" => "password",
				"value" => $pageData["form_password"] ?? "",
				"placeholder" => Lang::translate(key: "MAIN_PASSWORD"),
				"required" => ""
			]
		)
	;
	$form->addInput(input: $input);

	$input = new ElementBuilder;
	$input
		->setElement(element: "input")
		->setAttributs(
			attributs: [
				"type" => "password",
				"name" => "password_confirm",
				"value" => $pageData["form_password_confirm"] ?? "",
				"placeholder" => Lang::translate(key: "REGISTER_PASSWORD_CONFIRM"),
				"required" => ""
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
		->setContent(content: Lang::translate(key: "REGISTER_SUBMIT"))
	;
	$form->addInput(input: $submit);

	echo $form->build();
?>
