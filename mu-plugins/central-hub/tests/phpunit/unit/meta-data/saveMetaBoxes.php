<?php
/**
 * Tests for the function save_meta_boxes().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\Metadata;

use Brain\Monkey;
use function spiralWebDB\Metadata\save_meta_boxes;
use function KnowTheCode\ConfigStore\loadConfig;
use function KnowTheCode\ConfigStore\getConfigParameter;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_SaveMetaBoxes
 *
 * @package spiralWebDb\centralHub\Tests\Unit\Metadata
 * @group   meta-data
 */
class Tests_SaveMetaBoxes extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/meta-box.php';
	}

	/*
    * Test save_meta_boxes() should register to add_action( save_post' ) when event fires.
    */
//	public function test_function_should_register_to_action_hook_when_event_fires() {
//		$this->assertTrue( has_action( 'save_post', 'spiralWebDB\Metadata\save_meta_boxes' ) );
//	}

	/**
	 * Test save_meta_boxes() should save custom fields and returns a valid nonce.
	 */
	public function test_function_should_save_custom_fields_and_return_valid_nonce() {
		$config_to_store = [
			'meta_box.members' => [
				'custom_fields' => [
					'role'            => 'Soprano',
					'residence_city'  => 'Chicago',
					'residence_state' => 'IL',
					'tour_number'     => '3',
				],
			],
		];
		loadConfig( 'meta_box.members', $config_to_store['meta_box.members'] );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_keys' )
			->once()
			->withNoArgs()
			->andReturn( [ 'meta_box.members' ] );
		Monkey\Functions\when( 'spiralWebDB\Metadata\get_meta_box_id' )
			->justReturn( 'members' );
		Monkey\Functions\when( 'spiralWebDB\Metadata\is_okay_to_save_meta_box' )
			->justReturn( 'wp_verify_nonce' );
		$config = getConfigParameter( 'meta_box.members', 'custom_fields' );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\save_custom_fields' )
			->once()
			->with( $config, 'members', 19 );

		$this->assertNull( save_meta_boxes( 19 ) );
	}
}
