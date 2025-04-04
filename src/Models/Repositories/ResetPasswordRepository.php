<?php

namespace App\Models\Repositories;

use App\Enums\Table;
use App\Models\Entities\ResetPassword;
use App\Models\Services\MailService;
use App\Utils\ApplicationData;
use App\Utils\Lang;
use App\Utils\System;

class ResetPasswordRepository extends ResetPassword{

	/**
	 * Generate password reset link
	 *
	 * @param string $email
	 *
	 * @return void
	 */
	public function generateResetLink(string $email): void {
		$link = System::uidGen(size: 32);

		ApplicationData::request(
			query: "INSERT INTO " . Table::USER_RESET_PASSWORD->value . " (uid_user, link) VALUES (:uid, :link)",
			data: [
				"uid" => $this->getUid(),
				"link" => $link,
			]
		);

		$mailService = new MailService;
		$mailService(
			receiver: $email, object: Lang::translate(key: "MAIL_RESET_PASSWORD_OBJECT"),
			body: Lang::translate(
				key: "MAIL_RESET_PASSWORD_BODY",
				options: [
					"domain" => $_SERVER["SERVER_NAME"],
					"link" => $link
				]
			)
		);
	}
}
