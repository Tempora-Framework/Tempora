<?php

namespace Tempora\Utils\Cache;

class Route extends Cache {
	public static function getPath(string $name, ?array $options = null): string {
		$cache = new Cache(file: "routes.json");
		$cache = $cache->get();

		foreach ($cache as $key => $value) {
			if ($key == $name) {
				if (isset($options)) {
					foreach ($options as $option => $optionValue) {
						$value = str_replace(search: "\$" . $option, replace: $optionValue, subject: $value);
					}
				}

				return $value == $_SERVER["REQUEST_URI"] ? "#" : $value;
			}
		}

		return $_SERVER["REQUEST_URI"] == "/" ? "#" : "/";
	}
}
