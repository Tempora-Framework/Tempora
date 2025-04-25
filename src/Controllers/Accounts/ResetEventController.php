<?php

namespace App\Controllers\Accounts;

use App\Controllers\Controller;
use App\Models\Repositories\ResetPasswordRepository;
use App\Models\Repositories\UserRepository;
use App\Utils\Cookie;
use App\Utils\Lang;
use App\Utils\System;

class ResetEventController extends Controller {
	public function __invoke(): void {
		$pageData = $this->getPageData();

		if (
			System::checkCSRF()
			&& isset($_POST["new_password"])
			&& isset($_POST["new_password_confirm"])
		) {
			if ($_POST["new_password"] === $_POST["new_password_confirm"]) {
				$resetRepo = new ResetPasswordRepository;
				$resetRepo
					->setLink(link: $pageData["link"])
					->setUid()
				;

				$userRepo = new UserRepository;
				$userRepo
					->setUid(uid: $resetRepo->getUid())
					->setPassword(password: $_POST["new_password"])
				;

				$userRepo->savePassword();
				$resetRepo->removeResetLink();

				System::redirect(url: "/");
			} else {
				$notificationCookie = new Cookie;
				$notificationCookie
					->setName(name: "NOTIFICATION")
					->setValue(value: Lang::translate(key: "REGISTER_UNIDENTICAL_PASSWORD"))
				;
				$notificationCookie->send();
			}
		}

		System::redirect();
	}
}
