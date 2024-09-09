<?php
/**
 * Plugin Name: SQL to CPT
 * Plugin URI:  https://github.com/badasswp/sql-to-cpt
 * Description: Import & Convert SQL files to Custom Post Types (CPT).
 * Version:     1.0.0
 * Author:      badasswp
 * Author URI:  https://github.com/badasswp
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: sql-to-cpt
 * Domain Path: /languages
 *
 * @package SQLToCPT
 */

namespace badasswp\SQLToCPT;

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SQL_CPT_AUTOLOAD', __DIR__ . '/vendor/autoload.php' );

// Composer Check.
if ( ! file_exists( SQL_CPT_AUTOLOAD ) ) {
	add_action( 'admin_notices', function() {
		vprintf(
			esc_html__( 'Fatal Error: Composer not setup in %s', 'sql-to-cpt' ),
			[ __DIR__ ]
		);
	} );

	return;
}

// Run Plugin.
require_once SQL_CPT_AUTOLOAD;
( \SQLToCPT\Plugin::get_instance() )->run();