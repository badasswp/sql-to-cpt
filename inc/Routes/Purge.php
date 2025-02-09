<?php
/**
 * Purge Route.
 *
 * This route is responsible for removing the Custom
 * Post type and its contents.
 *
 * @package SqlToCpt
 */

namespace SqlToCpt\Routes;

use SqlToCpt\Abstracts\Route;
use SqlToCpt\Interfaces\Router;

/**
 * Purge class.
 */
class Purge extends Route implements Router {
	/**
	 * Get, Post, Put, Patch, Delete.
	 *
	 * @since 1.3.0
	 *
	 * @var string
	 */
	public string $method = 'POST';

	/**
	 * WP REST Endpoint e.g. /wp-json/sql-to-cpt/v1/purge.
	 *
	 * @since 1.3.0
	 *
	 * @var string
	 */
	public string $endpoint = '/purge';

	/**
	 * WP_REST_Request object.
	 *
	 * @since 1.3.0
	 *
	 * @var \WP_REST_Request
	 */
	public \WP_REST_Request $request;

	/**
	 * JSON Params.
	 *
	 * @since 1.3.0
	 *
	 * @var array
	 */
	public array $args;

	/**
	 * Custom Post type.
	 *
	 * @since 1.3.0
	 *
	 * @var string
	 */
	public string $post_type;

	/**
	 * Response Callback.
	 *
	 * @since 1.3.0
	 *
	 * @return \WP_REST_Response|\WP_Error
	 */
	public function response() {
		$this->args = $this->request->get_json_params();

		$this->post_type = $this->args['postType'] ?? '';

		// Bail out, if bad request.
		if ( empty( $this->post_type ) ) {
			return $this->get_400_response(
				sprintf(
					'Empty Post type: %s',
					$post_type
				)
			);
		}

		$deleted_posts = $this->get_response();

		if ( empty( $deleted_posts ) ) {
			return $this->get_400_response(
				sprintf(
					'Unable to delete Posts for CPT: %s',
					$this->post_type
				)
			);
		}

		return rest_ensure_response( $deleted_posts );
	}

	/**
	 * Get Response for valid WP REST request.
	 *
	 * This method obtains the response from the delete
	 * post operations.
	 *
	 * @since 1.3.0
	 *
	 * @return \WP_REST_Response|\WP_Error
	 */
	protected function get_response(): array {
		$deleted_posts = [];

		foreach ( $this->get_post_ids() as $post ) {
			$deleted_post = wp_delete_post( $post, true );

			if ( ! $deleted_post ) {
				error_log(
					sprintf( 'Unable to delete the Post with ID: %d', $post )
				);
				continue;
			}

			$deleted_posts[] = $post;
		}

		return $deleted_posts;
	}

	/**
	 * Get list of Post IDs.
	 *
	 * This method obtains the list of IDs for the
	 * custom post type.
	 *
	 * @since 1.3.0
	 *
	 * @return \WP_REST_Response|\WP_Error
	 */
	protected function get_post_ids(): array {
		return wp_list_pluck(
			get_posts(
				[
					'post_type'   => $this->post_type,
					'numberposts' => -1,
				]
			),
			'ID'
		);
	}
}
