<?php

namespace SqlToCpt\Tests\Routes;

use Mockery;
use WP_Mock\Tools\TestCase;
use SqlToCpt\Routes\Parse;
use SqlToCpt\Abstracts\Service;

/**
 * @covers \SqlToCpt\Routes\Parse::response
 * @covers \SqlToCpt\Abstracts\Route::get_400_response
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

		$response = $parse->response();

		$this->assertInstanceOf( \WP_Error::class, $response );
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
