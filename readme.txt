=== SQL To CPT ===
Contributors: badasswp
Tags: sql, cpt, post, import, convert.
Requires at least: 6.0
Tested up to: 6.7.1
Stable tag: 1.2.2
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Import & Convert SQL files to Custom Post Types (CPT).

== Installation ==

1. Go to 'Plugins > Add New' on your WordPress admin dashboard.
2. Search for 'SQL To CPT' plugin from the official WordPress plugin repository.
3. Click 'Install Now' and then 'Activate'.
4. Head over to the 'SQL to CPT' options page.
5. Upload an SQL file of your choice and convert it to a Custom Post Type (CPT).

== Description ==

This plugin helps you <strong>migrate legacy SQL database tables</strong> to WordPress' <strong>Custom Post Types (CPT)</strong>. It provides a <strong>user-friendly UI interface</strong> that enables users upload an SQL file which is then parsed and converted to a CPT with meta data that is recognisable within WordPress.

If you ever need to migrate a non-WordPress database table into WP, look no further. This is exactly what you need!

= ✔️ Features =

Our plugin comes with everything you need to easily migrate SQL tables to CPTs.

✔️ <strong>Import & Convert to CPT</strong> feature.
✔️ <strong>Quick & Lightening Fast uploads</strong>.
✔️ <strong>Friendly, User Interface (UI)</strong>.
✔️ <strong>Custom Post Type Capabilities</strong>.
✔️ <strong>Error Loggging Capabilities</strong>.
✔️ <strong>Custom Hooks</strong> to help you customize plugin behaviour.
✔️ Available in <strong>mutiple langauges</strong> such as Arabic, Chinese, Hebrew, Hindi, Russian, German, Italian, Croatian, Spanish & French languages.
✔️ <strong>Backward compatible</strong>, works with most WP versions.

= ✨ Getting Started =

Head over to the <strong>SQL to CPT</strong> options page. Upload an SQL file of your choice by clicking on the <strong>Import SQL File</strong>. This would analyse your SQL table and show you the <strong>table name</strong> and <strong>table columns</strong> you are about to import. Once ready, click on the <strong>Convert to CPT</strong> button to complete the process.

On import completion, you should now be re-directed to the Custom Post Type page of your newly imported data!

You can get a taste of how this works, by using the [demo](https://tastewp.com/create/NMS/8.0/6.7.0/sql-to-cpt/twentytwentythree?ni=true&origin=wp) link.

= ⚡ Why SQL to CPT ? =

1. Because you need something that works great and fast!
2. Because you want to port your data across platforms easily.
3. Because you don't want to spend hours building custom software for this.
4. Because you think <strong>SQL to CPT</strong> is cool.

NB: At the moment, the <strong>SQL to CPT</strong> plugin currently does not provide a way for users to import more than one SQL table at a time, this feature should be available in future releases as well as the option to remove unused CPTs.

= 🔌🎨 Plug and Play or Customize =

The SQL to CPT plugin is built to work right out of the box. Simply install, activate and start using.

Want to add your personal touch? All of our documentation can be found [here](https://github.com/badasswp/sql-to-cpt). You can override the plugin's behaviour with custom logic of your own using [hooks](https://github.com/badasswp/sql-to-cpt?tab=readme-ov-file#hooks).

== Screenshots ==

1. Import SQL File screen - Upload your SQL File by clicking on the 'Import SQL File' button.
2. Import Modal - Select the SQL file you intend to import.
3. Custom Post Type page - List of uploaded data from SQL file.
4. Custom Post Type screen - Imported SQL data showing custom fields in CPT.

== Changelog ==

= 1.2.2 =
* Refactor: Parser instance via DI logic.
* Fix: Breaking WP dependency.
* Fix: Failing Unit tests.
* Tested up to WP 6.7.1

= 1.2.1 =
* Chore: Add accessibility roles for components.
* Updated Unit Tests for same.
* Tested up to WP 6.7.1.

= 1.2.0 =
* Feat: Implement Import Progress bar.
* Refactor: `sqlt_cpt_post_title` to `sqlt_cpt_post_values`.
* Chore: Clean up App components.
* Chore: Fix typos in README.
* Add Unit Tests & Test Coverage.
* Tested up to WP 6.7.1.

= 1.1.0 =
* Fix missing `Import` route class.
* Implement `Post` class for handling CPTs.
* Add new Custom Hooks: `sqlt_cpt_post_title`, `sqlt_cpt_post_labels`, `sqlt_cpt_post_options`.
* Add new screenshot images.
* Update README notes.
* Tested up to WP 6.7.1.

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
