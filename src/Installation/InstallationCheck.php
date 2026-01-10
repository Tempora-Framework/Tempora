<?php

namespace Tempora\Installation;

abstract class InstallationCheck {
	public string $title;
	public string $message;
	public bool $status = true;

	abstract public function __construct();
}
