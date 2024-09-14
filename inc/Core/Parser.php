<?php
/**
 * Parser.
 *
 * This engine is responsible for parsing the SQL
 * file containg records and fields.
 *
 * @package SqlToCpt
 */

namespace SqlToCpt\Core;

class Parser {
	/**
	 * Set up.
	 *
	 * @since 1.0.0
	 *
	 * @param string $sql
	 * @return void
	 */
	public function __construct( $sql ) {
		$this->sql = $sql;
	}

	/**
	 * Get SQL.
	 *
	 * This method is responsible for grabbing the
	 * SQL file contents.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 * @throws Exception $e If SQL file does not exist.
	 */
	protected function get_sql_string(): string {
		if ( ! file_exists( $this->sql ) ) {
			throw new \Exception(
				sprintf(
					'Fatal Error: File does not exist: %s',
					esc_url( $this->sql )
				)
			);
		}

		return file_get_contents( $this->sql );
	}

	/**
	 * Get SQL Fields.
	 *
	 * This method is responsible for parsing the
	 * SQL column names.
	 *
	 * @since 1.0.0
	 *
	 * @return string[]
	 */
	protected function get_sql_fields(): array {
		// Match SQL string.
		preg_match( '/INSERT INTO `([^`]+)` \(([^)]+)\)/', $this->get_sql_string(), $matches );

		return array_map(
			function ( $field ) {
				return trim( $field, '`' );
			},
			array_map( 'trim', explode( ',', $matches[2] ) )
		);
	}

	/**
	 * Get Parsed SQL.
	 *
	 * This method is responsible for sending the
	 * Parsed SQL data back to the app.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_parsed_sql(): array {
		return [
			$this->get_sql_fields(),
		];
	}
}
