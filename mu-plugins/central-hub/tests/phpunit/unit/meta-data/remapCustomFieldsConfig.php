<?php
/**
 * Tests for the function remap_custom_fields_config().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\Metadata;

use Brain\Monkey;
use function spiralWebDB\Metadata\remap_custom_fields_config;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_RemapCustomFieldsConfig
 *
 * @package spiralWebDb\centralHub\Tests\Unit\Metadata
 * @group   meta-data
 */
class Tests_RemapCustomFieldsConfig extends Test_Case {

	/**
	 * Prepare the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/meta-box.php';
	}

//	/**
//	 * Clean up the test environment after each test.
//	 */
//	public function tearDown() {
//		parent::tearDown();
//		$config = [];
//	}

	/**
	 *  Test remap_custom_fields_config() should return the default remapped config array when the given config is an
	 *  empty array.
	 */
	public function test_should_return_default_remapped_config_array_when_given_config_is_empty_array() {
		$config          = [];
		$remapped_config = [
			'is_single'    => [],
			'default'      => [],
			'delete_state' => [],
			'sanitize'     => [],
		];

		$this->assertSame( $remapped_config, remap_custom_fields_config( $config ) );
	}

	/**
	 * Test remap_custom_fields_config() should remap a config structure when the given config has post meta data.
	 */
	public function test_should_remap_config_structure_when_given_config_has_post_meta_data() {
		$config          = [
			'event-date' => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
			'event-time' => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
			'venue-name' => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
		];
		$remapped_config = [
			'is_single'    => [
				'event-date' => true,
				'event-time' => true,
				'venue-name' => true,
			],
			'default'      => [
				'event-date' => '',
				'event-time' => '',
				'venue-name' => '',
			],
			'delete_state' => [
				'event-date' => '',
				'event-time' => '',
				'venue-name' => '',
			],
			'sanitize'     => [
				'event-date' => 'sanitize_text_field',
				'event-time' => 'sanitize_text_field',
				'venue-name' => 'sanitize_text_field',
			],
		];
//		Monkey\Functions\expect( 'spiralWebDB\Metadata\remap_custom_fields_config' )
//			->once()
//			->with( $config )
//			->andReturn( $remapped_config );

		$this->assertSame( $remapped_config, remap_custom_fields_config( $config ) );
	}
}

