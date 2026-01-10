<?php

namespace Tempora\Installation\Process;

use Exception;
use Tempora\Installation\InstallationCheck;
use Throwable;

class InstallationImagesDirectory extends InstallationCheck {
	public string $title = "INSTALL_IMAGES_PERMISSIONS";
	public bool $status = true;
	public string $message;
	private string $imagesDir = APP_DIR . "/public/assets";

	private const string IMAGES_SUBDIR = "/images";

	public function __construct() {
		$realpath = realpath(path: $this->imagesDir);

		try {
			if (!is_dir(filename: $realpath . self::IMAGES_SUBDIR)) {
				if (!@mkdir(directory: $realpath . self::IMAGES_SUBDIR, permissions: 0755, recursive: true)) {
					throw new Exception(message: (error_get_last()["message"] ?? "INSTALL_IMAGES_PERMISSIONS_MESSAGE") . " (" . $realpath . self::IMAGES_SUBDIR . ")");
				}
			}
		} catch (Throwable $e) {
			$this->status = false;
			$this->message = $e->getMessage();
		}
	}
}
