<?php

namespace SqlToCpt\Tests\Services;

use Mockery;
use WP_Mock\Tools\TestCase;
use SqlToCpt\Services\Admin;
use SqlToCpt\Abstracts\Service;

/**
 * @covers \SqlToCpt\Services\Admin::register
 */
class AdminTest extends TestCase {
	public Admin $admin;

	public function setUp(): void {
		\WP_Mock::setUp();

		$this->admin = new Admin();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}

	public function test_register() {
		\WP_Mock::expectActionAdded( 'admin_menu', [ $this->admin, 'register_admin_menu' ] );

		$this->admin->register();

		$this->assertConditionsMet();
	}

	public function test_register_admin_menu() {
		\WP_Mock::userFunction( '__' )
			->andReturnUsing(
				function( $arg ) {
					return $arg;
				}
			);

		\WP_Mock::userFunction( 'add_menu_page' )
			->with(
				'SQL to CPT',
				'SQL to CPT',
				'manage_options',
				'sql-to-cpt',
				[ $this->admin, 'register_admin_page' ],
				'dashicons-database',
				90
			)
			->andReturn( null );

		$this->admin->register_admin_menu();

		$this->assertConditionsMet();
	}
}
