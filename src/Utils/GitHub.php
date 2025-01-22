<?php

namespace App\Utils;

class GitHub {

	/**
	 * Get current git branch
	 *
	 * @return string
	 */
	public static function getBranch() : string {
		$fname = sprintf(format: BASE_DIR . "/.git/HEAD");
		$data = file_get_contents(filename: $fname);
		$ar = explode(separator: "/", string: $data);
		$ar = array_reverse(array: $ar);

		return trim(string: "" . @$ar[0]);
	}

	/**
	 * Get current git commit
	 *
	 * @return string
	 */
	public static function getCommit() : string {
		$path = sprintf(format: BASE_DIR . "/.git/");
		$head = trim(string: substr(string: file_get_contents(filename: $path . "HEAD"), offset: 4));
		$hash = trim(string: file_get_contents(filename: sprintf(format: $path . $head)));

		return $hash;
	}
}
