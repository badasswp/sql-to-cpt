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
 * @covers \SqlToCpt\Services\Boot::register_scripts
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

	public function test_register_scripts_bails_out_if_screen_is_null() {
		$screen = null;

		\WP_Mock::userFunction( 'get_current_screen' )
			->andReturn( $screen );

		$this->assertConditionsMet();
	}

	public function test_register_scripts_bails_out_if_it_is_not_an_object() {
		$screen = 1;

		\WP_Mock::userFunction( 'get_current_screen' )
			->andReturn( $screen );

		$this->assertConditionsMet();
	}

	public function test_register_scripts_bails_out_if_it_is_not_plugin_page() {
		$screen = Mockery::mock( \WP_Screen::class )->makePartial();
		$screen->shouldAllowMockingProtectedMethods();

		$screen->id = 'toplevel_page_hello-world';

		\WP_Mock::userFunction( 'get_current_screen' )
			->andReturn( $screen );

		$this->assertConditionsMet();
	}

	public function test_register_scripts() {
		$screen = Mockery::mock( \WP_Screen::class )->makePartial();
		$screen->shouldAllowMockingProtectedMethods();

		$screen->id = 'toplevel_page_sql-to-cpt';

		\WP_Mock::userFunction( 'get_current_screen' )
			->andReturn( $screen );

		$boot = new \ReflectionClass( Boot::class );

		\WP_Mock::userFunction( 'plugin_dir_url' )
			->with( $boot->getFileName() )
			->andReturn( 'https://example.com/wp-content/plugins/sql-to-cpt/inc/Services/Boot.php' );

		\WP_Mock::userFunction( 'plugin_dir_path' )
			->with( $boot->getFileName() )
			->andReturn( '/var/www/html/wp-content/plugins/sql-to-cpt/inc/Services/Boot.php/' );

		\WP_Mock::userFunction(
			'trailingslashit',
			[
				'return' => function ( $text ) {
					return rtrim( $text, '/' ) . '/';
				},
			]
		);

		\WP_Mock::userFunction( 'wp_enqueue_script' )
			->with(
				'sql-to-cpt',
				'https://example.com/wp-content/plugins/sql-to-cpt/inc/Services/Boot.php/../../dist/app.js',
				[
					'wp-i18n',
					'wp-element',
					'wp-blocks',
					'wp-components',
					'wp-editor',
					'wp-hooks',
					'wp-compose',
					'wp-plugins',
					'wp-edit-post',
					'wp-edit-site',
				],
				'1.1.0',
				false,
			);

		\WP_Mock::userFunction( 'wp_enqueue_media' )
			->with()
			->andReturn( null );

		\WP_Mock::userFunction( 'wp_set_script_translations' )
			->with(
				'sql-to-cpt',
				'sql-to-cpt',
				'/var/www/html/wp-content/plugins/sql-to-cpt/inc/Services/Boot.php/../../languages'
			)
			->andReturn( null );

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
				'return' => function ( $args, $init ) {
					return array_merge( $init, $args );
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
