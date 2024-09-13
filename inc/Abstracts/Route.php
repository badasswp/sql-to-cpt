<?php
/**
 * Route abstraction.
 *
 * This abstract class defines a foundation for creating
 * route classes which act as WP REST end points for the FE.
 *
 * @package SqlToCpt
 */

namespace SqlToCpt\Abstracts;

use SqlToCpt\Interfaces\Router;

/**
 * Route class.
 */
abstract class Route implements Router {
	/**
	 * Get, Post, Put, Patch, Delete.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public string $method;

	/**
	 * WP REST Endpoint e.g. /wp-json/sql-to-cpt/v1/parse.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public string $endpoint;

	/**
	 * Response Data.
	 *
	 * @since 1.0.0
	 *
	 * @var mixed[]
	 */
	public array $data;

	/**
	 * WP_REST_Request object.
	 *
	 * @since 1.0.0
	 *
	 * @var \WP_REST_Request
	 */
	public \WP_REST_Request $request;

	/**
	 * Register REST Route.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_route(): void {
		register_rest_route(
			'sql-to-cpt/v1',
			$this->endpoint,
			[
				'methods'             => $this->method,
				'callback'            => [ $this, 'request' ],
				'permission_callback' => $this->is_user_permissible() ? '__return_true' : '__return_false',
			]
		);
	}

	/**
	 * Request Callback.
	 *
	 * Also known as the REST Callback. This method is
	 * responsible for getting the $request data and passing it along
	 * to the response method.
	 *
	 * @since 1.0.0
	 *
	 * @param \WP_REST_Request $request Request object.
	 * @return \WP_REST_Response|\WP_Error
	 */
	public function request( $request ) {
		$this->request = $request;

		return $this->response();
	}

	/**
	 * Response Callback.
	 *
	 * This is solely for preparing the response array
	 * before it is passed via the callback.
	 *
	 * @since 1.0.0
	 *
	 * @return \WP_REST_Response|\WP_Error
	 */
	abstract public function response();

	/**
	 * Permissions callback for endpoints.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	abstract public function is_user_permissible(): bool;
}
