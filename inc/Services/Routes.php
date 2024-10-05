<?php
/**
 * REST Service.
 *
 * This service is responsible for binding REST Routes to
 * WordPress. All routes are defined within the Routes folder,
 * custom routes can also be injected here.
 *
 * @package SqlToCpt
 */

namespace SqlToCpt\Services;

use SqlToCpt\Routes\Parse;
use SqlToCpt\Abstracts\Service;
use SqlToCpt\Interfaces\Kernel;

class Routes extends Service implements Kernel {
	/**
	 * REST routes.
	 *
	 * @since 1.0.0
	 *
	 * @var mixed[]
	 */
	public array $routes;

	/**
	 * Set up.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
		$this->routes = [
			Parse::class,
		];
	}

	/**
	 * Bind to WP.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register(): void {
		add_action( 'rest_api_init', [ $this, 'register_rest_routes' ] );
	}

	/**
	 * Register Routes.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_rest_routes(): void {
		/**
		 * Filter list of WP REST Routes.
		 *
		 * @since 1.0.0
		 *
		 * @param mixed[] $routes WP REST Routes.
		 * @return mixed[]
		 */
		$this->routes = (array) apply_filters( 'sqlt_cpt_rest_routes', $this->routes );

		/**
		 * Specify Route Instance types.
		 *
		 * @since 1.0.0
		 *
		 * @var Parse $route
		 */
		foreach ( $this->routes as $route ) {
			( new $route() )->register_route();
		}
	}
}
