<?php

namespace App\Models\Services;

use App\Models\Entities\Mail;
use PHPMailer\PHPMailer\PHPMailer;

class MailService {
	private Mail $mail;

	private PHPMailer $mailer;

	/**
	 * User construct
	 *
	 * @param Mail $mail
	 */
	public function __construct(Mail $mail) {
		$this->mail = $mail;

		$this->mailer = new PHPMailer();

		$this->mailer->isSMTP();
		$this->mailer->SMTPAuth = true;
		$this->mailer->SMTPSecure = "tls";
		$this->mailer->CharSet = "UTF-8";
		$this->mailer->Host = $this->mail->host;
		$this->mailer->Port = $this->mail->port;
		$this->mailer->SMTPAuth = true;
		$this->mailer->Username = $this->mail->address;
		$this->mailer->Password = $this->mail->password;

		$this->mailer->isHTML(isHtml: true);
	}

	/**
	 * Send email
	 *
	 * @return void
	 */
	public function send(): void {
		$this->mailer->setFrom(address: $this->mail->address, name: APP_NAME);
		$this->mailer->AddAddress(address: $this->mail->receiver);

		$this->mailer->Subject = $this->mail->object;
		$this->mailer->Body = $this->mail->body;

		$this->mailer->send();
	}
}
