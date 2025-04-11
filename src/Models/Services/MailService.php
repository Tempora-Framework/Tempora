<?php

namespace App\Models\Services;

use PHPMailer\PHPMailer\PHPMailer;

class MailService extends PHPMailer {

	private string $receiver;
	private string $body;
	private string $object;

	/**
	 * Email construct
	 */
	public function __construct() {
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
	}

	/**
	 * Send mail
	 *
	 * @return void
	 */
	public function send(): void {
		$this->AddAddress(address: $this->receiver);
		$this->Subject = $this->object;
		$this->Body = $this->body;

		parent::send();
	}

	/**
	 * Get the value of receiver
	 */
	public function getReceiver(): string {
		return $this->receiver;
	}

	/**
	 * Set the value of receiver
	 */
	public function setReceiver(string $receiver): self {
		$this->receiver = $receiver;

		return $this;
	}

	/**
	 * Get the value of body
	 */
	public function getBody(): string {
		return $this->body;
	}

	/**
	 * Set the value of body
	 */
	public function setBody(string $body): self {
		$this->body = $body;

		return $this;
	}

	/**
	 * Get the value of object
	 */
	public function getObject(): string {
		return $this->object;
	}

	/**
	 * Set the value of object
	 */
	public function setObject(string $object): self {
		$this->object = $object;

		return $this;
	}
}
