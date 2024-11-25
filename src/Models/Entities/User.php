<?php

namespace App\Models\Entities;

class User {
	public string $name;

	function __construct(string $name) {
		$this->name = $name;
	}
}
