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
	 * Test save_meta_boxes() should not save when config meta box key does not begin with 'meta_box.'.
	 */
	public function test_should_not_save_when_config_meta_box_key_does_not_begin_with_metabox() {
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_keys' )
			->once()
			->withNoArgs()
			->andReturn( [] );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_id' )->never();
		Monkey\Functions\expect( 'spiralWebDB\Metadata\is_okay_to_save_meta_box' )->never();
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\getConfigParameter' )->never();
		Monkey\Functions\expect( 'spiralWebDB\Metadata\save_custom_fields' )->never();
		save_meta_boxes( 229 );
	}

	/**
	 * Test save_meta_boxes() should not save when the $meta_box_key does not exist in $_POST.
	 */
	public function test_should_not_save_when_the_meta_box_key_does_not_exist_in_POST() {
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
	 *  Test save_meta_boxes() should not save when the expected meta box nonce key is not validated.
	 */
	public function test_should_not_save_when_the_expected_meta_box_nonce_key_is_not_validated() {
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_keys' )
			->once()
			->withNoArgs()
			->andReturn( [ 'meta_box.reviews' ] );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_id' )
			->once()
			->with( 'meta_box.reviews' )
			->andReturn( 'reviews' );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\is_okay_to_save_meta_box' )
			->once()
			->with( 'reviews' )
			->andReturn( false );
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\getConfigParameter' )->never();
		Monkey\Functions\expect( 'spiralWebDB\Metadata\save_custom_fields' )->never();
		save_meta_boxes( 342 );
	}

	/**
	 * Test save_meta_boxes() should not save when the expected nonce fails.
	 */
	public function test_should_not_save_when_the_expected_nonce_fails() {
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
		save_meta_boxes( 349 );
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
		Monkey\Functions\when( 'spiralWebDB\Metadata\is_okay_to_save_meta_box' )
			->justReturn( 'wp_verify_nonce' );
		Monkey\Functions\when( 'KnowTheCode\ConfigStore\getConfigParameter' )
			->justReturn( [
				'role'            => 'Soprano',
				'residence_city'  => 'Chicago',
				'residence_state' => 'IL',
				'tour_number'     => '3',
			] );
		Monkey\Functions\when( 'spiralWebDB\Metadata\save_custom_fields' )
			->justReturn();
		save_meta_boxes( 354 );
	}
}
