<?php

namespace App\Models\Entities;

class User {
	private ?string $uid;
	private ?string $name;
	private ?string $surname;
	private ?string $email;
	private ?string $password;
	private bool $toModify = false;

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
	public function setUid(string $uid): self {
		$this->uid = $uid;

		return $this;
	}

	/**
	 * Get the value of name
	 *
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * Set the value of name
	 *
	 * @param string $name
	 *
	 * @return self
	 */
	public function setName(string $name): self {
		$this->name = $name;

		return $this;
	}

	/**
	 * Get the value of surname
	 *
	 * @return string
	 */
	public function getSurname(): string {
		return $this->surname;
	}

	/**
	 * Set the value of surname
	 *
	 * @param string $surname
	 *
	 * @return self
	 */
	public function setSurname(string $surname): self {
		$this->surname = $surname;

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

	/**
	 * Get the value of password
	 *
	 * @return string
	 */
	public function getPassword(): string {
		return $this->password;
	}

	/**
	 * Set the value of password
	 *
	 * @param string $password
	 *
	 * @return self
	 */
	public function setPassword(string $password): self {
		$this->password = $password;

		return $this;
	}

	/**
	 * Get the value of toModify
	 *
	 * @return bool
	 */
	public function isToModify(): bool {
		return $this->toModify;
	}

	/**
	 * Set the value of toModify
	 *
	 * @param bool $toModify
	 *
	 * @return self
	 */
	public function setToModify(bool $toModify): self {
		$this->toModify = $toModify;

		return $this;
	}
}
