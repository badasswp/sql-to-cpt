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

		return new \WP_REST_Response( $this->get_response() );
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
			$table_row = array_map(
				function ( $row ) {
					return sanitize_text_field( trim( trim( $row ), "'" ) );
				},
				explode( ',', $table_row )
			);

			/**
			 * Filter Post Title.
			 *
			 * Modify the post title name that is being
			 * used to save the post.
			 *
			 * @since 1.1.0
			 *
			 * @param string   $post_title    Row field as Post Title.
			 * @param mixed[]  $table_row     Row values.
			 * @param string[] $table_columns Column names.
			 *
			 * @return string
			 */
			$post_title = apply_filters( 'sqlt_cpt_post_title', $table_row[1] ?? '', $table_row, $table_columns );

			if ( count( $table_columns ) !== count( $table_row ) ) {
				continue;
			}

			$posts[] = wp_insert_post(
				[
					'post_type'   => $post_type,
					'post_title'  => $post_title,
					'post_status' => 'publish',
					'meta_input'  => array_combine( $table_columns, $table_row ),
				]
			);

			$options = get_option( 'sql_to_cpt', [] );

			if ( ! in_array( $post_type, $options['cpts'] ?? [], true ) ) {
				$options['cpts'][] = $post_type;
				update_option( 'sql_to_cpt', $options );
			}
		}

		if ( ! empty( $posts ) ) {
			return add_query_arg(
				[
					'post_type' => $post_type,
				],
				sprintf( '%s/%s', untrailingslashit( get_admin_url() ), 'edit.php' )
			);
		}

		return null;
	}
}
