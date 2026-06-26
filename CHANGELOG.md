# Changelog

## 1.5.0
* Feat: Add `More Plugins` options page.
* Fix: Added missing translations for existing languages.

## 1.4.3
* Tested up to WP 7.0.

## 1.4.2
* Chore: Update CI/CD pipeline.

## 1.4.1
* Hotfix: Missing js-map file causing plugin breakdown.

## 1.4.0
* Feat: Setup custom WP store to prevent props drilling across components.
* Feat: Added translation languages for `Japanese`,`Indonesian`, `Turkish`, `Polish`, `Dutch`,`Danish`, `Brazil` and `Portuguese`.
* Refactor: Replaced hard coded HTTP verbs with `WP_REST_Server` constant.
* Refactor: Simplified register mimes.
* Refactor: Used webpack generated dependencies.
* Refactor: Replaced fully qualified path classes with their `use` counter part
* Refactor: Replaced `get-400-response` with `get-error-response` and sets `400` as the default status.
* Test: Updated the `js` unit test.
* Chore: Pull Request template added.

## 1.3.4
* Specify `wordpress-plugin` as Composer package type.
* Tested up to WP 6.9.

## 1.3.3
* Bump up plugin version.
* Tested up to WP 6.8
* Update README docs.

## 1.3.2
* Lint `.wp-env` file correctly.
* Update setup.sh bash script.
* Tested up to WP `6.7.2`.

## 1.3.1
* Enforce WP linting style across plugin.
* Feat: Add WP local dev env for contributors.

## 1.3.0
* Fix: Ensure REST response on SQL Import.
* Feat: Add Progress bar to Parse activity.
* Feat: Implement Purge component.
* Refactor: Move Interval logic to ProgressBar component.
* Refactor: Move Handle logic away from App to ImportButton component.
* Chore: Update doc blocks for components.
* Tested up to WP 6.7.1

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
