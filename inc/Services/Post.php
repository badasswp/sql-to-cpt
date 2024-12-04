<?php
/**
 * Post Service.
 *
 * This service manages custom post types within the
 * plugin. It provides functionality for registering and
 * binding custom post types to WordPress.
 *
 * @package SqlToCpt
 */

namespace SqlToCpt\Services;

use SqlToCpt\Core\Post as CPT;
use SqlToCpt\Abstracts\Service;
use SqlToCpt\Interfaces\Kernel;

class Post extends Service implements Kernel {
	/**
	 * Post Objects.
	 *
	 * @since 1.1.0
	 *
	 * @var mixed[]
	 */
	public array $objects;

	/**
	 * Set up.
	 *
	 * @since 1.1.0
	 *
	 * @return void
	 */
	public function __construct() {
		$this->objects = [];

		// Get post types.
		$post_types = get_option( 'sql_to_cpt', [] )['cpts'] ?? [];

		/**
		 * Filter list of post types.
		 *
		 * @since 1.1.0
		 *
		 * @param string[] $post_types Post types.
		 * @return string[]
		 */
		$post_types = (array) apply_filters( 'sqlt_cpt_post_types', $post_types );

		foreach ( $post_types as $post_type ) {
			$this->objects[] = new CPT( $post_type );
		}
	}

	/**
	 * Bind to WP.
	 *
	 * @since 1.1.0
	 *
	 * @return void
	 */
	public function register(): void {
		add_action( 'init', [ $this, 'register_post_types' ] );
	}

	/**
	 * Register Post type implementation.
	 *
	 * @since 1.1.0
	 *
	 * @return void
	 */
	public function register_post_types(): void {
		foreach ( $this->objects as $object ) {
			$object->register_post_type();
		}
	}
}
