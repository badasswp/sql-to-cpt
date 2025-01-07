<?php

namespace SqlToCpt\Tests\Core;

use Mockery;
use WP_Mock\Tools\TestCase;

use SqlToCpt\Core\Container;
use SqlToCpt\Services\Admin;
use SqlToCpt\Services\Boot;
use SqlToCpt\Services\Post;
use SqlToCpt\Services\Routes;
use SqlToCpt\Abstracts\Service;

/**
 * @covers \SqlToCpt\Core\Container::__construct
 * @covers \SqlToCpt\Core\Container::register
 * @covers \SqlToCpt\Abstracts\Service::get_instance
 * @covers \SqlToCpt\Services\Admin::register
 * @covers \SqlToCpt\Services\Boot::register
 * @covers \SqlToCpt\Services\Routes::register
 * @covers \SqlToCpt\Services\Post::register
 * @covers \SqlToCpt\Services\Post::__construct
 * @covers \SqlToCpt\Core\Post::__construct
 * @covers \SqlToCpt\Services\Routes::__construct
 */
class ContainerTest extends TestCase {
	public Container $container;

	public function setUp(): void {
		\WP_Mock::setUp();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}

	public function test_container_contains_required_services() {
		$this->container = new Container();

		$this->assertTrue( in_array( Admin::class, Container::$services, true ) );
		$this->assertTrue( in_array( Boot::class, Container::$services, true ) );
		$this->assertTrue( in_array( Post::class, Container::$services, true ) );
		$this->assertTrue( in_array( Routes::class, Container::$services, true ) );
	}

	public function test_register() {
		$container = new Container();

		\WP_Mock::userFunction( 'get_option' )
			->with( 'sql_to_cpt', [] )
			->andReturn(
				[
					'cpts' => [
						'student',
						'department',
					],
				]
			);

		\WP_Mock::expectFilter(
			'sqlt_cpt_post_types',
			[
				'student',
				'department',
			]
		);

		/**
		 * Hack around unset Service::$instances.
		 *
		 * We create instances of services so we can
		 * have a populated version of the Service abstraction's instances.
		 */
		foreach ( Container::$services as $service ) {
			$service::get_instance();
		}

		\WP_Mock::expectActionAdded(
			'admin_menu',
			[
				Service::$services[ Admin::class ],
				'register_admin_menu',
			]
		);

		\WP_Mock::expectActionAdded(
			'init',
			[
				Service::$services[ Boot::class ],
				'register_translation',
			]
		);

		\WP_Mock::expectFilterAdded(
			'upload_mimes',
			[
				Service::$services[ Boot::class ],
				'register_mimes',
			]
		);

		\WP_Mock::expectActionAdded(
			'admin_enqueue_scripts',
			[
				Service::$services[ Boot::class ],
				'register_scripts',
			]
		);

		\WP_Mock::expectActionAdded(
			'init',
			[
				Service::$services[ Post::class ],
				'register_post_types',
			]
		);

		\WP_Mock::expectActionAdded(
			'rest_api_init',
			[
				Service::$services[ Routes::class ],
				'register_rest_routes',
			]
		);

		$container->register();

		$this->assertConditionsMet();
	}
}
