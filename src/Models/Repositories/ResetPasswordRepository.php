<?php

namespace App\Models\Repositories;

use App\Configs\Database;
use App\Models\Entities\Mail;
use App\Models\Entities\ResetPassword;
use App\Models\Services\MailService;
use App\Utils\ApplicationData;
use App\Utils\Lang;
use App\Utils\System;

class ResetPasswordRepository {
	private $resetPassword;

	/**
	 * Reset construct
	 *
	 * @param ResetPassword $resetPassword
	 */
	public function __construct(ResetPassword $resetPassword) {
		$this->resetPassword = $resetPassword;
	}

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
			query: "INSERT INTO " . Database::USER_RESET_PASSWORD . " (uid_user, link) VALUES (:uid, :link)",
			data: [
				"uid" => $this->resetPassword->uid,
				"link" => $link,
			]
		);

		$mailService = new MailService(mail: new Mail(
			receiver: $email, object: Lang::translate(key: "MAIL_RESET_PASSWORD_OBJECT"),
			body: Lang::translate(
				key: "MAIL_RESET_PASSWORD_BODY",
				options: [
					"domain" => $_SERVER["SERVER_NAME"],
					"link" => $link
				]
			)
		));
		$mailService->send();
	}

	/**
	 * Get user uid
	 *
	 * @return string|null
	 */
	public function getUid(): string | null {
		return $this->resetPassword->uid;
	}
}
