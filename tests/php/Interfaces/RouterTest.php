<?php

namespace SqlToCpt\Tests\Interfaces;

use Mockery;
use WP_Mock\Tools\TestCase;
use SqlToCpt\Interfaces\Router;

/**
 * @covers \SqlToCpt\Interfaces\Router::response
 * @covers \SqlToCpt\Interfaces\Router::request
 * @covers \SqlToCpt\Interfaces\Router::is_user_permissible
 */
class RouterTest extends TestCase {
	public Router $router;

	public function setUp(): void {
		\WP_Mock::setUp();

		$this->router = $this->getMockForAbstractClass( Router::class );
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}

	public function test_response() {
		$this->router->expects( $this->once() )
			->method( 'response' );

		$this->router->response();

		$this->assertConditionsMet();
	}

	public function test_request() {
		$this->router->expects( $this->once() )
			->method( 'request' );

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();

		$this->router->request( $request );

		$this->assertConditionsMet();
	}

	public function test_is_user_permissible() {
		$this->router->expects( $this->once() )
			->method( 'is_user_permissible' );

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();

		$this->router->is_user_permissible( $request );

		$this->assertConditionsMet();
	}
}
