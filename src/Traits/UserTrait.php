<?php

namespace Tempora\Traits;

use PDO;
use Tempora\Enums\Table;
use Tempora\Utils\ApplicationData;

trait UserTrait {

	/**
	 * Get user's role(s)
	 *
	 * @param string $uid User's UID
	 *
	 * @return array<int>
	 */
	public static function getRoles(string $uid): array {
		return ApplicationData::request(
			query: "SELECT id_role FROM " . Table::USER_ROLE->value . " WHERE uid_user = :uid",
			data: [
				"uid" => $uid
			],
			returnType: PDO::FETCH_COLUMN
		);
	}

	/**
	 * Get user's information
	 *
	 * @param string $uid
	 *
	 * @return null | array
	 */
	public static function getInformation(string $uid): null | array {
		return ApplicationData::request(
			query: "SELECT * FROM " . Table::USERS->value . " WHERE uid = :uid",
			data: [
				"uid" => $uid
			],
			returnType: PDO::FETCH_ASSOC,
			singleValue: true
		);
	}
}
