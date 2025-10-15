<?php

use PHPUnit\Framework\TestCase;
use Tempora\Utils\Render;

final class RenderTest extends TestCase {
	public function testRender(): void {
		$buffer = "<div>  <p>Test 123</p>  </div>\n<!-- Comment -->";
		$render = new Render(buffer: $buffer);

		$render->removeWhitespace();
		$this->assertEquals(expected: "<div><p>Test 123</p></div><!-- Comment -->", actual: $render->render());

		$render->removeComments();
		$this->assertEquals(expected: "<div><p>Test 123</p></div>", actual: $render->render());
	}
}
