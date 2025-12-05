<?php

namespace Tempora\Models\Services;

class APIService {
	private string $header = "Content-Type: application/json";
	private array $data;
	private int $statusCode = 200;

	/**
	 * API response
	 *
	 * @return void
	 */
	public function render(): void {
		header(header: $this->header);
		http_response_code(response_code: $this->statusCode);

		echo json_encode(value: $this->data);
	}

	/**
	 * Get the value of header
	 *
	 * @return string
	 */
	public function getHeader(): string {
		return $this->header;
	}

	/**
	 * Set the value of header
	 *
	 * @param string $header
	 *
	 * @return self
	 */
	public function setHeader(string $header): self {
		$this->header = $header;

		return $this;
	}

	/**
	 * Get the value of data
	 *
	 * @return array
	 */
	public function getData(): array {
		return $this->data;
	}

	/**
	 * Set the value of data
	 *
	 * @param array $data
	 *
	 * @return self
	 */
	public function setData(array $data): self {
		$this->data = $data;

		return $this;
	}

	/**
	 * Get the value of statusCode
	 *
	 * @return int
	 */
	public function getStatusCode(): int {
		return $this->statusCode;
	}

	/**
	 * Set the value of statusCode
	 *
	 * @param int $statusCode
	 *
	 * @return self
	 */
	public function setStatusCode(int $statusCode): self {
		$this->statusCode = $statusCode;

		return $this;
	}
}
