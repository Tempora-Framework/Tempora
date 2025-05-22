<?php

namespace Tempora\Enums;

enum Path: string {
	case CACHE = APP_DIR . "/src/cache";
	case PUBLIC = APP_DIR . "/public";
	case COMPONENT_ACTIONS = APP_DIR . "/src/views/components/actions";
	case COMPONENT_CHRONOS = TEMPORA_DIR . "/src/views/components/chronos";
	case LAYOUT = TEMPORA_DIR . "/src/views/layouts";
	case ASSETS_MIN = APP_DIR . "/public/assets";
	case ASSETS = APP_DIR . "/src/assets";
}
