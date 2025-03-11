<?php

namespace App\Models\Entities;

class User {
	private ?string $uid;
	private ?string $name;
	private ?string $surname;
	private ?string $email;
	private ?string $password;

	function __construct(string $uid = null, string $name = null, string $surname = null, string $email = null, string $password = null) {
		$this->uid = $uid;
		$this->name = $name;
		$this->surname = $surname;
		$this->email = $email;
		$this->password = $password;
	}

	public function __set($var, $value): void {
		$this->$var = $value;
	}

	public function __get($var): mixed {
		return $this->$var;
	}
}
