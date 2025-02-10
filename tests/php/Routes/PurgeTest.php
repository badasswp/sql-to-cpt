<?php

namespace SqlToCpt\Tests\Routes;

use Mockery;
use WP_Mock\Tools\TestCase;

use SqlToCpt\Routes\Purge;
use SqlToCpt\Abstracts\Service;

/**
 * @covers \SqlToCpt\Routes\Purge::is_sql
 * @covers \SqlToCpt\Routes\Purge::response
 * @covers \SqlToCpt\Routes\Purge::get_response
 * @covers \SqlToCpt\Routes\Purge::get_post_ids
 * @covers \SqlToCpt\Routes\Purge::get_updated_cpts
 */
class PurgeTest extends TestCase {
	public Purge $purge;

	public function setUp(): void {
		\WP_Mock::setUp();

		$this->purge = new Purge();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}

	public function test_route_initial_values() {
		$this->assertSame( $this->purge->method, 'POST' );
		$this->assertSame( $this->purge->endpoint, '/purge' );
	}

	public function test_response_bails_out_if_post_type_is_empty_and_returns_wp_error() {
		$purge = Mockery::mock( Purge::class )->makePartial();
		$purge->shouldAllowMockingProtectedMethods();

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		\WP_Mock::userFunction( '__' )
			->andReturnUsing(
				function ( $arg ) {
					return $arg;
				}
			);

		$request->shouldReceive( 'get_json_params' )
			->andReturn(
				[
					'postType' => '',
				]
			);

		$purge->request = $request;

		$this->assertInstanceOf( \WP_Error::class, $purge->response() );
		$this->assertConditionsMet();
	}

	public function test_response_bails_out_if_get_response_gives_undeleted_posts_and_returns_wp_error() {
		$purge = Mockery::mock( Purge::class )->makePartial();
		$purge->shouldAllowMockingProtectedMethods();

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		$request->shouldReceive( 'get_json_params' )
			->andReturn(
				[
					'postType' => 'student',
				]
			);

		$purge->shouldReceive( 'get_response' )
			->andReturn( [ 1 ] );

		$purge->request = $request;

		$this->assertInstanceOf( \WP_Error::class, $purge->response() );
		$this->assertConditionsMet();
	}

	public function test_response_passes_and_returns_wp_rest_response() {
		$purge = Mockery::mock( Purge::class )->makePartial();
		$purge->shouldAllowMockingProtectedMethods();

		$request = Mockery::mock( \WP_REST_Request::class )->makePartial();
		$request->shouldAllowMockingProtectedMethods();

		$rest_response = Mockery::mock( \WP_REST_Response::class )->makePartial();
		$rest_response->shouldAllowMockingProtectedMethods();

		$request->shouldReceive( 'get_json_params' )
			->andReturn(
				[
					'postType' => 'student',
				]
			);

		$purge->shouldReceive( 'get_response' )
			->andReturn( [] );

		$purge->shouldReceive( 'get_updated_cpts' )
			->andReturn( [ 'lecturer', 'department' ] );

		\WP_Mock::userFunction( 'rest_ensure_response' )
			->with(
				[
					'message'  => 'Posts deleted succesfully for custom Post Type: student',
					'postType' => 'student',
				]
			)
			->andReturn( $rest_response );

		$purge->request = $request;

		$this->assertInstanceOf( \WP_REST_Response::class, $purge->response() );
		$this->assertConditionsMet();
	}

	public function test_get_response_returns_undeleted_post_if_wp_delete_post_yields_false() {
		$purge = Mockery::mock( Purge::class )->makePartial();
		$purge->shouldAllowMockingProtectedMethods();

		$purge->shouldReceive( 'get_post_ids' )
			->andReturn( [ 1, 2, 3 ] );

		\WP_Mock::userFunction( 'wp_delete_post' )
			->andReturnUsing(
				function ( $arg ) {
					return $arg % 2;
				}
			);

		$response = $purge->get_response();

		$this->assertSame( [ 2 ], $response );
		$this->assertConditionsMet();
	}

	public function test_get_response_returns_undeleted_posts_if_wp_delete_post_yields_null() {
		$purge = Mockery::mock( Purge::class )->makePartial();
		$purge->shouldAllowMockingProtectedMethods();

		$purge->shouldReceive( 'get_post_ids' )
			->andReturn( [ 1, 2, 3 ] );

		\WP_Mock::userFunction( 'wp_delete_post' )
			->andReturnUsing(
				function ( $arg ) {
					return null;
				}
			);

		$response = $purge->get_response();

		$this->assertSame( [ 1, 2, 3 ], $response );
		$this->assertConditionsMet();
	}

	public function test_get_response_returns_empty_array_if_wp_delete_post_passes_for_all_ids() {
		$purge = Mockery::mock( Purge::class )->makePartial();
		$purge->shouldAllowMockingProtectedMethods();

		$purge->shouldReceive( 'get_post_ids' )
			->andReturn( [ 1, 2, 3 ] );

		\WP_Mock::userFunction( 'wp_delete_post' )
			->andReturnUsing(
				function ( $arg ) {
					return $arg;
				}
			);

		$response = $purge->get_response();

		$this->assertSame( [], $response );
		$this->assertConditionsMet();
	}

	public function test_get_post_ids() {
		$purge = Mockery::mock( Purge::class )->makePartial();
		$purge->shouldAllowMockingProtectedMethods();

		$post1     = Mockery::mock( \WP_Post::class )->makePartial();
		$post1->ID = 1;

		$post2     = Mockery::mock( \WP_Post::class )->makePartial();
		$post2->ID = 2;

		$post3     = Mockery::mock( \WP_Post::class )->makePartial();
		$post3->ID = 3;

		\WP_Mock::userFunction( 'get_posts' )
			->once()
			->with(
				[
					'post_type'   => 'student',
					'numberposts' => -1,
				]
			)
			->andReturn(
				[
					$post1,
					$post2,
					$post3,
				]
			);

		\WP_Mock::userFunction( 'wp_list_pluck' )
			->with(
				[
					$post1,
					$post2,
					$post3,
				],
				'ID'
			)
			->andReturnUsing(
				function ( $arg ) {
					return array_map(
						function ( $post ) {
							return $post->ID;
						},
						$arg
					);
				}
			);

		$purge->post_type = 'student';

		$ids = $purge->get_post_ids();

		$this->assertSame( $ids, [ 1, 2, 3 ] );
		$this->assertConditionsMet();
	}

	public function test_get_updated_cpts() {
		$purge = Mockery::mock( Purge::class )->makePartial();
		$purge->shouldAllowMockingProtectedMethods();

		\WP_Mock::userFunction( 'get_option' )
			->once()
			->with( 'sql_to_cpt', [] )
			->andReturn(
				[
					'cpts' => [ 'student', 'lecturer', 'department', 'worker' ],
				]
			);

		\WP_Mock::userFunction( 'update_option' )
			->once()
			->with(
				'sql_to_cpt',
				[
					'cpts' => [ 'lecturer', 'department', 'worker' ],
				]
			)
			->andReturn( null );

		$purge->post_type = 'student';

		$cpts = $purge->get_updated_cpts();

		$this->assertSame( $cpts, [ 'lecturer', 'department', 'worker' ] );
		$this->assertConditionsMet();
	}
}
