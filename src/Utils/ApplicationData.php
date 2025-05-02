<?php

namespace App\Utils;

use App\Enums\Table;
use PDO;

class ApplicationData {

	/**
	 * Database request
	 *
	 * @param string $query SQL query
	 * @param array $data Data to bind
	 * @param int $returnType Specified type to get return value
	 * @param bool $singleValue Does the return type should be a single value
	 *
	 * @return mixed
	 */
	public static function request(string $query, array $data = null, int $returnType = null, bool $singleValue = false): mixed {
		$stmt = DATABASE->prepare(query: $query);

		if ($data) {
			foreach (array_keys($data) as $key) {
				$stmt->bindParam(
					param: $key,
					var: $data[$key]
				);
			}
		}

		if (DEBUG == 1) {
			$GLOBALS["toolbar"]["sql_count"]++;
			$queryLog = $query;

			if ($data) {
				foreach ($data as $key => $value) {
					$queryLog = str_replace(search: ":" . $key, replace: $value, subject: $queryLog);
				}
			}

			array_push($GLOBALS["toolbar"]["sql_query"], [debug_backtrace()[1]["class"] . "::" . debug_backtrace()[1]["function"] . "()" . "<br>Line " . debug_backtrace()[0]["line"] => $queryLog]);
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
	 * @return array<string>
	 */
	public static function getUsers(): array {
		return ApplicationData::request(
			query: "SELECT uid FROM " . Table::USERS->value,
			returnType: PDO::FETCH_COLUMN
		);
	}
}
