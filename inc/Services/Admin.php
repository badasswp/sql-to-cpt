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

class Admin extends Service implements Kernel {
	/**
	 * Bind to WP.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register(): void {
		add_action( 'admin_menu', [ $this, 'register_admin_menu' ] );
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
			__( 'SQL To CPT', 'sql-to-cpt' ),
			__( 'SQL To CPT', 'sql-to-cpt' ),
			'manage_options',
			'sql-to-cpt',
			[ $this, 'register_admin_page' ],
			'dashicons-database',
			90
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
				esc_html__( 'SQL To CPT', 'sql-to-cpt' ),
				esc_html__( 'Import & Convert SQL files to Custom Post Types (CPT).', 'sql-to-cpt' ),
				esc_html__( 'Loading...', 'sql-to-cpt' ),
			]
		);
	}
}
