<?php

namespace SqlToCpt\Tests\Core;

use Mockery;
use WP_Mock\Tools\TestCase;

use SqlToCpt\Core\Parser;

/**
 * @covers \SqlToCpt\Core\Parser::__construct
 * @covers \SqlToCpt\Core\Parser::get_sql_string
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

	public function test_get_sql_string_throws_exception() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->sql = '/var/www/html/wp-content/uploads/import.sql';

		\WP_Mock::userFunction( 'esc_url' )
			->with( '/var/www/html/wp-content/uploads/import.sql' )
			->andReturn( '/var/www/html/wp-content/uploads/import.sql' );

		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( 'Fatal Error: File does not exist: /var/www/html/wp-content/uploads/import.sql' );

		$parser->get_sql_string();

		$this->assertConditionsMet();
	}

	public function create_mock_file( $mock_file ) {
		file_put_contents( $mock_file, 'INSERT INTO `student` (`id`, `name`, `age`, `sex`, `email_address`, `date_created`) VALUES', FILE_APPEND );

		return $mock_file;
	}

	public function destroy_mock_file( $mock_file ) {
		if ( file_exists( $mock_file ) ) {
			unlink( $mock_file );
		}
	}
}
