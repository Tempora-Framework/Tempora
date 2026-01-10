<?php

namespace Tempora\Installation\Process;

use Exception;
use Tempora\Installation\InstallationCheck;
use Throwable;

class InstallationAssetsDirectory extends InstallationCheck {
	public string $title = "INSTALL_ASSETS_PERMISSIONS";
	public bool $status = true;
	public string $message;
	private string $assetsDir = APP_DIR . "/public";

	private const string ASSETS_SUBDIR = "/assets";

	public function __construct() {
		$realpath = realpath(path: $this->assetsDir);

		try {
			if (!is_dir(filename: $realpath . self::ASSETS_SUBDIR)) {
				if (!@mkdir(directory: $realpath . self::ASSETS_SUBDIR, permissions: 0755, recursive: true)) {
					throw new Exception(message: (error_get_last()["message"] ?? "INSTALL_ASSETS_PERMISSIONS_MESSAGE") . " (" . $realpath . self::ASSETS_SUBDIR . ")");
				}
			}
		} catch (Throwable $e) {
			$this->status = false;
			$this->message = $e->getMessage();
		}
	}
}
