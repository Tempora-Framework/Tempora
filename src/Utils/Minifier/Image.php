<?php

namespace Tempora\Utils\Minifier;

use Tempora\Enums\Path;
use Tempora\Exceptions\FileSystem\TemporaExistingFileException;
use Tempora\Exceptions\FileSystem\TemporaFormatFileException;
use Throwable;

class Image {
	public static function import(string $image): string {
		if (DEBUG) {
			$tempImagems = microtime(as_float: true);
		}

		if (!in_array(needle: pathinfo(path: $image, flags: PATHINFO_EXTENSION), haystack: ["jpg", "jpeg", "png", "svg", "gif", "webp"])) {
			throw new TemporaFormatFileException(message: "Image format not supported: " . $image);
		}

		if (!is_dir(filename: Path::APP_ASSETS_MIN->value . "/images")) {
			mkdir(directory: Path::APP_ASSETS_MIN->value . "/images", recursive: true);
		}

		$imagePath = Path::APP_ASSETS->value . "/images/" . $image;

		$minFileTimestamp = 0;

		try {
			$minFileTimestamp = filemtime(filename: Path::APP_ASSETS_MIN->value . "/images/" . pathinfo(path: $image, flags: PATHINFO_FILENAME) . (in_array(needle: pathinfo(path: $image, flags: PATHINFO_EXTENSION), haystack: ["svg", "gif", "webp"]) ? "." . pathinfo(path: $image, flags: PATHINFO_EXTENSION) : ".webp"));
		} catch (Throwable $e) {
		}

		if (filemtime(filename: $imagePath) > $minFileTimestamp) {
			if (in_array(needle: pathinfo(path: $image, flags: PATHINFO_EXTENSION), haystack: ["svg", "gif", "webp"])) {
				copy(
					from: $imagePath,
					to: Path::APP_ASSETS_MIN->value . "/images/" . $image
				);

				if (DEBUG) {
					array_push(
						$GLOBALS["chronos"]["images_ms"],
						[
							"file" => $imagePath,
							"time" => round(num: (microtime(as_float: true) - $tempImagems) * 1000, precision: 3)
						]
					);
				}
			} else {
				$webpPath = Path::APP_ASSETS_MIN->value . "/images/" . pathinfo(path: $image, flags: PATHINFO_FILENAME) . ".webp";

				if (!is_file(filename: $imagePath)) {
					throw new TemporaExistingFileException(message: "Image file not found: " . $imagePath);
				}

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
							"time" => round(num: (microtime(as_float: true) - $tempImagems) * 1000, precision: 3)
						]
					);
				}
			}
		}

		return "/assets/images/" . (in_array(needle: pathinfo(path: $image, flags: PATHINFO_EXTENSION), haystack: ["svg", "gif", "webp"]) ? $image : pathinfo(path: $image, flags: PATHINFO_FILENAME) . ".webp");
	}
}
