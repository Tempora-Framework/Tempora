<?php

namespace App\Utils;

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
			foreach ($datas as $index => $value) {
				$stmt->bindParam(
					param: ":" . $index,
					var: $value
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
	 * Return every users
	 *
	 * @param mixed $path
	 *
	 * @return array
	 */
	public static function getUsers() : array {
		$users[1] = [
			"name" => "Lui",
			"surname" => "Labas"
		];
		$users[2] = [
			"name" => "Lautre",
			"surname" => "Ici"
		];

		return $users;
	}
}
