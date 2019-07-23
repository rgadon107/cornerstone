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
	 * Test register_meta_boxes() should register to add_action( 'admin_menu' ) when event fires.
	 */
	public function test_function_should_register_to_action_hook_when_event_fires() {
		$this->assertTrue( has_action( 'admin_menu', 'spiralWebDB\Metadata\register_meta_boxes' ) );
	}

	/*
	 * Test register_meta_boxes() will add a meta box for each store key that starts with 'metabox.'.
	 */
	function test_function_will_add_a_meta_box_for_each_store_key_that_starts_with_metabox() {
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_keys' )
			->once()
			->withNoArgs()
			->andReturn( [ 'meta_box.events' ] );
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\getConfigParameter' )
			->once()
			->with( 'meta_box.events', 'add_meta_box' );
		Monkey\Functions\when( 'spiralWebDB\Metadata\add_meta_box' )
			->justReturn( 'events' );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_id' )
			->once()
			->with( 'meta_box.events' )
			->andReturn( 'events' );

		$this->assertTrue( register_meta_boxes() );
	}

	/*
	 * Test register_meta_boxes() returns null when no store key starts with 'metabox.'.
	 */
	public function test_function_should_return_null_when_no_store_key_starts_with_metabox() {
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_keys' )
			->once()
			->withNoArgs()
			->andReturn( [] );

		$this->assertNull( register_meta_boxes() );
	}
}

