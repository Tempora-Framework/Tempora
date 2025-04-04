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
	 */
	public function getUid(): ?string {
		return $this->uid;
	}

	/**
	 * Set the value of uid
	 */
	public function setUid(?string $uid): self {
		$this->uid = $uid;

		return $this;
	}

	/**
	 * Get the value of name
	 */
	public function getName(): ?string {
		return $this->name;
	}

	/**
	 * Set the value of name
	 */
	public function setName(?string $name): self {
		$this->name = $name;

		return $this;
	}

	/**
	 * Get the value of surname
	 */
	public function getSurname(): ?string {
		return $this->surname;
	}

	/**
	 * Set the value of surname
	 */
	public function setSurname(?string $surname): self {
		$this->surname = $surname;

		return $this;
	}

	/**
	 * Get the value of email
	 */
	public function getEmail(): ?string {
		return $this->email;
	}

	/**
	 * Set the value of email
	 */
	public function setEmail(?string $email): self {
		$this->email = $email;

		return $this;
	}

	/**
	 * Get the value of password
	 */
	public function getPassword(): ?string {
		return $this->password;
	}

	/**
	 * Set the value of password
	 */
	public function setPassword(?string $password): self {
		$this->password = $password;

		return $this;
	}

	/**
	 * Get the value of toModify
	 */
	public function getToModify(): bool {
		return $this->toModify;
	}

	/**
	 * Set the value of toModify
	 */
	public function setToModify(bool $toModify): self {
		$this->toModify = $toModify;

		return $this;
	}
}
