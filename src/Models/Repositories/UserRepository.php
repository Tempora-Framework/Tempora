<?php

namespace App\Models\Repositories;

use App\Configs\Database;
use App\Models\Entities\User;
use App\Utils\ApplicationData;
use App\Utils\System;
use Exception;
use PDO;

class UserRepository {
	private $user;

	/**
	 * User construct
	 *
	 * @param User $user
	 */
	public function __construct(User $user) {
		$this->user = $user;
	}

	/**
	 * Create user
	 *
	 * @return Exception | string
	 */
	public function create() : Exception | string {
		$this->user->uid = System::uidGen(size: 16, table: Database::USERS);
		$this->user->password = password_hash(password: $this->user->password, algo: PASSWORD_BCRYPT);

		try {
			ApplicationData::request(
				query: "INSERT INTO " . Database::USERS . " (uid, name, surname, email, password) VALUES (:uid, :name, :surname, :email, :password)",
				datas: [
					"uid" => $this->user->uid,
					"name" => $this->user->name,
					"surname" => $this->user->surname,
					"email" => $this->user->email,
					"password" => $this->user->password
				]
			);
		} catch (Exception $exception) {
			return $exception;
		}

		return $this->user->uid;
	}

	/**
	 * Verify user password
	 *
	 * @return Exception | string
	 */
	public function verifyPassword() : Exception | string {
		$userData = ApplicationData::request(
			query: "SELECT uid, password FROM " . Database::USERS . " WHERE email = :email",
			datas: [
				"email" => $this->user->email
			],
			returnType: PDO::FETCH_ASSOC,
			singleValue: true
		);

		if ($userData != null) {
			if (password_verify($this->user->password, $userData["password"])) {
				return $userData["uid"];
			} else {
				return new Exception("Wrong password");
			}
		}

		return new Exception("Unknown user");
	}

	/**
	 * Get user's role(s)
	 *
	 * @param string $uid User's UID
	 *
	 * @return array
	 */
	public static function getRoles(string $uid) : array {
		return ApplicationData::request(
			query: "SELECT id_role FROM " . Database::USER_ROLE . " WHERE uid_user = :uid",
			datas: [
				"uid" => $uid
			],
			returnType: PDO::FETCH_COLUMN
		);
	}
}
