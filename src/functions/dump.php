<?php

use Tempora\Utils\Dump;

function dump(mixed $variable = null): void {
	if (DEBUG) {
		Dump::dump(variable: $variable);
	}
}
