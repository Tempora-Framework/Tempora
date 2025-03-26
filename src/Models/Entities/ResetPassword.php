<?php

namespace App\Models\Entities;

use App\Configs\Database;
use App\Utils\ApplicationData;
use PDO;

class ResetPassword {
	private ?string $uid;
	private ?string $link;
	private ?string $email;

	function __construct(string $link = null, string $email = null) {
		$this->link = $link;
		$this->email = $email;

		$this->uid = ApplicationData::request(
			query: "SELECT uid_user FROM " . Database::USER_RESET_PASSWORD . " WHERE link = :link",
			data: [
				"link" => $this->link
			],
			returnType: PDO::FETCH_COLUMN,
			singleValue: true
		);
	}

	public function __set($var, $value): void {
		$this->$var = $value;
	}

	public function __get($var): mixed {
		return $this->$var;
	}
}
