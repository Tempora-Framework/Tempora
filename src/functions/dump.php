<?php

use Tempora\Utils\Dump;

function dump(mixed $variable = null): void {
	if (DEBUG == 1) {
		Dump::dump(variable: $variable);
	}
}
