<?php
/**
 * Test Case for all of the Integration Test Suites
 *
 * @package     spiralWebDb\Cornerstone\Tests\Integration
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Cornerstone\Tests\Integration;

use Brain\Monkey;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use spiralWebDb\Cornerstone\Tests\Test_Case_Trait;
use WP_UnitTestCase;

/**
 * Abstract Class Test_Case
 *
 * @package spiralWebDb\Cornerstone\Tests\Integration
 */
abstract class Test_Case extends WP_UnitTestCase {
	use MockeryPHPUnitIntegration;
	use Test_Case_Trait;

	/**
	 * Set up the test before we run the test setups.
	 */
	public static function setUpBeforeClass() {
		parent::setUpBeforeClass();

		set_current_screen( 'front' );
	}

	/**
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();
		Monkey\setUp();
	}

	/**
	 * Cleans up the test environment after each test.
	 */
	public function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}
}