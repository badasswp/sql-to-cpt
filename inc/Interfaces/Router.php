<?php
/**
 * Router Interface.
 *
 * This interface defines a contract for routes
 * and defines common methods that derived classes
 * should implement.
 *
 * @package SqlToCpt
 */

namespace SqlToCpt\Interfaces;

interface Router {
	/**
	 * Request Callback.
	 *
	 * @since 1.0.0
	 *
	 * @return \WP_REST_Response
	 */
	public function request(): \WP_REST_Response;

	/**
	 * Response Callback.
	 *
	 * @since 1.0.0
	 *
	 * @return \WP_REST_Response
	 */
	public function response(): \WP_REST_Response;

	/**
	 * Permissions callback for endpoints.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function is_user_permissible(): bool;
}
