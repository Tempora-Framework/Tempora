<?php

namespace Tempora\Utils\Cache;

use Tempora\Enums\Path;

class Cache {
	private string $file;
	private array $content = [];

	public function __construct(string $file) {
		$this->file = $file;
	}

	/**
	 * Get cache file content
	 *
	 * @return array<mixed>
	 */
	public function get(): array {
		if (!is_file(filename: Path::CACHE->value . "/" . $this->file)) {
			return [];
		}

		return json_decode(json: file_get_contents(filename: Path::CACHE->value . "/" . $this->file), associative: true);
	}

	/**
	 * Add cache content
	 *
	 * @return static
	 */
	public function add(string $name, mixed $value): static {
		$this->content[$name] = $value;

		return $this;
	}

	/**
	 * Create cache file
	 *
	 * @return void
	 */
	public function create(): void {
		if (self::get() != $this->content) {
			file_put_contents(filename: Path::CACHE->value . "/" . $this->file, data: json_encode(value: $this->content));
		}
	}
}
