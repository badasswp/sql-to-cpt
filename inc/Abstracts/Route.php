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
	 * WP_REST_Request object.
	 *
	 * @since 1.0.0
	 *
	 * @var \WP_REST_Request
	 */
	public \WP_REST_Request $request;

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
				'permission_callback' => [ $this, 'is_user_permissible' ],
			]
		);
	}

	/**
	 * Get 400 Response.
	 *
	 * This method returns a 400 response for Bad
	 * requests submitted.
	 *
	 * @since 1.0.0
	 *
	 * @param string $message Error Msg.
	 * @return \WP_Error
	 */
	public function get_400_response( $message ): \WP_Error {
		$args = $this->request->get_json_params();

		return new \WP_Error(
			'sql-to-cpt-bad-request',
			sprintf(
				'Fatal Error: Bad Request, %s',
				$message
			),
			[
				'status'  => 400,
				'request' => $args,
			]
		);
	}

	/**
	 * Permissions callback for endpoints.
	 *
	 * @since 1.1.0
	 *
	 * @param \WP_REST_Request $request Request Object.
	 * @return bool|\WP_Error
	 */
	public function is_user_permissible( $request ) {
		$http_error = rest_authorization_required_code();

		if ( ! current_user_can( 'administrator' ) ) {
			return new \WP_Error(
				'sql-to-cpt-rest-forbidden',
				sprintf( 'Invalid User. Error: %s', $http_error ),
				[ 'status' => $http_error ]
			);
		}

		if ( ! wp_verify_nonce( $request->get_header( 'X-WP-Nonce' ), 'wp_rest' ) ) {
			return new \WP_Error(
				'sql-to-cpt-rest-forbidden',
				sprintf( 'Invalid Nonce. Error: %s', $http_error ),
				[ 'status' => $http_error ]
			);
		}

		return true;
	}
}
