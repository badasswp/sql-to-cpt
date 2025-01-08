<?php

namespace SqlToCpt\Tests\Core;

use Mockery;
use WP_Mock\Tools\TestCase;

use SqlToCpt\Core\Parser;

/**
 * @covers \SqlToCpt\Core\Parser::__construct
 * @covers \SqlToCpt\Core\Parser::get_sql_string
 * @covers \SqlToCpt\Core\Parser::get_sql_table_name
 * @covers \SqlToCpt\Core\Parser::get_sql_table_columns
 * @covers \SqlToCpt\Core\Parser::get_parsed_sql
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

	public function test_get_sql_returns_file_contents() {
		$sql_file = __DIR__ . '/import.sql';
		$this->create_mock_file( $sql_file );

		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->sql = $sql_file;

		$this->assertSame( $parser->get_sql_string(), 'INSERT INTO `student` (`id`, `name`, `age`, `sex`, `email_address`, `date_created`) VALUES' );
		$this->assertConditionsMet();

		$this->destroy_mock_file( $sql_file );
	}

	public function test_get_sql_table_name() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->shouldReceive( 'get_sql_string' )
			->andReturn( 'INSERT INTO `student` (`id`, `name`, `age`, `sex`, `email_address`, `date_created`) VALUES' );

		\WP_Mock::expectFilter( 'sqlt_cpt_table_name', 'student' );

		$this->assertSame( $parser->get_sql_table_name(), 'student' );
		$this->assertConditionsMet();
	}

	public function test_get_sql_table_columns() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->shouldReceive( 'get_sql_string' )
			->andReturn( 'INSERT INTO `student` (`id`, `name`, `age`, `sex`, `email_address`, `date_created`) VALUES' );

		\WP_Mock::expectFilter( 'sqlt_cpt_table_columns', [ 'id', 'name', 'age', 'sex', 'email_address', 'date_created' ] );

		$this->assertSame( $parser->get_sql_table_columns(), [ 'id', 'name', 'age', 'sex', 'email_address', 'date_created' ] );
		$this->assertConditionsMet();
	}

	public function test_get_parsed_sql() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->shouldReceive( 'get_sql_table_name' )
			->once()->andReturn( 'student' );

		$parser->shouldReceive( 'get_sql_table_columns' )
			->once()->andReturn( [ 'id', 'name', 'age', 'sex', 'email_address', 'date_created' ] );

		$parser->shouldReceive( 'get_sql_table_rows' )
			->once()->andReturn( [] );

		$this->assertSame(
			$parser->get_parsed_sql(),
			[
				'tableName'    => 'student',
				'tableColumns' => [ 'id', 'name', 'age', 'sex', 'email_address', 'date_created' ],
				'tableRows'    => [],
			]
		);
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
