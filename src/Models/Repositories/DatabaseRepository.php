<?php

namespace App\Models\Repositories;

use App\Models\Entities\Database;
use Exception;
use PDO;

class DatabaseRepository {
	private $database;

	/**
	 * Database construct
	 *
	 * @param Database $database
	 */
	public function __construct(Database $database) {
		$this->database = $database;
	}

	/**
	 * Create connection
	 *
	 * @return PDO | Exception
	 */
	public function createConnection() : PDO | Exception {
		$hostname = $this->database->hostname;
		$port = $this->database->port;
		$dbname = $this->database->dbname;
		$username = $this->database->username;
		$password = $this->database->password;
		$driver = $this->database->driver;
		$charset = $this->database->charset;

		try {
			$this->database->connection = new PDO(
				dsn:
				"$driver:dbname=$dbname;
					host=$hostname;
					port=$port;
					options=\"--client_encoding=$charset\"",
				username: $username,
				password: $password
			);
			$this->database->connection->exec(statement: "SET NAMES \"$charset\"");
		} catch (Exception $exception) {
			return $exception;
		}

		return $this->database->connection;
	}
}
