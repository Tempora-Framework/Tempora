<?php

namespace Tempora\Utils\Minifier;

use Exception;
use Tempora\Enums\Path;
use Tempora\Utils\Cache\Cache;

class Image {
	public static function import(string $image): string {
		if (DEBUG) {
			$tempImagems = microtime(as_float: true);
		}

		if (!in_array(needle: pathinfo(path: $image, flags: PATHINFO_EXTENSION), haystack: ["jpg", "jpeg", "png", "svg", "gif", "webp"])) {
			throw new Exception(message: "Image format not supported: " . $image);
		}

		if (!is_dir(filename: Path::ASSETS_MIN->value . "/images")) {
			mkdir(directory: Path::ASSETS_MIN->value . "/images", recursive: true);
		}

		$imagePath = Path::ASSETS->value . "/images/" . $image;
		$cache = new Cache(file: "images.json");

		if (filemtime(filename: $imagePath) > ($cache->get()[$imagePath] ?? 0)) {
			foreach ($cache->get() as $cachedImage => $time) {
				$cache->add(name: $cachedImage, value: $time);
			}
			$cache->add(name: $imagePath, value: filemtime(filename: $imagePath));

			if (in_array(needle: pathinfo(path: $image, flags: PATHINFO_EXTENSION), haystack: ["svg", "gif", "webp"])) {
				copy(
					from: $imagePath,
					to: Path::ASSETS_MIN->value . "/images/" . $image
				);

				if (DEBUG) {
					array_push(
						$GLOBALS["chronos"]["images_ms"],
						[
							"file" => $imagePath,
							"time" => round(num: (microtime(as_float: true) - $tempImagems) *1000, precision: 3)
						]
					);
				}
			} else {
				$webpPath = Path::ASSETS_MIN->value . "/images/" . pathinfo(path: $image, flags: PATHINFO_FILENAME) . ".webp";

				if (!is_file(filename: $imagePath))
					throw new Exception(message: "Image file not found: " . $imagePath);

				imagewebp(
					image: imagecreatefromstring(
						data: file_get_contents(
							filename: $imagePath
						)
					),
					file: $webpPath,
					quality: 100
				);

				if (DEBUG) {
					array_push(
						$GLOBALS["chronos"]["images_ms"],
						[
							"file" => $webpPath,
							"time" => round(num: (microtime(as_float: true) - $tempImagems) *1000, precision: 3)
						]
					);
				}
			}
			$cache->create();
		}

		return "/assets/images/" . (in_array(needle: pathinfo(path: $image, flags: PATHINFO_EXTENSION), haystack: ["svg", "gif", "webp"]) ? $image : pathinfo(path: $image, flags: PATHINFO_FILENAME) . ".webp");
	}
}
