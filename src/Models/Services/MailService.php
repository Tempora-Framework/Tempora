<?php

namespace App\Models\Services;

use PHPMailer\PHPMailer\PHPMailer;

class MailService extends PHPMailer {

	/**
	 * Email construct
	 *
	 * @param string $receiver
	 * @param string $body
	 * @param string $object
	 */
	public function __invoke(string $receiver, string $body, string $object = ""): void {
		$this->isSMTP();
		$this->isHTML(isHtml: true);
		$this->SMTPAuth = true;
		$this->SMTPSecure = "tls";
		$this->CharSet = "UTF-8";
		$this->Host = $_ENV["EMAIL_SMTP"];
		$this->Port = $_ENV["EMAIL_SMTP_PORT"];
		$this->SMTPAuth = true;
		$this->Username = $_ENV["EMAIL_ADDRESS"];
		$this->Password = $_ENV["EMAIL_PASSWORD"];

		$this->setFrom(address: $this->Username, name: APP_NAME);
		$this->AddAddress(address: $receiver);

		$this->Subject = $object;
		$this->Body = $body;

		parent::send();
	}
}
