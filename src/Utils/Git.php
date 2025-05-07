<?php

namespace Tempora\Utils;

class Git {

	/**
	 * Get current git branch
	 *
	 * @return string
	 */
	public static function getBranch(): string {
		if (!is_dir(filename: APP_DIR . "/.git/"))
			return "";

		$fname = sprintf(format: APP_DIR . "/.git/HEAD");
		$data = file_get_contents(filename: $fname);
		$ar = explode(separator: "/", string: $data);
		$ar = array_reverse(array: $ar);

		return trim(string: "" . @$ar[0]);
	}

	/**
	 * Get current git commit
	 *
	 * @return string
	 */
	public static function getCommit(): string {
		if (!is_dir(filename: APP_DIR . "/.git/"))
			return "";

		$path = sprintf(format: APP_DIR . "/.git/");
		$head = trim(string: substr(string: file_get_contents(filename: $path . "HEAD"), offset: 4));
		$hash = trim(string: file_get_contents(filename: sprintf(format: $path . $head)));

		return $hash;
	}

	/**
	 * Get git remote URL
	 *
	 * @return string
	 */
	public static function getRemoteUrl(): string {
		if (!is_dir(filename: APP_DIR . "/.git/"))
			return "";

		$config = file_get_contents(filename: APP_DIR . "/.git/config");
		preg_match(pattern: '/\[remote "origin"\]\s*url = (.+)/', subject: $config, matches: $matches);

		return $matches[1] ?? "";
	}

	/**
	 * Recreate repository URL
	 *
	 * @return string
	 */
	public static function getRepoUrl(): string {
		$remoteUrl = self::getRemoteUrl();
		$branch = self::getBranch();

		if (empty($remoteUrl) || empty($branch))
			return "";

		if (preg_match(pattern: '/^git@(.+):(.+)\/(.+)\.git$/', subject: $remoteUrl, matches: $matches)) {
			$remoteUrl = "https://" . $matches[1] . "/" . $matches[2] . "/" . $matches[3];
		}

		$remoteUrl = preg_replace(pattern: '/\.git$/', replacement: '', subject: $remoteUrl);

		return $remoteUrl;
	}
}
