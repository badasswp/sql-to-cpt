<?php

namespace SqlToCpt\Tests\Services;

use Mockery;
use WP_Mock\Tools\TestCase;

use SqlToCpt\Services\Post;
use SqlToCpt\Abstracts\Service;
use SqlToCpt\Core\Post as CPT;

/**
 * @covers \SqlToCpt\Core\Post::get_name
 * @covers \SqlToCpt\Core\Post::get_labels
 * @covers \SqlToCpt\Core\Post::get_options
 * @covers \SqlToCpt\Core\Post::get_plural_label
 * @covers \SqlToCpt\Core\Post::get_singular_label
 * @covers \SqlToCpt\Core\Post::get_slug
 * @covers \SqlToCpt\Core\Post::get_supports
 * @covers \SqlToCpt\Core\Post::register_post_type
 * @covers \SqlToCpt\Core\Post::is_post_visible_in_menu
 * @covers \SqlToCpt\Core\Post::is_post_visible_in_rest
 * @covers \SqlToCpt\Core\Post::__construct
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

	public function test_registers_post_types() {
		\WP_Mock::userFunction(
			'post_type_exists',
			[
				'return' => function ( $post_type ) {
					if ( in_array( $post_type, [ 'student', 'department' ], true ) ) {
						return false;
					}
				},
			]
		);

		\WP_Mock::userFunction(
			'__',
			[
				'return' => function ( $label, $text_domain = 'sql-to-cpt' ) {
					return $label;
				},
			]
		);

		\WP_Mock::userFunction(
			'sanitize_title',
			[
				'return' => function ( $text ) {
					return join( '-', array_map( 'strtolower', explode( ' ', $text ) ) );
				},
			]
		);

		$student_post_labels = [
			'name'          => 'Students',
			'singular_name' => 'Student',
			'add_new'       => 'Add New Student',
			'add_new_item'  => 'Add New Student',
			'new_item'      => 'New Student',
			'edit_item'     => 'Edit Student',
			'view_item'     => 'View Student',
			'search_items'  => 'Search Students',
			'menu_name'     => 'Students',
		];

		$department_post_labels = [
			'name'          => 'Departments',
			'singular_name' => 'Department',
			'add_new'       => 'Add New Department',
			'add_new_item'  => 'Add New Department',
			'new_item'      => 'New Department',
			'edit_item'     => 'Edit Department',
			'view_item'     => 'View Department',
			'search_items'  => 'Search Departments',
			'menu_name'     => 'Departments',
		];

		$student_post_options = [
			'name'         => 'student',
			'labels'       => $student_post_labels,
			'supports'     => [ 'title', 'thumbnail', 'custom-fields' ],
			'show_in_rest' => true,
			'show_in_menu' => true,
			'public'       => true,
			'rewrite'      => [
				'slug' => 'student',
			],
		];

		$department_post_options = [
			'name'         => 'department',
			'labels'       => $department_post_labels,
			'supports'     => [ 'title', 'thumbnail', 'custom-fields' ],
			'show_in_rest' => true,
			'show_in_menu' => true,
			'public'       => true,
			'rewrite'      => [
				'slug' => 'department',
			],
		];

		\WP_Mock::expectFilter( 'sqlt_cpt_post_labels', $student_post_labels );
		\WP_Mock::expectFilter( 'sqlt_cpt_post_labels', $department_post_labels );

		\WP_Mock::expectFilter( 'sqlt_cpt_post_options', $student_post_options );
		\WP_Mock::expectFilter( 'sqlt_cpt_post_options', $department_post_options );

		\WP_Mock::userFunction( 'register_post_type' )
			->with( 'student', $student_post_options );

		\WP_Mock::userFunction( 'register_post_type' )
			->with( 'department', $department_post_options );

		$this->post->register_post_types();

		$this->assertConditionsMet();
	}
}
