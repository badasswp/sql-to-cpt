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

	public function test_register_rest_routes() {
		\WP_Mock::onFilter( 'sqlt_cpt_rest_routes' )
			->with(
				[
					Parse::class,
					Import::class,
				]
			)
			->reply(
				[
					Import::class,
				]
			);

		$import = new Import();

		\WP_Mock::userFunction( 'register_rest_route' )
			->with(
				'sql-to-cpt/v1',
				'/import',
				[
					'methods'             => 'POST',
					'callback'            => [ $import, 'request' ],
					'permission_callback' => [ $import, 'is_user_permissible' ],
				]
			)
			->andReturn( null );

		$this->routes->register_rest_routes();

		$this->assertConditionsMet();
	}
}
