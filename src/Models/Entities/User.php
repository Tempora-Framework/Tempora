<?php

namespace App\Models\Entities;

class User {
	public string $uid;
	public string $name;
	public string $surname;
	public string $email;
	public string $password;

	function __construct(string $uid = "", string $name = "", string $surname = "", string $email = "", string $password = "") {
		$this->uid = $uid;
		$this->name = $name;
		$this->surname = $surname;
		$this->email = $email;
		$this->password = $password;
	}
}
