<?php

namespace App\Utils;

class GitHub {

	/**
	 * Get current git branch
	 *
	 * @return string
	 */
	public static function getBranch() : string {
		$fname = sprintf(BASE_DIR . "/.git/HEAD");
		$data = file_get_contents($fname);
		$ar  = explode("/", $data);
		$ar = array_reverse($ar);
		return  trim ("" . @$ar[0]);
	}

	/**
	 * Get current git commit
	 *
	 * @return string
	 */
	public static function getCommit() : string {
		$path = sprintf(BASE_DIR . "/.git/");
		$head = trim(substr(file_get_contents($path . "HEAD"), 4));
		$hash = trim(file_get_contents(sprintf($path . $head)));
		return $hash;
	}
}
