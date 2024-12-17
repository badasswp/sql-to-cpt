<?php

namespace SqlToCpt\Tests\Core;

use Mockery;
use WP_Mock\Tools\TestCase;

use SqlToCpt\Core\Parser;

/**
 * @covers \SqlToCpt\Core\Parser::__construct
 */
class ParserTest extends TestCase {
	public Parser $parser;

	public function setUp(): void {
		\WP_Mock::setUp();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}
}
