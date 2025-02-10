# Changelog

## Unreleased
* Fix: Ensure REST response on SQL Import.
* Feat: Add Progress bar to Parse activity.
* Feat: Implement Purge component.
* Refactor: Move Interval logic to Progress Bar component.

## 1.2.2
* Refactor: Parser instance via DI logic.
* Fix: Breaking WP dependency.
* Fix: Failing Unit tests.
* Tested up to WP 6.7.1

## 1.2.1
* Chore: Add accessibility roles for components.
* Updated Unit Tests for same.
* Tested up to WP 6.7.1.

## 1.2.0
* Feat: Implement Import Progress bar.
* Refactor: `sqlt_cpt_post_title` to `sqlt_cpt_post_values`.
* Chore: Clean up App components.
* Chore: Fix typos in README.
* Add Unit Tests & Test Coverage.
* Tested up to WP 6.7.1.

## 1.1.0
* Fix missing `Import` route class.
* Implement `Post` class for handling CPTs.
* Add new Custom Hooks: `sqlt_cpt_post_title`, `sqlt_cpt_post_labels`, `sqlt_cpt_post_options`.
* Add new screenshot images.
* Update README notes.
* Tested up to WP 6.7.1.

## 1.0.1
* Change hook names to use `sqlt` prefix.
* Custom Hooks now bear `sqlt_cpt_table_name`, `sqlt_cpt_table_columns`, `sqlt_cpt_table_rows`.
* Tested up to WP 6.6.2.

## 1.0.0 (Initial Release)
* Add ability to upload SQL file to Custom Post Type (CPT).
* Custom Hooks `sqlt_cpt_table_name`, `sqlt_cpt_table_columns`, `sqlt_cpt_table_rows`.
* Custom Options page.
* Fix bugs & linting issues.
* Tested up to WP 6.6.2.
