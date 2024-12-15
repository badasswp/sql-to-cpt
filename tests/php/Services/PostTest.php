<?php

namespace SqlToCpt\Tests\Services;

use Mockery;
use WP_Mock\Tools\TestCase;

use SqlToCpt\Services\Post;
use SqlToCpt\Abstracts\Service;
use SqlToCpt\Core\Post as CPT;

/**
 * @covers \SqlToCpt\Services\Post::register
 * @covers \SqlToCpt\Services\Post::register_post_types
 * @covers \SqlToCpt\Services\Post::__construct
 */
class PostTest extends TestCase {
	public Post $post;

	public function setUp(): void {
		\WP_Mock::setUp();

		\WP_Mock::userFunction( 'get_option' )
			->with( 'sql_to_cpt', [] )
			->andReturn(
				[
					'cpts' => [
						'student',
						'department',
					],
				]
			);

		\WP_Mock::expectFilter(
			'sqlt_cpt_post_types',
			[
				'student',
				'department',
			]
		);

		$this->post = new Post();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}

	public function test_post_objects_contains_instances_of_CPTs() {
		$this->assertSame( count( $this->post->objects ), 2 );
		$this->assertInstanceOf( CPT::class, $this->post->objects[0] );
		$this->assertInstanceOf( CPT::class, $this->post->objects[1] );
	}

	public function test_register() {
		\WP_Mock::expectActionAdded( 'init', [ $this->post, 'register_post_types' ] );

		$this->post->register();

		$this->assertConditionsMet();
	}

	public function test_register_post_types_does_nothing_if_post_types_are_already_registered() {
		\WP_Mock::userFunction(
			'post_type_exists',
			[
				'return' => function ( $post_type ) {
					if ( in_array( $post_type, [ 'student', 'department' ], true ) ) {
						return true;
					}
				},
			]
		);

		$this->post->register_post_types();

		$this->assertConditionsMet();
	}
}
