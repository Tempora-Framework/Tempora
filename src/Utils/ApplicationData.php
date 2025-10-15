<?php

namespace Tempora\Utils;

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
	public static function request(string $query, ?array $data = null, ?int $returnType = null, bool $singleValue = false): mixed {
		if (DEBUG == 1)
			$tempSQLms = microtime(as_float: true);

		$stmt = DATABASE->prepare(query: $query);

		if ($data) {
			foreach (array_keys($data) as $key) {
				$stmt->bindParam(
					param: $key,
					var: $data[$key]
				);
			}
		}

		$stmt->execute();

		if (DEBUG == 1) {
			$GLOBALS["chronos"]["sql_count"]++;
			$queryLog = $query;

			if ($data) {
				foreach ($data as $key => $value) {
					$queryLog = str_replace(search: ":" . $key, replace: $value, subject: $queryLog);
				}
			}

			array_push(
				$GLOBALS["chronos"]["sql_query"],
				[
					"class" => debug_backtrace()[1]["class"] ?? null,
					"function" => debug_backtrace()[1]["function"] ?? null,
					"line" => debug_backtrace()[0]["line"],
					"time" => round(num: (microtime(as_float: true) - $tempSQLms) *1000, precision: 3),
					"query" => $queryLog
				]
			);
		}

		if ($returnType) {
			return $singleValue ? $stmt->fetchAll(mode: $returnType)[0] ?? null : $stmt->fetchAll(mode: $returnType) ?? null;
		}

		return 0;
	}
}
