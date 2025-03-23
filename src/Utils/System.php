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
	public static function redirect(string $url = null): void {
		if (isset($url)) {
			header(header: "Location: " . $url);
		} else {
			header(header: "Refresh: 0");
		}
		exit;
	}

	public static function createCSRF(): string {
		if (!isset($_SESSION["csrf"])) {
			$_SESSION["csrf"] = bin2hex(string: random_bytes(length: 50));
		}

		return "<input type=\"hidden\" name=\"page_csrf\" value=\"" . $_SESSION["csrf"] . "\">";
	}

	public static function checkCSRF(): bool {
		if (!isset($_SESSION['csrf']) || !isset($_POST['page_csrf']))
			return false;
		if ($_SESSION['csrf'] != $_POST['page_csrf'])
			return false;

		return true;
	}

	/**
	 * UID function generator
	 *
	 * @param int $size UID length
	 * @param string $table Database table to check for existing UID
	 *
	 * @return string
	 */
	public static function uidGen(int $size = 16, string $table = null): string {
		$char = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_";
		$uid = "";
		$uidChecked = null;
		$randomByte = random_bytes(length: $size);

		do {
			foreach (str_split(string: $randomByte) as $byte) {
				$random = ord(character: $byte) % strlen(string: $char);
				$uid .= $char[$random];
			}

			if (!empty($table)) {
				$uidChecked = ApplicationData::request(
					query: "SELECT uid FROM `" . $table . "` WHERE uid = :uid",
					data: [
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
	public static function getFiles(string $path): array {
		return array_diff(scandir(directory: $path), array(".", ".."));
	}
}
