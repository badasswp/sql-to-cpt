=== SQL To CPT ===
Contributors: badasswp
Tags: sql, cpt, post, import, convert.
Requires at least: 4.0
Tested up to: 6.6.2
Stable tag: 1.0.1
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Import & Convert SQL files to Custom Post Types (CPT).

== Installation ==

1. Go to 'Plugins > Add New' on your WordPress admin dashboard.
2. Search for 'SQL To CPT' plugin from the official WordPress plugin repository.
3. Click 'Install Now' and then 'Activate'.
4. Head over to the 'SQL to CPT' options page.
5. Upload an SQL file of your choice and watch it convert to a Custom Post Type (CPT).

== Description ==

This plugin helps you migrate legacy SQL database tables to WordPress' Custom Post Types (CPT). It provides a user-friendly interface that enables users upload an SQL file which is then parsed and converted to a CPT with meta data that is recognisable within WordPress.

If you ever need to migrate a non-WordPress database table into WP, look no further. This is exactly what you need!

== Changelog ==

= 1.0.1 =
* Change hook names to use `sqlt` prefix.
* Custom Hooks now bear `sqlt_cpt_table_name`, `sqlt_cpt_table_columns`, `sqlt_cpt_table_rows`.
* Tested up to WP 6.6.2.

= 1.0.0 =
* Add ability to upload SQL file to Custom Post Type (CPT).
* Custom Hooks `sqlt_cpt_table_name`, `sqlt_cpt_table_columns`, `sqlt_cpt_table_rows`.
* Custom Options page.
* Fix bugs & linting issues.
* Tested up to WP 6.6.2.

== Contribute ==

If you'd like to contribute to the development of this plugin, you can find it on [GitHub](https://github.com/badasswp/sql-to-cpt).

To build, clone repo and run `yarn install && yarn build`
