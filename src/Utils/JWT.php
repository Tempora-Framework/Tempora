<?php

namespace Tempora\Utils;

use Exception;
use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\Key;
use PDO;
use Tempora\Enums\Table;
use Tempora\Exceptions\Codec\TemporaDecodeException;

class JWT extends FirebaseJWT {
	private array $data = [];

	/**
	 * Create JWT
	 *
	 * @return bool|string
	 */
	public function create(): bool | string {
		if (!isset($_SESSION["user"]["uid"])) {
			return false;
		}

		$jwt = $this->encode(
			payload: [
				"exp" => time() + 60 * 60 * 24 * 30,
				"data" => json_encode(value: $this->data)
			],
			key: $_ENV["JWT_PRIVATE_KEY"],
			alg: "HS256"
		);

		ApplicationData::request(
			query: "INSERT INTO " . Table::USER_TOKENS->value . " (uid, uid_user, ip_address, token) VALUES (:uid, :uid_user, :ip, :token)",
			data: [
				"uid" => System::uidGen(size: 16, table: Table::USER_TOKENS->value),
				"uid_user" => $_SESSION["user"]["uid"],
				"ip" => $_SERVER["REMOTE_ADDR"],
				"token" => $jwt
			]
		);

		return $jwt;
	}

	/**
	 * Return JWT's user UID
	 *
	 * @param string $token
	 *
	 * @return bool|string
	 */
	public function getUserUid(string $token): string | bool {
		if ($this->decodeData(token: $token) === false) {
			return false;
		}

		$uid = ApplicationData::request(
			query: "SELECT uid_user FROM " . Table::USER_TOKENS->value . " WHERE token = :token",
			data: [
				"token" => $token
			],
			returnType: PDO::FETCH_COLUMN,
			singleValue: true
		);

		if (!$uid) {
			return false;
		}

		return $uid;
	}

	/**
	 * Delete JWT from database
	 *
	 * @param string $token
	 *
	 * @return void
	 */
	public function delete(string $token): void {
		ApplicationData::request(
			query: "DELETE FROM " . Table::USER_TOKENS->value . " WHERE token = :token",
			data: [
				"token" => $token
			]
		);
	}

	/**
	 * Decore JWT data
	 *
	 * @param string $token
	 *
	 * @return array|bool
	 */
	public function decodeData(string $token): array | bool {
		try {
			$decoded = $this->decode(
				jwt: $token,
				keyOrKeyArray: new Key(keyMaterial: $_ENV["JWT_PRIVATE_KEY"], algorithm: "HS256")
			);

			if ($decoded->exp <= time()) {
				return false;
			}

			return json_decode(json: $decoded->data, associative: true);
		} catch (Exception $exception) {
			throw new TemporaDecodeException(message: "Failed to decode JWT: " . $exception->getMessage());
		}
	}

	/**
	 * Get the value of data
	 *
	 * @return array
	 */
	public function getData(): array {
		return $this->data;
	}

	/**
	 * Set the value of data
	 *
	 * @param array $data
	 *
	 * @return static
	 */
	public function setData(array $data): static {
		$this->data = $data;

		return $this;
	}
}
