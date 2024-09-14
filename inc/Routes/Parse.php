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
		if ( ! $this->is_sql( $this->args ) ) {
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
	 * @return bool
	 */
	public function is_user_permissible(): bool {
		return in_array( wp_get_current_user()->roles[0] ?? '', [ 'administrator' ], true );
	}

	/**
	 * Verify SQL file.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed[] $args Array containing ID, Mime, Filename, URL.
	 * @return boolean
	 */
	protected function is_sql( $args ): bool {
		if ( 'sql' !== pathinfo( ( $args['filename'] ?? '' ), PATHINFO_EXTENSION ) ) {
			return false;
		}

		if ( ! in_array( $args['mime'] ?? '', [ 'application/sql', 'application/octet-stream' ], true ) ) {
			return false;
		}

		return true;
	}
}
