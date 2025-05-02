<?php

namespace App\Utils;

use App\Enums\Path;

class Cache {
	private string $file;
	private array $content = [];

	public function __construct(string $file) {
		$this->file = $file;
	}

	public function get(): array {
		return json_decode(json: file_get_contents(filename: $this->file), associative: true);
	}

	public function add(string $name, mixed $value): self {
		$this->content[$name] = $value;

		return $this;
	}

	public function create(): void {
		file_put_contents(filename: Path::CACHE . "/" . $this->file, data: json_encode(value: $this->content));
	}
}
