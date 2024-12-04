# sql-to-cpt

Import & Convert SQL files to Custom Post Types (CPT).

<img width="528" alt="sql-to-cpt" src="https://github.com/user-attachments/assets/cf2a4015-bc64-463b-a655-6e1a12762ca3">

## Download

Download from [WordPress plugin repository](https://wordpress.org/plugins/sql-to-cpt/).

You can also get the latest version from any of our [release tags](https://github.com/badasswp/sql-to-cpt/releases).

## Why SQL to CPT?

This plugin helps you migrate legacy __SQL database tables__ to WordPress' __Custom Post Types (CPT)__. It provides a user-friendly interface that enables users upload an SQL file which is then parsed and converted to a CPT with meta data that is recognisable within WordPress.

If you ever need to migrate a non-WordPress database table into WP, look no further. This is exactly what you need!

### Hooks

#### `sqlt_cpt_table_name`

This custom hook provides a simple way to filter the name of the custom post type where the table contents that is being imported will be stored.

```php
add_filter( 'sqlt_cpt_table_name', [ $this, 'custom_post_type_name' ], 10, 1 );

public function custom_post_type_name( $table_name ): string {
    if ( 'student' === $table_name ) {
        return 'custom_' . $table_name;
    }
}
```

**Parameters**

- table_name _`{string}`_ By default this will be the name of the imported SQL table.
<br/>

#### `sqlt_cpt_table_columns`

This custom hook provides a simple way to filter the names of the table columns that is being imported.

```php
add_action( 'sqlt_cpt_table_columns', [ $this, 'custom_columns' ], 10, 1 );

public function custom_columns( $columns ): array {
    $columns = array_map( '__', $columns );
    return $columns;
}
```

**Parameters**

- columns _`{string[]}`_ By default this will be a string array of column names parsed from the table that is being imported.
<br/>

#### `sqlt_cpt_table_rows`

This custom hook provides a simple way to filter the names of the table rows that is being imported.

```php
add_action( 'sqlt_cpt_table_rows', [ $this, 'custom_rows' ], 10, 1 );

public function custom_rows( $rows ): array {
    $rows = array_map( 'santize_text_field', $rows );
    return $rows;
}
```

**Parameters**

- rows _`{string[]}`_ By default this will be a string array of row values parsed from the table that is being imported.
<br/>

#### `sqlt_cpt_post_title`

This custom hook provides a way to filter the post title values being inserted into the post during import.

```php
add_action( 'sqlt_cpt_post_title', [ $this, 'custom_title' ], 10, 3 );

public function custom_title( $post_title, $table_row, $table_columns ): array {
    $key = array_search( 'first_name', $table_columns );

    return sanitize_text_field( $table_row[ $key ] );
}
```

**Parameters**

- post_title _`string`_ By default this will be a string from the first column of the table row that is being parsed.
- table_row _`{mixed[]}`_ By default this will be a string array of row values parsed from the table that is being imported.
- table_columns _`{string[]}`_ By default this will be a string array of column names parsed from the table that is being imported.
<br/>
