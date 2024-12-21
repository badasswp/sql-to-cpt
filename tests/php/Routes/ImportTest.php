<?php

namespace SqlToCpt\Tests\Routes;

use Mockery;
use WP_Mock\Tools\TestCase;
use SqlToCpt\Routes\Import;
use SqlToCpt\Abstracts\Service;

/**
 * @covers \SqlToCpt\Routes\Import::response
 * @covers \SqlToCpt\Abstracts\Route::get_400_response
 */
class ImportTest extends TestCase {
	public Import $import;

	public function setUp(): void {
		\WP_Mock::setUp();

		$this->import = new Import();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}

	public function test_route_initial_values() {
		$this->assertSame( $this->import->method, 'POST' );
		$this->assertSame( $this->import->endpoint, '/import' );
	}

	public function test_response_bails_out_on_empty_table_name() {
		$import = Mockery::mock( Import::class )->makePartial();
		$import->shouldAllowMockingProtectedMethods();

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		$request->shouldReceive( 'get_json_params' )
			->andReturn(
				[
					'tableName'    => '',
					'tableRows'    => [],
					'tableColumns' => [],
				]
			);

		$import->request = $request;

		$response = $import->response();

		$this->assertInstanceOf( \WP_Error::class, $response );
		$this->assertConditionsMet();
	}

	public function test_response_bails_out_on_empty_column_names() {
		$import = Mockery::mock( Import::class )->makePartial();
		$import->shouldAllowMockingProtectedMethods();

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		$request->shouldReceive( 'get_json_params' )
			->andReturn(
				[
					'tableName'    => 'student',
					'tableColumns' => [],
					'tableRows'    => [],
				]
			);

		\WP_Mock::userFunction(
			'wp_json_encode',
			[
				'times'  => 1,
				'return' => function ( $arg ) {
					return json_encode( $arg );
				},
			]
		);

		$import->request = $request;

		$response = $import->response();

		$this->assertInstanceOf( \WP_Error::class, $response );
		$this->assertConditionsMet();
	}

	public function test_response_bails_out_on_empty_row_values() {
		$import = Mockery::mock( Import::class )->makePartial();
		$import->shouldAllowMockingProtectedMethods();

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		$request->shouldReceive( 'get_json_params' )
			->andReturn(
				[
					'tableName'    => 'student',
					'tableColumns' => [ 'id', 'name', 'age', 'sex', 'email_address', 'date_created' ],
					'tableRows'    => [],
				]
			);

		\WP_Mock::userFunction(
			'wp_json_encode',
			[
				'times'  => 1,
				'return' => function ( $arg ) {
					return json_encode( $arg );
				},
			]
		);

		$import->request = $request;

		$response = $import->response();

		$this->assertInstanceOf( \WP_Error::class, $response );
		$this->assertConditionsMet();
	}

	public function test_response_passes_correctly() {
		$import = Mockery::mock( Import::class )->makePartial();
		$import->shouldAllowMockingProtectedMethods();

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		$request->shouldReceive( 'get_json_params' )
			->andReturn(
				[
					'tableName'    => 'student',
					'tableColumns' => [ 'id', 'name', 'age', 'sex', 'email_address', 'date_created' ],
					'tableRows'    => [
						[ 1, 'John Doe', 37, 'M', 'john@doe.com', '00:00:00' ],
					],
				]
			);

		$import->request = $request;

		$import->shouldReceive( 'get_response' )
			->andReturn(
				sprintf(
					'https://example.com/wp-admin/edit.php?%s',
					http_build_query(
						[
							'post_type' => 'post',
						]
					)
				)
			);

		Mockery::mock( \WP_REST_Response::class )->makePartial();

		$response = $import->response();

		$this->assertInstanceOf( \WP_REST_Response::class, $response );
		$this->assertConditionsMet();
	}
}
