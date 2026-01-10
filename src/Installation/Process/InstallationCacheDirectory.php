<?php

namespace Tempora\Installation\Process;

use Exception;
use Tempora\Installation\InstallationCheck;
use Throwable;

class InstallationCacheDirectory extends InstallationCheck {
	public string $title = "INSTALL_CACHE_PERMISSIONS";
	public bool $status = true;
	public string $message;
	private string $cacheDir = APP_DIR . "/src";

	private const string CACHE_SUBDIR = "/cache";

	public function __construct() {
		$realpath = realpath(path: $this->cacheDir);

		try {
			if (!is_dir(filename: $realpath . self::CACHE_SUBDIR)) {
				if (!@mkdir(directory: $realpath . self::CACHE_SUBDIR, permissions: 0755, recursive: true)) {
					throw new Exception(message: (error_get_last()["message"] ?? "INSTALL_CACHE_PERMISSIONS_MESSAGE") . " (" . $realpath . self::CACHE_SUBDIR . ")");
				}
			}
		} catch (Throwable $e) {
			$this->status = false;
			$this->message = $e->getMessage();
		}
	}
}
