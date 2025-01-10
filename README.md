# sql-to-cpt

[![Coverage Status](https://coveralls.io/repos/github/badasswp/sql-to-cpt/badge.svg?branch=master)](https://coveralls.io/github/badasswp/sql-to-cpt?branch=master)

Import & Convert SQL files to Custom Post Types (CPT).

<img width="528" alt="sql-to-cpt" src="https://github.com/user-attachments/assets/cf2a4015-bc64-463b-a655-6e1a12762ca3">

---

<img width="1502" alt="after-import" src="https://github.com/user-attachments/assets/6b61dc84-2c6c-4385-9786-edec7d34a749">

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

This custom hook provides a simple way to filter the table columns that is being imported.

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

This custom hook provides a simple way to filter the table rows that is being imported.

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

#### `sqlt_cpt_post_values`

This custom hook provides a way to filter the WP post values before import. An e.g is shown below where the `post_title` is filtered to use the `first_name` and `last_name` of the imported `worker` data.

```php
add_filter( 'sqlt_cpt_post_values', [ $this, 'filter_post_title' ], 10, 2 );

public function filter_post_title( $args, $post_import ): array {
    if ( 'worker' === $args['post_type'] ?? '' ) {
        $args['post_title'] = sprintf(
            '%s %s',
            $post_import['first_name'] ?? '',
            $post_import['last_name'] ?? ''
        );
    }

    return $args;
}
```

**Parameters**

- args _`{mixed[]}`_ By default this will be an associative array containg the familiar WP Post values (`post_type`, `post_title`, `meta_input` & `post_status`) to be inserted.
- post_import _`{mixed[]}`_ By default this will be an associative array containg the key, value pair of the imported data.
<br/>

#### `sqlt_cpt_post_labels`

This custom hook provides a way to filter the post labels of the CPT that is imported.

```php
add_action( 'sqlt_cpt_post_labels', [ $this, 'custom_labels' ], 10, 1 );

public function custom_labels( $labels ): array {
    if( 'Students' === $labels['singular_name'] ?? '' ) {
        $labels['singular_name']  = 'Student'
    }

    return $labels;
}
```

**Parameters**

- labels _`{string[]}`_ By default this will be a string array of containing the label values of the CPT.
<br/>

#### `sqlt_cpt_post_options`

This custom hook provides a way to filter the post options of the CPT that is imported.

```php
add_action( 'sqlt_cpt_post_options', [ $this, 'custom_options' ], 10, 1 );

public function custom_options( $options ): array {
    $options['show_in_menu'] = false;

    return $options;
}
```

**Parameters**

- options _`{mixed[]}`_ By default this will be an array containing the post options of the CPT.
<br/>
