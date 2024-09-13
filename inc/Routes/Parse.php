<?php
/**
 * Parse Route.
 *
 * This route is responsible for Parsing the SQL file
 * and getting everything ready for import.
 *
 * @package SqlToCpt
 */

namespace SqlToCpt\Routes;

use SqlToCpt\Abstracts\Route;
use SqlToCpt\Interfaces\Router;

/**
 * Parse class.
 */
class Parse extends Route implements Router {
	/**
	 * Get, Post, Put, Patch, Delete.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public string $method = 'POST';

	/**
	 * WP REST Endpoint e.g. /wp-json/sql-to-cpt/v1/parse.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public string $endpoint = '/parse';

	/**
	 * WP_REST_Request object.
	 *
	 * @since 1.0.0
	 *
	 * @var \WP_REST_Request
	 */
	public \WP_REST_Request $request;

	/**
	 * Request Callback.
	 *
	 * @since 1.0.0
	 *
	 * @return \WP_REST_Response
	 */
	public function request(): \WP_REST_Response {
		$this->sql = $this->request->get_json_params()['sql'] ?? '';

		return $this->response();
	}

	/**
	 * Response Callback.
	 *
	 * @since 1.0.0
	 *
	 * @return \WP_REST_Response
	 */
	public function response(): \WP_REST_Response {
		if ( true ) {
			return new \WP_Error(
				'sql-to-cpt-bad-request',
				sprintf(
					'Fatal Error: Bad Request, %s',
					wp_json_encode( $this->request->get_json_params() )
				),
				[
					'status' => 400,
				]
			);
		}


		return new \WP_REST_Response( $this->get_response() );
	}

	/**
	 * Get Response for valid WP REST request.
	 *
	 * This method obtains the response from the Parsed
	 * activity obtained from the Parser.
	 *
	 * @since 1.0.0
	 *
	 * @return mixed[]
	 */
	protected function get_response(): array {
		// Send back response from Parsing here...
	}

	/**
	 * Permissions callback for endpoints.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function is_user_permissible(): bool {
		return in_array( wp_get_current_user()->roles[0] ?? '', [ 'administrator' ], true );
	}
}
