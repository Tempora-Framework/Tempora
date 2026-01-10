<?php

namespace Tempora\Installation\Process;

use Dotenv\Dotenv;
use Tempora\Installation\InstallationCheck;
use Throwable;

class InstallationEnv extends InstallationCheck {
	public string $title = "INSTALL_ENV";
	public bool $status = true;
	public string $message = "INSTALL_MISSING_ENV";

	public function __construct() {
		try {
			if (!is_file(filename: APP_DIR . "/.env")) {
				$this->status = false;
			} else {
				Dotenv::createImmutable(paths: APP_DIR)->load();
			}
		} catch (Throwable $e) {
			$this->status = false;
		}
	}
}
