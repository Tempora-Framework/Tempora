<?php

namespace Tempora\Attributes;

use Attribute;

#[Attribute]
class RouteAttribute {
	public function __construct(
		public string $path = "",
		public string $name = "",
		public ?string $description = null,
		public string $method = "GET",
		public ?string $title = null,
		public ?bool $needLoginToBe = null,
		public ?array $accessRoles = null,
	) {}
}
