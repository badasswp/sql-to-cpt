<?php
/**
 * Boot Service.
 *
 * Handle all setup logic before plugin is
 * fully capable.
 *
 * @package SqlToCpt
 */

namespace SqlToCpt\Services;

use SqlToCpt\Abstracts\Service;
use SqlToCpt\Interfaces\Kernel;

class Boot extends Service implements Kernel {
	/**
	 * Bind to WP.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register(): void {
		add_action( 'init', [ $this, 'register_translation' ] );
		add_filter( 'upload_mimes', [ $this, 'register_mimes' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ] );
	}

	/**
	 * Register Scripts.
	 *
	 * @since 1.0.0
	 *
	 * @wp-hook 'admin_enqueue_scripts'
	 */
	public function register_scripts() {
		// Get the current screen object.
		$screen = get_current_screen();

		// Bail out, if not plugin Admin page.
		if ( ! is_object( $screen ) || $screen->id !== 'toplevel_page_sql-to-cpt' ) {
			return;
		}

		// Load Script.
		wp_enqueue_script(
			'sql-to-cpt',
			trailingslashit( plugin_dir_url( __FILE__ ) ) . '../../dist/app.js',
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
			'1.0.0',
			false,
		);

		// Handle undefined (reading 'limitExceeded') issue.
		wp_enqueue_media();

		// Set Translation.
		wp_set_script_translations(
			'sql-to-cpt',
			'sql-to-cpt',
			plugin_dir_path( __FILE__ ) . '/../../languages'
		);
	}

	/**
	 * Add Plugin text translation.
	 *
	 * @since 1.0.0
	 *
	 * @wp-hook 'init'
	 */
	public function register_translation() {
		load_plugin_textdomain(
			'sql-to-cpt',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages'
		);
	}

	/**
	 * Register Mimes.
	 *
	 * @since 1.0.0
	 *
	 * @return mixed[]
	 *
	 * @wp-hook 'upload_mimes'
	 */
	public function register_mimes( $mimes ): array {
		return wp_parse_args(
			[
				'sql' => 'application/octet-stream',
			],
			$mimes
		);
	}
}
