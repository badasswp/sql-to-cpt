<?php
/**
 * Admin Class.
 *
 * This class holds the logic for registering
 * the plugin's admin page.
 *
 * @package SqlToCpt
 */

namespace SqlToCpt\Services;

use SqlToCpt\Abstracts\Service;
use SqlToCpt\Interfaces\Kernel;

use Pluginate\Admin as Pluginate;

class Admin extends Service implements Kernel {
	/**
	 * Pluginate instance.
	 *
	 * @since 1.5.0
	 *
	 * @var Pluginate
	 */
	public Pluginate $pluginate;

	/**
	 * Admin constructor.
	 *
	 * @since 1.5.0
	 */
	public function __construct() {
		$this->pluginate = new Pluginate( 'sql-to-cpt' );
	}

	/**
	 * Bind to WP.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register(): void {
		add_action( 'admin_menu', [ $this, 'register_admin_menu' ] );
		add_action( 'admin_init', [ $this->pluginate, 'init' ] );
	}

	/**
	 * Register Admin Menu.
	 *
	 * This controls the menu for the Admin page.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_admin_menu(): void {
		add_menu_page(
			__( 'SQL to CPT', 'sql-to-cpt' ),
			__( 'SQL to CPT', 'sql-to-cpt' ),
			'manage_options',
			'sql-to-cpt',
			[ $this, 'register_admin_page' ],
			'dashicons-database',
			90
		);

		add_submenu_page(
			'sql-to-cpt',
			__( 'More Plugins', 'sql-to-cpt' ),
			__( 'More Plugins', 'sql-to-cpt' ),
			'manage_options',
			sprintf( '%s-more-plugins', 'sql-to-cpt' ),
			[ $this, 'register_more_plugins' ]
		);
	}

	/**
	 * Register Admin Page.
	 *
	 * This controls the display of the menu page.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_admin_page(): void {
		vprintf(
			'<section class="wrap">
				<h1>%s</h1>
				<p>%s</p>
				<div id="sql-to-cpt"></div>
			</section>',
			[
				esc_html__( 'SQL to CPT', 'sql-to-cpt' ),
				esc_html__( 'Import & Convert SQL files to Custom Post Types (CPT).', 'sql-to-cpt' ),
				esc_html__( 'Loading...', 'sql-to-cpt' ),
			]
		);
	}

	/**
	 * Register More Plugins.
	 *
	 * This controls the display of the
	 * "More Plugins" submenu page.
	 *
	 * @since 1.5.0
	 *
	 * @return void
	 */
	public function register_more_plugins(): void {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		vprintf(
			'<section class="wrap">
				<h1>%s</h1>
				<p>%s</p>
				%s
			</section>',
			array_map(
				'__',
				[
					'More Plugins',
					'Check out some other amazing plugin of ours...',
					$this->pluginate->get_more_plugins(),
				]
			)
		);
	}
}
