<?php
/**
 * Import Route.
 *
 * This route is responsible for Importing the SQL file
 * that has been parsed earlier.
 *
 * @package SqlToCpt
 */

namespace SqlToCpt\Routes;

use SqlToCpt\Abstracts\Route;
use SqlToCpt\Interfaces\Router;

/**
 * Import class.
 */
class Import extends Route implements Router {
	/**
	 * Get, Post, Put, Patch, Delete.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public string $method = 'POST';

	/**
	 * WP REST Endpoint e.g. /wp-json/sql-to-cpt/v1/import.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public string $endpoint = '/import';

	/**
	 * WP_REST_Request object.
	 *
	 * @since 1.0.0
	 *
	 * @var \WP_REST_Request
	 */
	public \WP_REST_Request $request;

	/**
	 * JSON Params.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public array $args;

	/**
	 * Response Callback.
	 *
	 * @since 1.0.0
	 *
	 * @return \WP_REST_Response|\WP_Error
	 */
	public function response() {
		$this->args = $this->request->get_json_params();

		$table_name    = $this->args['tableName'] ?? '';
		$table_rows    = $this->args['tableRows'] ?? [];
		$table_columns = $this->args['tableColumns'] ?? [];

		// Bail out, if bad request.
		if ( empty( $table_name ) ) {
			return $this->get_400_response(
				sprintf(
					'Empty Table name: %s',
					$table_name
				)
			);
		}

		// Bail out, if bad request.
		if ( empty( $table_columns ) ) {
			return $this->get_400_response(
				sprintf(
					'Empty Table columns: %s',
					wp_json_encode( $table_columns )
				)
			);
		}

		// Bail out, if bad request.
		if ( empty( $table_rows ) ) {
			return $this->get_400_response(
				sprintf(
					'Empty Table rows: %s',
					wp_json_encode( $table_rows )
				)
			);
		}

		$response = $this->get_response();

		if ( is_null( $response ) ) {
			return $this->get_400_response(
				__( 'Error: Failed SQL Import!', 'sql-to-cpt' )
			);
		}

		return rest_ensure_response( $this->get_response() );
	}

	/**
	 * Get Response for valid WP REST request.
	 *
	 * This method obtains the response from the insert
	 * post operations.
	 *
	 * @since 1.1.0
	 *
	 * @return string|null
	 */
	protected function get_response() {
		$table_name    = $this->args['tableName'] ?? '';
		$table_rows    = $this->args['tableRows'] ?? [];
		$table_columns = $this->args['tableColumns'] ?? [];

		$posts     = [];
		$post_type = $table_name;

		foreach ( $table_rows as $table_row ) {
			// Bail out, if number of rows & columns don't match.
			if ( count( $table_columns ) !== count( $table_row ) ) {
				error_log(
					sprintf(
						'SQL to CPT | Error: Table row values do not match columns. Columns: %s, Row: %s',
						wp_json_encode( $table_columns ),
						wp_json_encode( $table_row ),
					)
				);

				continue;
			}

			$post_title  = $table_row[1] ?? '';
			$post_import = array_combine( $table_columns, $table_row );

			$args = [
				'post_type'   => $post_type,
				'post_title'  => $post_title,
				'meta_input'  => $post_import,
				'post_status' => 'publish',
			];

			/**
			 * Filter Post Values.
			 *
			 * Filter the post values that is being inserted
			 * into WP.
			 *
			 * @since 1.1.0
			 * @since 1.2.0 Refactored to use WP Post $args array.
			 *
			 * @param mixed[] $args
			 * @param mixed[] $post_import Associative array containing name, value pair of imported data.
			 *
			 * @return array
			 */
			$args = (array) apply_filters( 'sqlt_cpt_post_values', $args, $post_import );

			$response = wp_insert_post( $args );

			if ( is_wp_error( $response ) ) {
				error_log(
					sprintf(
						'SQL to CPT | Error: Insert post error: %s',
						$response->get_error_message()
					)
				);

				continue;
			}

			$posts[] = $response;
		}

		if ( ! empty( $posts ) ) {
			return add_query_arg(
				[
					'post_type' => $this->get_post_type(),
				],
				sprintf( '%s/%s', untrailingslashit( get_admin_url() ), 'edit.php' )
			);
		}

		return null;
	}

	/**
	 * Get Post Type.
	 *
	 * This method stores the post type of the saved posts
	 * in the plugin options and returns same.
	 *
	 * @since 1.1.1
	 *
	 * @return string
	 */
	protected function get_post_type(): string {
		$options   = get_option( 'sql_to_cpt', [] );
		$post_type = $this->args['tableName'] ?? '';

		if ( ! in_array( $post_type, $options['cpts'] ?? [], true ) ) {
			$options['cpts'][] = $post_type;
			update_option( 'sql_to_cpt', $options );
		}

		return $post_type;
	}
}
