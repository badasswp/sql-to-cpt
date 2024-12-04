<?php
/**
 * Custom Post Type.
 *
 * This concrete class serves as a base handler for registering
 * custom post types in the SQL To CPT plugin. It provides a standardized
 * structure and common methods for managing custom post types.
 *
 * @package SqlToCpt
 */

namespace SqlToCpt\Core;

class Post {
	/**
	 * Post type.
	 *
	 * @since 1.1.0
	 *
	 * @var string
	 */
	protected string $name;

	/**
	 * Setup.
	 *
	 * @param string $name Post type.
	 */
	public function __construct( $name ) {
		$this->name = $name;
	}

	/**
	 * Get post type name.
	 *
	 * @since 1.1.0
	 *
	 * @return string
	 */
	public function get_name(): string {
		return $this->name;
	}

	/**
	 * Get singular label for post type.
	 *
	 * @since 1.1.0
	 *
	 * @return string
	 */
	public function get_singular_label(): string {
		return ucwords( $this->get_name() );
	}

	/**
	 * Get plural label for post type.
	 *
	 * @since 1.1.0
	 *
	 * @return string
	 */
	public function get_plural_label(): string {
		return ucwords( sprintf( '%ss', $this->get_name() ) );
	}

	/**
	 * Post URL slug on rewrite.
	 *
	 * @since 1.1.0
	 *
	 * @return string
	 */
	public function get_slug(): string {
		return sanitize_title( $this->get_name() );
	}

	/**
	 * Get supports for post type.
	 *
	 * @since 1.1.0
	 *
	 * @return string[]
	 */
	public function get_supports(): array {
		return [ 'title', 'thumbnail' ];
	}

	/**
	 * Is Post visible in REST.
	 *
	 * @since 1.1.0
	 *
	 * @return bool
	 */
	public function is_post_visible_in_rest(): bool {
		return true;
	}

	/**
	 * Is Post visible in Menu.
	 *
	 * @since 1.1.0
	 *
	 * @return string|bool
	 */
	public function is_post_visible_in_menu() {
		return true;
	}

	/**
	 * Register post type.
	 *
	 * @since 1.1.0
	 *
	 * @return void
	 */
	public function register_post_type(): void {
		error_log( 'this fires...' );
		if ( ! post_type_exists( $this->get_name() ) ) {
			error_log( 'this_fires_again...' );
			register_post_type( $this->get_name(), $this->get_options() );
		}
	}

	/**
	 * Return post type options.
	 *
	 * @since 1.1.0
	 *
	 * @return mixed[]
	 */
	public function get_options(): array {
		$options = [
			'name'         => $this->get_name(),
			'labels'       => $this->get_labels(),
			'supports'     => $this->get_supports(),
			'show_in_rest' => $this->is_post_visible_in_rest(),
			'show_in_menu' => $this->is_post_visible_in_menu(),
			'public'       => true,
			'rewrite'      => [
				'slug' => $this->get_slug(),
			],
		];

		/**
		 * Filter Post options.
		 *
		 * @since 1.1.0
		 *
		 * @param mixed[] $options Post options.
		 * @return mixed[]
		 */
		return (array) apply_filters( 'sqlt_cpt_post_options', $options );
	}

	/**
	 * Get labels for post type.
	 *
	 * @since 1.1.0
	 *
	 * @return string[]
	 */
	public function get_labels(): array {
		$singular_label = $this->get_singular_label();
		$plural_label   = $this->get_plural_label();

		$labels = [
			'name'          => sprintf(
				'%1$s',
				__( $plural_label, 'sql-to-cpt' ),
			),
			'singular_name' => sprintf(
				'%1$s',
				__( $singular_label, 'sql-to-cpt' ),
			),
			'add_new'       => sprintf(
				'%1$s',
				__( "Add New {$singular_label}", 'sql-to-cpt' ),
			),
			'add_new_item'  => sprintf(
				'%1$s',
				__( "Add New {$singular_label}", 'sql-to-cpt' ),
			),
			'new_item'      => sprintf(
				'%1$s',
				__( "New {$singular_label}", 'sql-to-cpt' ),
			),
			'edit_item'     => sprintf(
				'%1$s',
				__( "Edit {$singular_label}", 'sql-to-cpt' ),
			),
			'view_item'     => sprintf(
				'%1$s',
				__( "View {$singular_label}", 'sql-to-cpt' ),
			),
			'search_items'  => sprintf(
				'%1$s',
				__( "Search {$plural_label}", 'sql-to-cpt' ),
			),
			'menu_name'     => sprintf(
				'%1$s',
				__( $plural_label, 'sql-to-cpt' ),
			),
		];

		/**
		 * Filter Post labels.
		 *
		 * @since 1.1.0
		 *
		 * @param mixed[] $labels Post labels.
		 * @return mixed[]
		 */
		return (array) apply_filters( 'sqlt_cpt_post_labels', $labels );
	}
}
