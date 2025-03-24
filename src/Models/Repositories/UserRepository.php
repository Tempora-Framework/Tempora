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
	public function create(): Exception | string {
		$this->user->uid = System::uidGen(size: 16, table: Database::USERS);
		$this->user->password = password_hash(password: $this->user->password, algo: PASSWORD_BCRYPT);

		try {
			ApplicationData::request(
				query: "INSERT INTO " . Database::USERS . " (uid, name, surname, email, password, to_modify) VALUES (:uid, :name, :surname, :email, :password, :toModify)",
				data: [
					"uid" => $this->user->uid,
					"name" => $this->user->name,
					"surname" => $this->user->surname,
					"email" => $this->user->email,
					"password" => $this->user->password,
					"toModify" => (int)$this->user->toModify
				]
			);
		} catch (Exception $exception) {
			return $exception;
		}

		return $this->user->uid;
	}

	/**
	 * Set password
	 *
	 * @return void
	 */
	public function setPassword(): void {
		$this->user->password = password_hash(password: $this->user->password, algo: PASSWORD_BCRYPT);

		ApplicationData::request(
			query: "UPDATE " . Database::USERS . " SET password = :password, to_modify = false WHERE uid = :uid",
			data: [
				"uid" => $this->user->uid,
				"password" => $this->user->password
			]
		);
	}

	/**
	 * Verify user password
	 *
	 * @return Exception | string
	 */
	public function verifyPassword(): Exception | string {
		$userData = ApplicationData::request(
			query: "SELECT uid, password FROM " . Database::USERS . " WHERE email = :email",
			data: [
				"email" => $this->user->email
			],
			returnType: PDO::FETCH_ASSOC,
			singleValue: true
		);

		if ($userData != null) {
			if (password_verify(password: $this->user->password, hash: $userData["password"])) {
				return $userData["uid"];
			} else {
				return new Exception(message: "Wrong password");
			}
		}

		return new Exception(message: "Unknown user");
	}

	/**
	 * Get user's informations
	 *
	 * @param string $uid
	 *
	 * @return null | array
	 */
	public static function getInformations(string $uid): null | array {
		return ApplicationData::request(
			query: "SELECT * FROM " . Database::USERS . " WHERE uid = :uid",
			data: [
				"uid" => $uid
			],
			returnType: PDO::FETCH_ASSOC,
			singleValue: true
		);
	}

	/**
	 * Get user's role(s)
	 *
	 * @param string $uid User's UID
	 *
	 * @return array
	 */
	public static function getRoles(string $uid): array {
		return ApplicationData::request(
			query: "SELECT id_role FROM " . Database::USER_ROLE . " WHERE uid_user = :uid",
			data: [
				"uid" => $uid
			],
			returnType: PDO::FETCH_COLUMN
		);
	}
}
