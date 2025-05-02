<?php

namespace App\Enums;

enum Path: string {
	case CACHE = BASE_DIR . "/src/cache";
	case PUBLIC = BASE_DIR . "/public";
	case LAYOUT = BASE_DIR . "/src/views/layouts";
	case COMPONENT_ACTIONS = BASE_DIR . "/src/views/components/actions";
	case COMPONENT_FORMS = BASE_DIR . "/src/views/components/forms";
	case COMPONENT_TOOLBAR = BASE_DIR . "/src/views/components/toolbar";
}
