<?php
	use Tempora\Utils\ElementBuilder\ElementBuilder;
	use Tempora\Utils\ElementBuilder\Form;
	use Tempora\Utils\Lang;
?>

<?php
	$form = new Form();
	$form
		->setAttributs(
			attributs: [
				"method" => "POST",
				"class"	=> "account"
			]
		)
		->setCsrf(csrf: true)
	;

	if (!isset($oldPassword) || $oldPassword != false) {
		$input = new ElementBuilder;
		$input
			->setElement(element: "input")
			->setAttributs(
				attributs: [
					"type" => "password",
					"name" => "old_password",
					"value" => $pageData["form_update_old_password"] ?? "",
					"placeholder" => Lang::translate(key: "MAIN_OLD_PASSWORD")
				]
			)
		;
		$form->addInput(input: $input);
	}

	$input = new ElementBuilder;
	$input
		->setElement(element: "input")
		->setAttributs(
			attributs: [
				"type" => "password",
				"name" => "new_password",
				"value" => $pageData["form_update_new_password"] ?? "",
				"placeholder" => Lang::translate(key: "MAIN_NEW_PASSWORD")
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
				"name" => "new_password_confirm",
				"value" => $pageData["form_update_new_password_confirm"] ?? "",
				"placeholder" => Lang::translate(key: "MAIN_CONFIRM")
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
		->setContent(content: Lang::translate(key: "MAIN_SAVE"))
	;
	$form->addInput(input: $submit);

	echo $form->build();
?>
