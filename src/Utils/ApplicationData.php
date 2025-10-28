<?php

namespace Tempora\Utils;

use PDO;

class ApplicationData {
	/**
	 * Database request
	 *
	 * @param string $query       SQL query
	 * @param array  $data        Data to bind
	 * @param int    $returnType  Specified type to get return value
	 * @param bool   $singleValue Does the return type should be a single value
	 *
	 * @return mixed
	 */
	public static function request(string $query, ?array $data = null, ?int $returnType = null, bool $singleValue = false): mixed {
		if (DEBUG) {
			$tempSQLms = microtime(as_float: true);
		}

		$stmt = DATABASE->prepare(query: $query);

		if ($data) {
			foreach ($data as $key => $value) {
				$stmt->bindValue(
					param: ":" . $key,
					value: $value,
					type: is_bool(value: $value) ? PDO::PARAM_BOOL : PDO::PARAM_STR
				);
			}
		}

		$stmt->execute();

		if (DEBUG) {
			$GLOBALS["chronos"]["sql_count"]++;
			$queryLog = $query;

			if ($data) {
				foreach ($data as $key => $value) {
					$queryLog = str_replace(search: ":" . $key, replace: $value ?? "", subject: $queryLog);
				}
			}

			array_push(
				$GLOBALS["chronos"]["sql_query"],
				[
					"class" => debug_backtrace()[1]["class"] ?? null,
					"function" => debug_backtrace()[1]["function"] ?? null,
					"line" => debug_backtrace()[0]["line"],
					"time" => round(num: (microtime(as_float: true) - $tempSQLms) * 1000, precision: 3),
					"query" => $queryLog
				]
			);
		}

		if ($returnType) {
			$fetchResult = $stmt->fetchAll(mode: $returnType);

			return $singleValue ? $fetchResult[0] ?? null : $fetchResult ?? null;
		}

		return 0;
	}
}
