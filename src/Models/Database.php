<?php

namespace App\Models;

use Exception;
use PDO;

class Database {
	/**
	 * Create connection
	 *
	 * @return PDO | Exception
	 */
	public function __invoke(): PDO | Exception {
		$hostname = $_ENV["DATABASE_HOST"];
		$port = $_ENV["DATABASE_PORT"];
		$dbname = $_ENV["DATABASE_NAME"];
		$username = $_ENV["DATABASE_USER"];
		$password = $_ENV["DATABASE_PASSWORD"];
		$driver = $_ENV["DATABASE_DRIVER"];
		$charset = $_ENV["DATABASE_CHARSET"];

		try {
			$connection = new PDO(
				dsn:
				"$driver:dbname=$dbname;
					host=$hostname;
					port=$port;
					options=\"--client_encoding=$charset\"",
				username: $username,
				password: $password
			);
			$connection->exec(statement: "SET NAMES \"$charset\"");
		} catch (Exception $exception) {
			return $exception;
		}

		return $connection;
	}
}
