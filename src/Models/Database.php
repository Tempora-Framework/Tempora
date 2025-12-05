<?php

namespace Tempora\Models;

use Exception;
use PDO;
use Tempora\Exceptions\Database\TemporaDatabaseException;

class Database {
	private PDO $connection;

	/**
	 * Create connection
	 *
	 * @return PDO
	 */
	public function __construct() {
		$hostname = $_ENV["DATABASE_HOST"];
		$port = $_ENV["DATABASE_PORT"];
		$dbname = $_ENV["DATABASE_NAME"];
		$username = $_ENV["DATABASE_USER"];
		$password = $_ENV["DATABASE_PASSWORD"];
		$driver = $_ENV["DATABASE_DRIVER"];
		$charset = $_ENV["DATABASE_CHARSET"];

		try {
			$this->connection = new PDO(
				dsn:
				"$driver:dbname=$dbname;
					host=$hostname;
					port=$port;
					options=\"--client_encoding=$charset\"",
				username: $username,
				password: $password
			);
			$this->connection->exec(statement: "SET NAMES \"$charset\"");
		} catch (Exception $exception) {
			throw new TemporaDatabaseException(message: "Database connection error: " . $exception->getMessage());
		}
	}

	/**
	 * Get the PDO connection
	 *
	 * @return PDO
	 */
	public function getConnection(): PDO {
		return $this->connection;
	}
}
