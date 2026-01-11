<?php

namespace Tempora\Installation;

use Tempora\Controllers\InstallController;
use Tempora\Router;
use Tempora\Utils\Render\Modules\RenderCollapseSpacesModule;
use Tempora\Utils\Render\Modules\RenderRemoveCommentsModule;
use Tempora\Utils\Render\Modules\RenderRemoveEmptyLinesModule;
use Tempora\Utils\Render\Modules\RenderRemoveNewLinesModule;
use Tempora\Utils\Render\Modules\RenderRemoveTrailingWhitespaceModule;
use Tempora\Utils\Render\Modules\RenderRemoveWhitespaceBetweenTagsModule;
use Tempora\Utils\Render\Render;

class Installation {
	protected array $steps = [];

	public function __construct(array $checks = []) {
		foreach ($checks as $check) {
			if ($check->status === false) {
				$this->steps[] = [
					"status" => false,
					"title" => $check->title,
					"message" => $check->message
				];
			} else {
				$this->steps[] = [
					"status" => true,
					"title" => $check->title
				];
			}
		}

		if (
			!$this->checkInstallation()
			&& (
				(
					!empty($_ENV)
					&& $_ENV["DEBUG"]
				)
				|| (
					empty($_ENV)
				)
			)
		) {
			$this->render();
		} else {
			if (!$this->checkInstallation()) {
				Router::error(
					pageData: [
						"page_title" => "Tempora - Installation Required",
						"error_code" => 503,
						"error_message" => "The application is not properly installed."
					]
				);

				exit;
			}
		}
	}

	private function checkInstallation(): bool {
		$status = true;

		foreach ($this->steps as $step) {
			if ($step["status"] === false) {
				$status = false;

				break;
			}
		}

		return $status;
	}

	private function render(): void {
		$pageData = [
			"install_needed" => $this->steps
		];

		echo (new Render(
			buffer: (function (array $pageData): string {
				ob_start();

				(new InstallController)
					->setPageData(pageData: $pageData)
					->render()
				;

				return ob_get_clean();
			})(pageData: $pageData),
			modules: [
				new RenderRemoveWhitespaceBetweenTagsModule,
				new RenderRemoveTrailingWhitespaceModule,
				new RenderRemoveEmptyLinesModule,
				new RenderCollapseSpacesModule,
				new RenderRemoveNewLinesModule,
				new RenderRemoveCommentsModule
			],
			pageData: $pageData
		))->render();

		exit;
	}
}
