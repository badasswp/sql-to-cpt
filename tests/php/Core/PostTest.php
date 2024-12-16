<?php

namespace SqlToCpt\Tests\Core;

use Mockery;
use WP_Mock\Tools\TestCase;

use SqlToCpt\Core\Post;

/**
 * @covers \SqlToCpt\Core\Post::__construct
 */
class PostTest extends TestCase {
	public Post $post;

	public function setUp(): void {
		\WP_Mock::setUp();

		$this->post = new Post( 'student' );
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}

	public function test_get_name() {
		$this->assertSame( $this->post->get_name(), 'student' );
	}

	public function test_get_singular_label() {
		$this->assertSame( $this->post->get_singular_label(), 'Student' );
	}

	public function test_get_plural_label() {
		$this->assertSame( $this->post->get_plural_label(), 'Students' );
	}

	public function test_get_supports() {
		$this->assertSame( $this->post->get_supports(), [ 'title', 'thumbnail', 'custom-fields' ] );
	}

	public function test_is_post_visible_in_rest() {
		$this->assertSame( $this->post->is_post_visible_in_rest(), true );
	}

	public function test_is_post_visible_in_menu() {
		$this->assertSame( $this->post->is_post_visible_in_menu(), true );
	}

	public function test_get_options() {
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

		\WP_Mock::expectFilter( 'sqlt_cpt_post_labels', $student_post_labels );

		\WP_Mock::onFilter( 'sqlt_cpt_post_options' )
			->with( $student_post_options )
			->reply(
				array_merge(
					$student_post_options,
					[
						'show_in_rest' => false,
						'show_in_menu' => false,
					]
				)
			);

		$this->assertSame(
			$this->post->get_options(),
			[
				'name'         => 'student',
				'labels'       => $student_post_labels,
				'supports'     => [ 'title', 'thumbnail', 'custom-fields' ],
				'show_in_rest' => false,
				'show_in_menu' => false,
				'public'       => true,
				'rewrite'      => [
					'slug' => 'student',
				],
			]
		);
	}

	public function test_get_labels() {
		\WP_Mock::userFunction(
			'__',
			[
				'return' => function ( $label, $text_domain = 'sql-to-cpt' ) {
					return $label;
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

		\WP_Mock::onFilter( 'sqlt_cpt_post_labels' )
			->with( $student_post_labels )
			->reply(
				array_merge(
					$student_post_labels,
					[
						'name'          => 'Candidates',
						'singular_name' => 'Candidate',
						'search_items'  => 'Search Candidates',
					]
				)
			);

		$this->assertSame(
			$this->post->get_labels(),
			[
				'name'          => 'Candidates',
				'singular_name' => 'Candidate',
				'add_new'       => 'Add New Student',
				'add_new_item'  => 'Add New Student',
				'new_item'      => 'New Student',
				'edit_item'     => 'Edit Student',
				'view_item'     => 'View Student',
				'search_items'  => 'Search Candidates',
				'menu_name'     => 'Students',
			]
		);

		$this->assertConditionsMet();
	}

	public function test_register_post_type() {
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

		\WP_Mock::expectFilter( 'sqlt_cpt_post_labels', $student_post_labels );
		\WP_Mock::expectFilter( 'sqlt_cpt_post_options', $student_post_options );

		\WP_Mock::userFunction( 'register_post_type' )
			->with( 'student', $student_post_options );

		$this->post->register_post_type();

		$this->assertConditionsMet();
	}
}
