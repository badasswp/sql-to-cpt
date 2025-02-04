<?php

namespace SqlToCpt\Tests\Core;

use Mockery;
use WP_Mock\Tools\TestCase;

use SqlToCpt\Core\Parser;

/**
 * @covers \SqlToCpt\Core\Parser::get_sql_string
 * @covers \SqlToCpt\Core\Parser::get_sql_table_name
 * @covers \SqlToCpt\Core\Parser::get_sql_table_columns
 * @covers \SqlToCpt\Core\Parser::get_sql_table_rows
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

	public function test_get_sql_table_name_returns_empty_string_on_empty_string() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->shouldReceive( 'get_sql_string' )
			->andReturn( '' );

		\WP_Mock::expectFilter( 'sqlt_cpt_table_name', '' );

		$this->assertSame( $parser->get_sql_table_name(), '' );
		$this->assertConditionsMet();
	}

	public function test_get_sql_table_name_returns_empty_string_on_invalid_sql_string() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->shouldReceive( 'get_sql_string' )
			->andReturn( 'Invalid SQL string, no table name presented here.' );

		\WP_Mock::expectFilter( 'sqlt_cpt_table_name', '' );

		$this->assertSame( $parser->get_sql_table_name(), '' );
		$this->assertConditionsMet();
	}

	public function test_get_sql_table_columns() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->shouldReceive( 'get_sql_string' )
			->andReturn( 'INSERT INTO `student` (`id`, `name`, `age`, `sex`, `email_address`, `date_created`) VALUES' );

		\WP_Mock::expectFilter(
			'sqlt_cpt_table_columns',
			[
				'id',
				'name',
				'age',
				'sex',
				'email_address',
				'date_created',
			]
		);

		$this->assertSame(
			$parser->get_sql_table_columns(),
			[
				'id',
				'name',
				'age',
				'sex',
				'email_address',
				'date_created',
			]
		);
		$this->assertConditionsMet();
	}

	public function test_get_sql_table_columns_returns_empty_array_on_empty_string() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->shouldReceive( 'get_sql_string' )
			->andReturn( '' );

		$this->assertSame(
			$parser->get_sql_table_columns(),
			[]
		);
		$this->assertConditionsMet();
	}

	public function test_get_sql_table_columns_returns_empty_array_on_invalid_sql_string() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->shouldReceive( 'get_sql_string' )
			->andReturn( 'Invalid SQL string, no columns presented here.' );

		$this->assertSame(
			$parser->get_sql_table_columns(),
			[]
		);
		$this->assertConditionsMet();
	}

	public function test_get_sql_table_rows() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->shouldReceive( 'get_sql_string' )
			->andReturn(
				"INSERT INTO `student` (`id`, `name`, `age`, `sex`, `email_address`, `date_created`) VALUES
(1, 'Alice Smith', '20', 'Female', 'alice.smith@example.com', '2024-07-03 21:45:23');"
			);

		\WP_Mock::userFunction( 'sanitize_text_field' )
			->andReturnUsing(
				function ( $arg ) {
					return $arg;
				}
			);

		\WP_Mock::expectFilter(
			'sqlt_cpt_table_rows',
			[
				[
					'1',
					'Alice Smith',
					'20',
					'Female',
					'alice.smith@example.com',
					'2024-07-03 21:45:23',
				],
			]
		);

		$this->assertSame(
			$parser->get_sql_table_rows(),
			[
				[
					'1',
					'Alice Smith',
					'20',
					'Female',
					'alice.smith@example.com',
					'2024-07-03 21:45:23',
				],
			]
		);
		$this->assertConditionsMet();
	}

	public function test_get_sql_table_rows_returns_empty_array_on_empty_string() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->shouldReceive( 'get_sql_string' )
			->andReturn( 'Invalid SQL string, no rows presented here.' );

		$this->assertSame(
			$parser->get_sql_table_rows(),
			[]
		);
		$this->assertConditionsMet();
	}

	public function test_get_sql_table_rows_returns_empty_array_on_invalid_sql_string() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$parser->shouldReceive( 'get_sql_string' )
			->andReturn( '' );

		$this->assertSame(
			$parser->get_sql_table_rows(),
			[]
		);
		$this->assertConditionsMet();
	}

	public function test_get_parsed_sql() {
		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$sql_file = $this->create_sql_file( __DIR__ . '/import.sql' );

		\WP_Mock::expectFilter( 'sqlt_cpt_table_name', 'student' );

		\WP_Mock::expectFilter(
			'sqlt_cpt_table_columns',
			[
				'id',
				'name',
				'age',
				'sex',
				'email_address',
				'date_created',
			]
		);

		\WP_Mock::expectFilter(
			'sqlt_cpt_table_rows',
			[
				[
					'1',
					'Alice Smith',
					'20',
					'Female',
					'alice.smith@example.com',
					'2024-07-03 21:45:23',
				],
				[
					'2',
					'Bob Johnson',
					'21',
					'Male',
					'bob.johnson@example.com',
					'2024-07-03 21:45:23',
				],
				[
					'3',
					'Charlie Brown',
					'22',
					'Male',
					'charlie.brown@example.com',
					'2024-07-03 21:45:23',
				],
			]
		);

		\WP_Mock::userFunction( 'sanitize_text_field' )
			->andReturnUsing(
				function ( $arg ) {
					return $arg;
				}
			);

		$this->assertSame(
			$parser->get_parsed_sql( $sql_file ),
			[
				'tableName'    => 'student',
				'tableColumns' => [ 'id', 'name', 'age', 'sex', 'email_address', 'date_created' ],
				'tableRows'    => [
					[
						'1',
						'Alice Smith',
						'20',
						'Female',
						'alice.smith@example.com',
						'2024-07-03 21:45:23',
					],
					[
						'2',
						'Bob Johnson',
						'21',
						'Male',
						'bob.johnson@example.com',
						'2024-07-03 21:45:23',
					],
					[
						'3',
						'Charlie Brown',
						'22',
						'Male',
						'charlie.brown@example.com',
						'2024-07-03 21:45:23',
					],
				],
			]
		);
		$this->assertConditionsMet();

		$this->destroy_mock_file( __DIR__ . '/import.sql' );
	}

	public function create_mock_file( $mock_file ) {
		file_put_contents( $mock_file, 'INSERT INTO `student` (`id`, `name`, `age`, `sex`, `email_address`, `date_created`) VALUES', FILE_APPEND );

		return $mock_file;
	}

	public function create_sql_file( $sql_file ) {
		file_put_contents(
			$sql_file,
			"INSERT INTO `student` (`id`, `name`, `age`, `sex`, `email_address`, `date_created`) VALUES
			(1, 'Alice Smith', '20', 'Female', 'alice.smith@example.com', '2024-07-03 21:45:23'),
			(2, 'Bob Johnson', '21', 'Male', 'bob.johnson@example.com', '2024-07-03 21:45:23'),
			(3, 'Charlie Brown', '22', 'Male', 'charlie.brown@example.com', '2024-07-03 21:45:23');",
			FILE_APPEND
		);

		return $sql_file;
	}

	public function destroy_mock_file( $mock_file ) {
		if ( file_exists( $mock_file ) ) {
			unlink( $mock_file );
		}
	}
}
