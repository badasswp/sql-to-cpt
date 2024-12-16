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
}
