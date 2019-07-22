<?php
/**
 * Tests for the function register_meta_boxes().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\Metadata;

use Brain\Monkey;
use function spiralWebDB\Metadata\register_meta_boxes;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;


/**
 * Class Tests_RegisterMetaBoxes
 *
 * @package spiralWebDb\centralHub\Tests\Unit\Metadata
 * @group   meta-data
 */
class Tests_RegisterMetaBoxes extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/meta-box.php';

	}

	/*
	 * Test that the 'admin_menu' add_action() event actually fires.
	 */
	public function test_that_admin_menu_add_action_event_fires() {

		register_meta_boxes();

		$this->assertTrue( has_action( 'admin_menu', 'spiralWebDB\Metadata\register_meta_boxes' ) );
	}
}