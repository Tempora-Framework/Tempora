<?php

namespace App\Utils;

use PDO;

class System {

	/**
	 * Header rewrite function
	 *
	 * @param string $url URL to redirect, null for refresh
	 *
	 * @return void
	 */
	public static function redirect(string $url = null) : void {
		if (isset($url)) {
			header("Location: " . $url);
		} else {
			header("Refresh: 0");
		}
		exit;
	}

	/**
	 * UID function generator
	 *
	 * @param int $size UID length
	 * @param string $table Database table to check for existing UID
	 *
	 * @return string
	 */
	public static function uidGen(int $size = 16, string $table = null) : string {
		$char = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_";
		$uid = "";
		$uidChecked = null;
		$randomByte = random_bytes($size);

		do {
			foreach (str_split($randomByte) as $byte) {
				$random = ord($byte) % strlen($char);
				$uid .= $char[$random];
			}

			if (!empty($table)) {
				$uidChecked = ApplicationData::request(
					query: "SELECT uid FROM " . $table . " WHERE uid = :uid",
					datas: [
						"uid" => $uid
					],
					returnType: PDO::FETCH_COLUMN,
					singleValue: true
				);
			}
		} while ($uidChecked === $uid);

		return $uid;
	}

	/**
	 * Get path files
	 *
	 * @param string $path Directory path
	 *
	 * @return array
	 */
	public static function getFiles(string $path) : array {
		return array_diff(scandir($path), array('.', '..'));
	}
}
