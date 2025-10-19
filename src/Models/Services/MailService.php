<?php

namespace Tempora\Models\Services;

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
	 *
	 * @return string
	 */
	public function getReceiver(): string {
		return $this->receiver;
	}

	/**
	 * Set the value of receiver
	 *
	 * @param string $receiver
	 *
	 * @return static
	 */
	public function setReceiver(string $receiver): static {
		$this->receiver = $receiver;

		return $this;
	}

	/**
	 * Get the value of body
	 *
	 * @return string
	 */
	public function getBody(): string {
		return $this->body;
	}

	/**
	 * Set the value of body
	 *
	 * @param string $body
	 *
	 * @return static
	 */
	public function setBody(string $body): static {
		$this->body = $body;

		return $this;
	}

	/**
	 * Get the value of object
	 *
	 * @return string
	 */
	public function getObject(): string {
		return $this->object;
	}

	/**
	 * Set the value of object
	 *
	 * @param string $object
	 *
	 * @return static
	 */
	public function setObject(string $object): static {
		$this->object = $object;

		return $this;
	}
}
