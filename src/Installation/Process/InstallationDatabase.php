<?php

namespace Tempora\Installation\Process;

use Exception;
use Tempora\Installation\InstallationCheck;
use Tempora\Models\Database;

class InstallationDatabase extends InstallationCheck {
	public string $title = "INSTALL_DATABASE";
	public bool $status = true;
	public string $message;

	public function __construct() {
		try {
			@$database = new Database;
			define(constant_name: "DATABASE", value: $database->getConnection());
		} catch (Exception $e) {
			$this->status = false;
			$this->message = $e->getMessage();
		}
	}
}
