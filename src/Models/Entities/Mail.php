<?php

namespace App\Models\Entities;

class Mail {
	private int $port;
	private string $host;
	private string $address;
	private string $password;

	private string $receiver;
	private ?string $object;
	private string $body;

	function __construct(string $receiver, string $body, string $object = "") {
		$this->port = $_ENV["EMAIL_SMTP_PORT"];
		$this->host = $_ENV["EMAIL_SMTP"];
		$this->address = $_ENV["EMAIL_ADDRESS"];
		$this->password = $_ENV["EMAIL_PASSWORD"];

		$this->receiver = $receiver;
		$this->object = $object;
		$this->body = $body;
	}

	public function __set($var, $value): void {
		$this->$var = $value;
	}

	public function __get($var): mixed {
		return $this->$var;
	}
}
