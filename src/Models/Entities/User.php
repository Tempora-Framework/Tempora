<?php

namespace App\Models\Entities;

class User {
	public ?string $uid;
	public ?string $name;
	public ?string $surname;
	public ?string $email;
	public ?string $password;

	function __construct(string $uid = null, string $name = null, string $surname = null, string $email = null, string $password = null) {
		$this->uid = $uid;
		$this->name = $name;
		$this->surname = $surname;
		$this->email = $email;
		$this->password = $password;
	}
}
