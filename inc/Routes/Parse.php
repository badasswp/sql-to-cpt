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

use SqlToCpt\Core\Parser;
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
	 * Response Callback.
	 *
	 * @since 1.0.0
	 *
	 * @return \WP_REST_Response|\WP_Error
	 */
	public function response() {
		$this->args = $this->request->get_json_params();
		$this->file = get_attached_file( $this->args['id'] ?? '' );

		//Bail out, if it does NOT exists.
		if ( ! file_exists( $this->file ) ) {
			return $this->get_400_response(
				sprintf(
					'File does not exists for ID: %s',
					$this->args['id'] ?? ''
				)
			);
		}

		//Bail out, if it is not SQL.
		if ( ! $this->is_sql( $this->file ) ) {
			return $this->get_400_response(
				sprintf(
					'Wrong file type has been received: %s',
					$this->args['filename'] ?? ''
				)
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
		$parser = new Parser( $this->file );

		return $parser->get_parsed_sql();
	}

	/**
	 * Permissions callback for endpoints.
	 *
	 * @since 1.0.0
	 *
	 * @param \WP_REST_Request $request Request Object.
	 * @return bool|\WP_Error
	 */
	public function is_user_permissible( $request ): bool {
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

	/**
	 * Verify SQL file.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed[] $file File array.
	 * @return boolean
	 */
	protected function is_sql( $file ): bool {
		if ( 'sql' !== wp_check_filetype( $file )['ext'] ?? '' ) {
			return false;
		}

		return true;
	}
}
