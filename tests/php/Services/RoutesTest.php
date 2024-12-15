<?php

namespace SqlToCpt\Tests\Services;

use Mockery;
use WP_Mock\Tools\TestCase;

use SqlToCpt\Routes\Parse;
use SqlToCpt\Routes\Import;
use SqlToCpt\Services\Routes;
use SqlToCpt\Abstracts\Route;
use SqlToCpt\Abstracts\Service;

/**
 * @covers \SqlToCpt\Services\Routes::register
 * @covers \SqlToCpt\Services\Routes::register_rest_routes
 * @covers \SqlToCpt\Services\Routes::__construct
 */
class RoutesTest extends TestCase {
	public Routes $routes;

	public function setUp(): void {
		\WP_Mock::setUp();

		$this->routes = new Routes();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}

	public function test_register() {
		\WP_Mock::expectActionAdded( 'rest_api_init', [ $this->routes, 'register_rest_routes' ] );

		$this->routes->register();

		$this->assertConditionsMet();
	}

	public function test_service_contains_routes_at_instantiation() {
		$this->assertSame(
			$this->routes->routes,
			[
				Parse::class,
				Import::class,
			]
		);

		$this->assertConditionsMet();
	}
}
