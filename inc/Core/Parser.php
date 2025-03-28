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
	 * SQL.
	 *
	 * The absolute path where the file resides.
	 *
	 * @since 1.1.1
	 *
	 * @var string
	 */
	public string $sql;

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

		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		return file_get_contents( $this->sql );
	}

	/**
	 * Get SQL Table name.
	 *
	 * This method is responsible for retrieving
	 * the SQL table name.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	protected function get_sql_table_name(): string {
		preg_match( '/INSERT INTO `([^`]+)`/', $this->get_sql_string(), $matches );

		$name = $matches[1] ?? '';

		/**
		 * Filter SQL Table name.
		 *
		 * Modify table name for the table that
		 * is being imported.
		 *
		 * @since 1.0.0
		 *
		 * @param string $name Table name.
		 * @return string
		 */
		return (string) apply_filters( 'sqlt_cpt_table_name', $name );
	}

	/**
	 * Get SQL Table columns.
	 *
	 * This method is responsible for retrieving
	 * the SQL column names.
	 *
	 * @since 1.0.0
	 *
	 * @return string[]
	 */
	protected function get_sql_table_columns(): array {
		preg_match( '/INSERT INTO `([^`]+)` \(([^)]+)\)/', $this->get_sql_string(), $matches );

		// Bail out, if there are no VALUES in SQL.
		if ( empty( $matches[2] ) ) {
			return [];
		}

		$columns = array_map(
			function ( $field ) {
				return trim( $field, '`' );
			},
			array_map( 'trim', explode( ',', $matches[2] ?? [] ) )
		);

		/**
		 * Filter SQL Column names.
		 *
		 * Modify column names for the table that
		 * is being imported.
		 *
		 * @since 1.0.0
		 *
		 * @param string[] $columns Field/Column names.
		 * @return string[]
		 */
		return (array) apply_filters( 'sqlt_cpt_table_columns', $columns );
	}

	/**
	 * Get SQL Table rows.
	 *
	 * This method is responsible for retrieving
	 * the SQL rows.
	 *
	 * @since 1.1.0
	 *
	 * @return mixed[]
	 */
	protected function get_sql_table_rows(): array {
		$table_rows = [];

		// Match string starting from `VALUES` to end.
		preg_match_all( '/VALUES\s*(.*);/s', $this->get_sql_string(), $matches );

		// Bail out, if there are no VALUES in SQL.
		if ( empty( $matches[1] ) ) {
			return [];
		}

		// Match individual rows obtained from SQL.
		preg_match_all( '/\(([^)]+)\)/', $matches[1][0], $rows_matches );

		// Bail out, if there are no rows in SQL.
		if ( empty( $rows_matches[1] ) ) {
			return [];
		}

		// Clean up rows, format correctly in readiness for post insertion.
		foreach ( $rows_matches[1] as $table_row ) {
			$table_row = array_map(
				function ( $row ) {
					return sanitize_text_field( trim( trim( $row ), "'" ) );
				},
				explode( ',', $table_row )
			);

			$table_rows[] = $table_row;
		}

		/**
		 * Filter SQL Rows.
		 *
		 * Modify rows/records for the table that
		 * is being imported.
		 *
		 * @since 1.1.0
		 *
		 * @param mixed[] $rows Rows/Records.
		 * @return mixed[]
		 */
		return (array) apply_filters( 'sqlt_cpt_table_rows', $table_rows );
	}

	/**
	 * Get Parsed SQL.
	 *
	 * This method is responsible for parsing the SQL
	 * and sending back the parsed data.
	 *
	 * @since 1.0.0
	 * @since 1.2.2 Pass in SQL source path.
	 *
	 * @param string $sql SQL string.
	 * @return array
	 */
	public function get_parsed_sql( $sql ): array {
		$this->sql = $sql;

		return [
			'tableName'    => $this->get_sql_table_name(),
			'tableColumns' => $this->get_sql_table_columns(),
			'tableRows'    => $this->get_sql_table_rows(),
		];
	}
}
