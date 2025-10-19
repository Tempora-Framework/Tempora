<?php

namespace Tempora\Utils;

class Cookie {
	private string $name;
	private string $value = "";
	private int $expire = 60 *60 *24 *30;
	private string $path = "/";
	private string $domain = "";
	private bool $secure = false;
	private bool $httponly = false;

	public function send(): void {
		if (!isset($_SERVER['HTTPS']))
			$this->secure = false;

		setcookie(
			name: $this->name,
			value: $this->value,
			expires_or_options: time() + $this->expire,
			path: $this->path,
			domain: $this->domain,
			secure: $this->secure,
			httponly: $this->httponly
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
	 * @return static
	 */
	public function setName(string $name): static {
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
	 * @return static
	 */
	public function setValue(string $value): static {
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
	 * @return static
	 */
	public function setExpire(int $expire): static {
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
	 * @return static
	 */
	public function setPath(string $path): static {
		$this->path = $path;

		return $this;
	}

	/**
	 * Get the value of domain
	 *
	 * @return string
	 */
	public function getDomain(): string {
		return $this->domain;
	}

	/**
	 * Set the value of domain
	 *
	 * @param string $domain
	 *
	 * @return static
	 */
	public function setDomain(string $domain): static {
		$this->domain = $domain;

		return $this;
	}

	/**
	 * Get the value of secure
	 *
	 * @return bool
	 */
	public function isSecure(): bool {
		return $this->secure;
	}

	/**
	 * Set the value of secure
	 *
	 * @param bool $secure
	 *
	 * @return static
	 */
	public function setSecure(bool $secure): static {
		$this->secure = $secure;

		return $this;
	}

	/**
	 * Get the value of httponly
	 *
	 * @return bool
	 */
	public function isHttponly(): bool {
		return $this->httponly;
	}

	/**
	 * Set the value of httponly
	 *
	 * @param bool $httponly
	 *
	 * @return static
	 */
	public function setHttponly(bool $httponly): static {
		$this->httponly = $httponly;

		return $this;
	}
}
