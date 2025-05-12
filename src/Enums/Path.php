<?php

namespace Tempora\Enums;

enum Path: string {
	case CACHE = APP_DIR . "/src/cache";
	case PUBLIC = APP_DIR . "/public";
	case COMPONENT_ACTIONS = APP_DIR . "/src/views/components/actions";
	case COMPONENT_CHRONOS = TEMPORA_DIR . "/src/views/components/chronos";
}
