<?php

namespace App\Models\Repositories;

use App\Enums\Table;
use App\Models\Entities\ResetPassword;
use App\Models\Services\MailService;
use App\Utils\ApplicationData;
use App\Utils\Lang;
use App\Utils\System;
use PDO;

class ResetPasswordRepository extends ResetPassword {

	/**
	 * Generate password reset link
	 *
	 * @return void
	 */
	public function generateResetLink(): void {
		$link = System::uidGen(size: 32);

		ApplicationData::request(
			query: "INSERT INTO " . Table::USER_RESET_PASSWORD->value . " (uid_user, link) VALUES (:uid, :link)",
			data: [
				"uid" => $this->getUid(),
				"link" => $link,
			]
		);

		$mailService = new MailService;
		$mailService
			->setReceiver(receiver: $this->getEmail())
			->setObject(object: Lang::translate(key: "MAIL_RESET_PASSWORD_OBJECT"))
			->setBody(
				body: Lang::translate(key: "MAIL_RESET_PASSWORD_BODY",
					options: [
						"domain" => $_SERVER["SERVER_NAME"],
						"link" => $link
					]
				)
			)
			->send()
		;
	}

	/**
	 * Remove reset link
	 *
	 * @return string
	 */
	public function removeResetLink(): void {
		ApplicationData::request(
			query: "DELETE FROM " . Table::USER_RESET_PASSWORD->value . " WHERE link = :link",
			data: [
				"link" => $this->getLink()
			]
		);
	}

	/**
	 * Check if user already have reset link
	 *
	 * @return bool
	 */
	public function isUserUid(): bool {
		return ApplicationData::request(
			query: "SELECT uid_user FROM " . Table::USER_RESET_PASSWORD->value . " WHERE uid_user = :uid",
			data: [
				"uid" => $this->getUid()
			],
			returnType: PDO::FETCH_COLUMN,
			singleValue: true
		) ?? false;
	}
}
