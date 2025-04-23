<?php

namespace App\Utils;

class Cookie {
	private string $name;
	private string $value;
	private int $expire = 60 *60 *24 *30;
	private string $path = "/";

	public function send(): void {
		setcookie(
			name: $this->name,
			value: $this->value,
			expires_or_options: time() + $this->expire,
			path: $this->path
		);
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
	 * Get the value of value
	 *
	 * @return string
	 */
	public function getValue(): string {
		return $this->value;
	}

	/**
	 * Set the value of value
	 *
	 * @param string $value
	 *
	 * @return self
	 */
	public function setValue(string $value): self {
		$this->value = $value;

		return $this;
	}

	/**
	 * Get the value of expire
	 *
	 * @return int
	 */
	public function getExpire(): int {
		return $this->expire;
	}

	/**
	 * Set the value of expire
	 *
	 * @param int $expire
	 *
	 * @return self
	 */
	public function setExpire(int $expire): self {
		$this->expire = $expire;

		return $this;
	}

	/**
	 * Get the value of path
	 *
	 * @return string
	 */
	public function getPath(): string {
		return $this->path;
	}

	/**
	 * Set the value of path
	 *
	 * @param string $path
	 *
	 * @return self
	 */
	public function setPath(string $path): self {
		$this->path = $path;

		return $this;
	}
}
