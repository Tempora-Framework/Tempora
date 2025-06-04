<?php

namespace Tempora\Utils\Minifier;

use Tempora\Enums\Path;

class Image {
	public static function import(string $image): string {
		if (!is_dir(filename: Path::ASSETS_MIN->value . "/images")) {
			mkdir(directory: Path::ASSETS_MIN->value . "/images", recursive: true);
		}

		$webpPath = Path::ASSETS_MIN->value . "/images/" . pathinfo(path: $image, flags: PATHINFO_FILENAME) . ".webp";

		if (!is_file(filename: $webpPath)) {
			if (!is_file(filename: Path::ASSETS->value . "/images/" . $image))
				throw new \Exception(message: "Image file not found: " . Path::ASSETS->value . "/images/" . $image);

			imagewebp(
				image: imagecreatefromstring(
					data: file_get_contents(
						filename: Path::ASSETS->value . "/images/" . $image
					)
				),
				file: $webpPath,
				quality: 100
			);
		}

		return "/assets/images/" . pathinfo(path: $image, flags: PATHINFO_FILENAME) . ".webp";
	}
}
