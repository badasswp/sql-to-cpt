<?php

namespace SqlToCpt\Tests\Services;

use Mockery;
use WP_Mock\Tools\TestCase;
use SqlToCpt\Services\Boot;
use SqlToCpt\Abstracts\Service;

/**
 * @covers \SqlToCpt\Services\Boot::register
 * @covers \SqlToCpt\Services\Boot::register_translation
 * @covers \SqlToCpt\Services\Boot::register_mimes
 */
class BootTest extends TestCase {
	public Boot $boot;

	public function setUp(): void {
		\WP_Mock::setUp();

		$this->boot = new Boot();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}

	public function test_register() {
		\WP_Mock::expectActionAdded( 'init', [ $this->boot, 'register_translation' ] );
		\WP_Mock::expectFilterAdded( 'upload_mimes', [ $this->boot, 'register_mimes' ] );
		\WP_Mock::expectActionAdded( 'admin_enqueue_scripts', [ $this->boot, 'register_scripts' ] );

		$this->boot->register();

		$this->assertConditionsMet();
	}

	public function test_register_translation() {
		$boot = new \ReflectionClass( Boot::class );

		\WP_Mock::userFunction( 'plugin_basename' )
			->once()
			->with( $boot->getFileName() )
			->andReturn( '/inc/Services/Boot.php' );

		\WP_Mock::userFunction( 'load_plugin_textdomain' )
			->once()
			->with(
				'sql-to-cpt',
				false,
				'/inc/Services/../../languages'
			);

		$this->boot->register_translation();

		$this->assertConditionsMet();
	}

	public function test_register_mimes() {
		\WP_Mock::userFunction(
			'wp_parse_args',
			[
				'times'  => 1,
				'return' => function ( $args, $default ) {
					return array_merge( $default, $args );
				},
			]
		);

		$mimes = $this->boot->register_mimes(
			[
				'mp4'  => 'video/mp4',
				'html' => 'text/html',
				'json' => 'application/json',
				'jpeg' => 'image/jpeg',
				'pdf'  => 'application/pdf',
			]
		);

		$this->assertSame(
			$mimes,
			[
				'mp4'  => 'video/mp4',
				'html' => 'text/html',
				'json' => 'application/json',
				'jpeg' => 'image/jpeg',
				'pdf'  => 'application/pdf',
				'sql'  => 'application/octet-stream',
			]
		);
		$this->assertConditionsMet();
	}
}
