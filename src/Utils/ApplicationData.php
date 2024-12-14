<?php

namespace App\Utils;

use App\Configs\Database;
use PDO;

class ApplicationData {

	/**
	 * Database request
	 *
	 * @param string $query
	 * @param array $datas
	 * @param int $returnType
	 * @param bool $singleValue
	 *
	 * @return mixed
	 */
	public static function request(string $query, array $datas = null, int $returnType = null, bool $singleValue = false) : mixed {
		$stmt = DATABASE->prepare(query: $query);

		if ($datas) {
			foreach (array_keys($datas) as $key) {
				$stmt->bindParam(
					param: $key,
					var: $datas[$key]
				);
			}
		}

		$stmt->execute();

		if ($returnType) {
			return $singleValue ? $stmt->fetchAll($returnType)[0] ?? null : $stmt->fetchAll($returnType) ?? null;
		}

		return 0;
	}

	/**
	 * Return every users uid
	 *
	 * @return array
	 */
	public static function getUsers() : array {
		return ApplicationData::request(
			query: "SELECT uid FROM " . Database::USERS,
			returnType: PDO::FETCH_COLUMN
		);
	}
}
