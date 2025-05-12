<?php

namespace Tempora\Enums;

enum Table: string {
	case USERS = "users";
	case ROLES = "roles";
	case USER_ROLE = "user_role";
	case USER_TOKENS = "user_tokens";
	case USER_RESET_PASSWORD = "user_reset_password";
}
