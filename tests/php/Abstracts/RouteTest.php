<?php

namespace SqlToCpt\Tests\Abstracts;

use Mockery;
use WP_Mock\Tools\TestCase;
use SqlToCpt\Abstracts\Route;

/**
 * @covers \SqlToCpt\Abstracts\Route::request
 * @covers \SqlToCpt\Abstracts\Route::register_route
 * @covers \SqlToCpt\Abstracts\Route::get_400_response
 * @covers \SqlToCpt\Abstracts\Route::is_user_permissible
 */
class RouteTest extends TestCase {
	public Route $route;

	public function setUp(): void {
		\WP_Mock::setUp();

		$this->route = new ConcreteRoute();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}

	public function test_request_returns_response() {
		$request  = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$response = $this->route->request( $request );

		$this->assertInstanceOf( \WP_REST_Request::class, $response );
	}

	public function test_register_route() {
		\WP_Mock::userFunction( 'register_rest_route' )
			->with(
				'sql-to-cpt/v1',
				'test-register-route',
				[
					'methods'             => 'POST',
					'callback'            => [ $this->route, 'request' ],
					'permission_callback' => [ $this->route, 'is_user_permissible' ],
				]
			)
			->andReturn( null );

		$route = $this->route->register_route();

		$this->assertConditionsMet();
	}

	public function test_get_400_response() {
		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		$request->shouldReceive( 'get_json_params' )
			->andReturn(
				[
					'id' => 1,
				]
			);

		$this->route->request = $request;

		$error = Mockery::mock( \WP_Error::class )->makePartial();
		$error->shouldAllowMockingProtectedMethods();

		$error->shouldReceive( '__construct' )
			->with(
				'sql-to-cpt-bad-request',
				'Fatal Error: Bad Request, Something went terribly wrong...',
				[
					'status'  => 400,
					'request' => [
						'id' => 1,
					],
				]
			);

		$error_response = $this->route->get_400_response( 'Something went terribly wrong...' );

		$this->assertInstanceOf( \WP_Error::class, $error_response );
		$this->assertConditionsMet();
	}

	public function test_is_user_permissible_returns_error_if_not_administrator() {
		\WP_Mock::userFunction( 'rest_authorization_required_code' )
			->andReturn( 403 );

		\WP_Mock::userFunction( 'current_user_can' )
			->with( 'administrator' )
			->andReturn( false );

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		$request->shouldReceive( 'get_json_params' )
			->andReturn(
				[
					'id' => 1,
				]
			);

		$this->assertInstanceOf(
			\WP_Error::class,
			$this->route->is_user_permissible( $request )
		);
	}

	public function test_is_user_permissible_returns_error_if_nonce_fails() {
		\WP_Mock::userFunction( 'rest_authorization_required_code' )
			->andReturn( 403 );

		\WP_Mock::userFunction( 'current_user_can' )
			->with( 'administrator' )
			->andReturn( true );

		\WP_Mock::userFunction( 'wp_verify_nonce' )
			->with( 'a8ceg59jeqwvk', 'wp_rest' )
			->andReturn( false );

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		$request->shouldReceive( 'get_header' )
			->with( 'X-WP-Nonce' )
			->andReturn( 'a8ceg59jeqwvk' );

		$this->assertInstanceOf(
			\WP_Error::class,
			$this->route->is_user_permissible( $request )
		);
	}
}

class ConcreteRoute extends Route {
	public function __construct() {
		$this->method   = 'POST';
		$this->endpoint = 'test-register-route';
	}

	public function response() {
		return $this->request;
	}
}
