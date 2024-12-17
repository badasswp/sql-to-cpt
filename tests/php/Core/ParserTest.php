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

	public function test_sql_contains_file_path() {
		$this->parser = new Parser( '/var/www/html/wp-content/uploads/import.sql' );

		$this->assertSame( $this->parser->sql, '/var/www/html/wp-content/uploads/import.sql' );
	}
}
