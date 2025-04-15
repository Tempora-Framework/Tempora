<?php

namespace App\Utils;

class ElementGenerator {

	/**
	 * Summary of select
	 *
	 * @param array $options as [name => value]
	 * @param string $name
	 * @param mixed $selected element of name from options
	 * @param string $class
	 * @param bool $translate
	 *
	 * @return string
	 */
	public static function select(array $options, string $name = "", mixed $selected = null, string $class = "", bool $translate = true): string {
		$result = "<select" . ($name != "" ? " name=\"" . $name . "\"" : "") . ($class != "" ? " class=\"" . $class . "\"" : "") . ">";

		foreach ($options as $key => $value) {
			$result .= "<option value=\"" . $key . "\"" . ($key == $selected ? " selected" : "") . ">" . ($translate ? Lang::translate(key: $value) : $value) . "</option>";
		}

		$result .= "</select>";

		return $result;
	}
}
