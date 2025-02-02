<?php

namespace SqlToCpt\Tests\Routes;

use Mockery;
use WP_Mock\Tools\TestCase;
use SqlToCpt\Routes\Parse;
use SqlToCpt\Abstracts\Service;

/**
 * @covers \SqlToCpt\Routes\Parse::is_sql
 * @covers \SqlToCpt\Routes\Parse::response
 * @covers \SqlToCpt\Routes\Parse::get_response
 * @covers \SqlToCpt\Abstracts\Route::get_400_response
 * @covers \SqlToCpt\Core\Parser::__construct
 * @covers \SqlToCpt\Core\Parser::get_parsed_sql
 * @covers \SqlToCpt\Core\Parser::get_sql_string
 * @covers \SqlToCpt\Core\Parser::get_sql_table_name
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

		$this->assertInstanceOf( \WP_REST_Response::class, $parse->response() );
		$this->assertConditionsMet();

		$this->destroy_mock_file( $sql_file );
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

	public function test_get_response_throws_exception(): array {
		$parse = Mockery::mock( Parse::class )->makePartial();
		$parse->shouldAllowMockingProtectedMethods();

		$parse->file = '';

		\WP_Mock::userFunction( 'esc_url' )
			->andReturnUsing(
				function ( $arg ) {
					return $arg;
				}
			);

		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( 'Fatal Error: File does not exist: ' );

		return $parse->get_response();
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
