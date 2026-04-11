<?php

namespace SqlToCpt\Tests\Routes;

use Mockery;
use WP_Mock\Tools\TestCase;

use SqlToCpt\Core\Parser;
use SqlToCpt\Routes\Parse;
use SqlToCpt\Abstracts\Service;

/**
 * @covers \SqlToCpt\Routes\Parse::is_sql
 * @covers \SqlToCpt\Routes\Parse::response
 * @covers \SqlToCpt\Routes\Parse::get_response
 * @covers \SqlToCpt\Abstracts\Route::get_400_response
 * @covers \SqlToCpt\Core\Parser::get_parsed_sql
 * @covers \SqlToCpt\Core\Parser::get_sql_string
 * @covers \SqlToCpt\Core\Parser::get_sql_table_name
 * @covers \SqlToCpt\Core\Parser::get_sql_table_columns
 * @covers \SqlToCpt\Core\Parser::get_sql_table_rows
 */
class ParseTest extends TestCase {
	public Parse $parse;

	public function setUp(): void {
		\WP_Mock::setUp();

		$this->parse = new Parse();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}

	public function test_route_initial_values() {
		$this->assertSame( $this->parse->method, 'POST' );
		$this->assertSame( $this->parse->endpoint, '/parse' );
	}

	public function test_response_bails_out_if_file_does_not_exist() {
		$parse = Mockery::mock( Parse::class )->makePartial();
		$parse->shouldAllowMockingProtectedMethods();

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		$request->shouldReceive( 'get_json_params' )
			->andReturn(
				[
					'id' => '',
				]
			);

		\WP_Mock::userFunction( 'get_attached_file' )
			->with( '' )
			->andReturn( false );

		$parse->request = $request;

		$this->assertInstanceOf( \WP_Error::class, $parse->response() );
		$this->assertConditionsMet();
	}

	public function test_response_bails_out_if_file_is_not_sql() {
		$txt_file = __DIR__ . '/import.txt';
		$this->create_mock_file( $txt_file );

		$parse = Mockery::mock( Parse::class )->makePartial();
		$parse->shouldAllowMockingProtectedMethods();

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		$request->shouldReceive( 'get_json_params' )
			->andReturn(
				[
					'id' => 1,
				]
			);

		$parse->request = $request;

		\WP_Mock::userFunction( 'get_attached_file' )
			->with( 1 )
			->andReturn( $txt_file );

		$parse->shouldReceive( 'is_sql' )
			->with( $txt_file )
			->andReturnUsing(
				function ( $path ) {
					return 'sql' === pathinfo( $path, PATHINFO_EXTENSION );
				}
			);

		$this->assertInstanceOf( \WP_Error::class, $parse->response() );
		$this->assertConditionsMet();

		$this->destroy_mock_file( $txt_file );
	}

	public function test_response_passes_correctly() {
		$sql_file = __DIR__ . '/import.sql';
		$this->create_mock_file( $sql_file );

		$parse = Mockery::mock( Parse::class )->makePartial();
		$parse->shouldAllowMockingProtectedMethods();

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		$rest_response = Mockery::mock( \WP_REST_Response::class )->makePartial();
		$rest_response->shouldAllowMockingProtectedMethods();

		$request->shouldReceive( 'get_json_params' )
			->andReturn(
				[
					'id' => 1,
				]
			);

		$parse->request = $request;

		\WP_Mock::userFunction( 'get_attached_file' )
			->with( 1 )
			->andReturn( $sql_file );

		$parse->shouldReceive( 'is_sql' )
			->with( $sql_file )
			->andReturnUsing(
				function ( $path ) {
					return 'sql' === pathinfo( $path, PATHINFO_EXTENSION );
				}
			);

		$parse->shouldReceive( 'get_response' )
			->andReturn(
				[
					'tableName'    => 'student',
					'tableColumns' => [ 'id', 'name', 'age', 'sex', 'email_address', 'date_created' ],
					'tableRows'    => [
						[ 1, 'John Doe', 37, 'M', 'john@doe.com', '00:00:00' ],
					],
				]
			);

		\WP_Mock::userFunction( 'rest_ensure_response' )
			->once()
			->with(
				[
					'tableName'    => 'student',
					'tableColumns' => [ 'id', 'name', 'age', 'sex', 'email_address', 'date_created' ],
					'tableRows'    => [
						[ 1, 'John Doe', 37, 'M', 'john@doe.com', '00:00:00' ],
					],
				]
			)
			->andReturn( $rest_response );

		$this->assertInstanceOf( \WP_REST_Response::class, $parse->response() );
		$this->assertConditionsMet();

		$this->destroy_mock_file( $sql_file );
	}

	public function test_get_response_catches_exception_and_returns_wp_error() {
		$parse = Mockery::mock( Parse::class )->makePartial();
		$parse->shouldAllowMockingProtectedMethods();

		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$wp_error = Mockery::mock( \WP_Error::class )->makePartial();
		$wp_error->shouldAllowMockingProtectedMethods();

		$parse->file = '';

		$parse->shouldReceive( 'get_400_response' )
			->andReturn( $wp_error );

		$response = $parse->get_response( $parser );

		$this->assertInstanceOf( \WP_Error::class, $response );
		$this->assertConditionsMet();
	}

	public function test_get_response_passes_and_returns_parsed_sql_data_in_array() {
		$parse = Mockery::mock( Parse::class )->makePartial();
		$parse->shouldAllowMockingProtectedMethods();

		$parser = Mockery::mock( Parser::class )->makePartial();
		$parser->shouldAllowMockingProtectedMethods();

		$sql_file = $this->create_sql_file( __DIR__ . '/import.sql' );

		$parse->file = $sql_file;

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

		$parsed_sql_data = $parse->get_response( $parser );

		$this->assertSame(
			$parsed_sql_data,
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

	public function test_is_sql_returns_true() {
		$file_path = '/var/www/html/wp-content/uploads/import.sql';

		$parse = Mockery::mock( Parse::class )->makePartial();
		$parse->shouldAllowMockingProtectedMethods();

		\WP_Mock::userFunction( 'wp_check_filetype' )
			->with( $file_path )
			->andReturnUsing(
				function ( $path ) {
					return [
						'ext' => pathinfo( $path, PATHINFO_EXTENSION ),
					];
				}
			);

		$this->assertTrue( $parse->is_sql( $file_path ) );
		$this->assertConditionsMet();
	}

	public function test_is_sql_returns_false() {
		$file_path = '/var/www/html/wp-content/uploads/import.txt';

		$parse = Mockery::mock( Parse::class )->makePartial();
		$parse->shouldAllowMockingProtectedMethods();

		\WP_Mock::userFunction( 'wp_check_filetype' )
			->with( $file_path )
			->andReturnUsing(
				function ( $path ) {
					return [
						'ext' => pathinfo( $path, PATHINFO_EXTENSION ),
					];
				}
			);

		$this->assertFalse( $parse->is_sql( $file_path ) );
		$this->assertConditionsMet();
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
