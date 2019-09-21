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

	/**
	 * Test save_meta_boxes() should not save when no meta box keys are in the Config Store.
	 */
	public function test_should_not_save_when_no_meta_box_keys_are_in_store() {
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_keys' )
			->once()
			->withNoArgs()
			->andReturn( [] );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_id' )->never();
		Monkey\Functions\expect( 'spiralWebDB\Metadata\is_okay_to_save_meta_box' )->never();
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\getConfigParameter' )->never();
		Monkey\Functions\expect( 'spiralWebDB\Metadata\save_custom_fields' )->never();
		save_meta_boxes( 178 );
	}

	/**
	 * Test save_meta_boxes() should not save when the $meta_box_key is not validated in $_POST or
	 *    wp_verify_nonce().
	 */
	public function test_should_not_save_when_the_meta_box_key_is_not_validated() {
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_keys' )
			->once()
			->withNoArgs()
			->andReturn( [ 'meta_box.members' ] );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_id' )
			->once()
			->with( 'meta_box.members' )
			->andReturn( 'members' );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\is_okay_to_save_meta_box' )
			->once()
			->with( 'members' )
			->andReturn( false );
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\getConfigParameter' )->never();
		Monkey\Functions\expect( 'spiralWebDB\Metadata\save_custom_fields' )->never();
		save_meta_boxes( 317 );
	}

	/**
	 * Test save_meta_boxes() should save when one or more valid post meta values are added.
	 */
	public function test_should_save_when_one_or_more_valid_post_meta_values_are_added() {
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_keys' )
			->once()
			->withNoArgs()
			->andReturn( [ 'meta_box.members' ] );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_id' )
			->once()
			->with( 'meta_box.members' )
			->andReturn( 'members' );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\is_okay_to_save_meta_box' )
			->once()
			->with( 'members' )
			->andReturn( true );
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\getConfigParameter' )
			->once()
			->with( 'meta_box.members', 'custom_fields' )
			->andReturn( [
				'role'            => 'Soprano',
				'residence_city'  => 'Chicago',
				'residence_state' => 'IL',
				'tour_number'     => '3',
			] );
		$config = [
			'role'            => 'Soprano',
			'residence_city'  => 'Chicago',
			'residence_state' => 'IL',
			'tour_number'     => '3',
		];
		Monkey\Functions\expect( 'spiralWebDB\Metadata\save_custom_fields' )
			->once()
			->with( $config, 'members', 354 )
			->andReturn( null );
		save_meta_boxes( 354 );
	}
}
