<?php

namespace SqlToCpt\Tests\Routes;

use Mockery;
use WP_Mock\Tools\TestCase;
use SqlToCpt\Routes\Import;
use SqlToCpt\Abstracts\Service;

/**
 * @covers \SqlToCpt\Routes\Import::__construct
 */
class ImportTest extends TestCase {
	public Import $import;

	public function setUp(): void {
		\WP_Mock::setUp();

		$this->import = new Import();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
	}
}
