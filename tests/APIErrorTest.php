<?php

use PHPUnit\Framework\TestCase;

final class APIErrorTest extends TestCase {

	/**
	 * Test EmptyArgs
	 * 
	 * @return void
	 */
	public function testEmptyArgs() : void {
		$post = curl_init(url: "http://template.local/api");
		curl_setopt(handle: $post, option: CURLOPT_RETURNTRANSFER, value: true);
		curl_setopt(handle: $post, option: CURLOPT_POSTFIELDS, value: http_build_query(["ask" => ""]));
		$httpCode = curl_getinfo(handle: $post, option: CURLINFO_HTTP_CODE);
		curl_close(handle: $post);

		$this->assertEquals(expected: 404, actual: $httpCode);
	}
}
