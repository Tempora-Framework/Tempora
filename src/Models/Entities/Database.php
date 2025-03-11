<?php

namespace App\Models\Entities;

use PDO;

class Database {
	public PDO $connection;

	private string $hostname;
	private string $port;
	private string $dbname;
	private string $username;
	private string $password;
	private string $driver;
	private string $charset;

	/**
	 * Database __construct
	 *
	 * @param string $hostname
	 * @param string $port
	 * @param string $dbname
	 * @param string $username
	 * @param string $password
	 * @param string $driver
	 * @param string $charset
	 */
	public function __construct(string $hostname = "127.0.0.1", string $port = "3306", string $dbname = null, string $username = null, string $password = null, string $driver = null, string $charset = null) {
		$this->hostname = $hostname;
		$this->port = $port;
		$this->dbname = $dbname;
		$this->username = $username;
		$this->password = $password;
		$this->driver = $driver;
		$this->charset = $charset;
	}

	public function __get($var): mixed {
		return $this->$var;
	}
}
