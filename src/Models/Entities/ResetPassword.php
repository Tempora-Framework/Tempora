<?php

namespace App\Models\Entities;

use App\Enums\Table;
use App\Utils\ApplicationData;
use PDO;

class ResetPassword {
	private ?string $uid;
	private ?string $link;
	private ?string $email;

	/**
	 * Get the value of uid
	 *
	 * @return string
	 */
	public function getUid(): string {
		return $this->uid;
	}

	/**
	 * Set the value of uid
	 *
	 * @param string $uid
	 *
	 * @return self
	 */
	public function setUid(?string $uid = null): self {
		if ($uid) {
			$this->uid = $uid;
		} else {
			$this->uid = ApplicationData::request(
				query: "SELECT uid_user FROM " . Table::USER_RESET_PASSWORD->value . " WHERE link = :link",
				data: [
					"link" => $this->link
				],
				returnType: PDO::FETCH_COLUMN,
				singleValue: true
			);
		}

		return $this;
	}

	/**
	 * Get the value of link
	 *
	 * @return string
	 */
	public function getLink(): string {
		return $this->link;
	}

	/**
	 * Set the value of link
	 *
	 * @param string $link
	 *
	 * @return self
	 */
	public function setLink(string $link): self {
		$this->link = $link;

		return $this;
	}

	/**
	 * Get the value of email
	 *
	 * @return string
	 */
	public function getEmail(): string {
		return $this->email;
	}

	/**
	 * Set the value of email
	 *
	 * @param string $email
	 *
	 * @return self
	 */
	public function setEmail(string $email): self {
		$this->email = $email;

		return $this;
	}
}
