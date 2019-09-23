<?php
/**
 * Tests for the function get_meta_box_keys().
 *
 * @package     spiralWebDb\centralHub\Tests\Integration\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use function KnowTheCode\ConfigStore\loadConfig;
use function spiralWebDB\Metadata\get_meta_box_keys;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_GetMetaBoxKeys
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_GetMetaBoxKeys extends Test_Case {

	/**
	 * Empty the store before starting these tests.
	 */
	public static function setUpBeforeClass() {
		self::empty_the_store();
	}

	/**
	 * Test get_meta_box_keys() returns empty array when store key is empty or does not start with 'meta_box.'
	 */
	public function test_returns_empty_array_when_store_key_is_empty_or_does_not_begin_with_meta_box() {
		loadConfig( '', [] );
		get_meta_box_keys();

		$this->assertSame( [], get_meta_box_keys() );
	}

	/**
	 * Test get_meta_box_keys() returns all array keys that start with `meta_box.`
	 */
	public function test_returns_all_array_keys_that_start_with_meta_box() {
		$configs = [
			'meta_box.events'        => [
				'Trinity Lutheran Church'  => 'Columbus, OH',
				'Sanibel Episcopal Church' => 'Sanibel Island, FL',
			],
			'meta_box.members'       => [
				'Brandon Bird'     => 'First Trombone',
				'Talia Marie Aull' => 'Soprano',
			],
			'shortcode.qa'           => [
				'Question 1' => 'How many angels can dance on the head of a pin?',
				'Question 2' => 'Is the moon made of green cheese?',
			],
			'custom_post_type.books' => [
				'Title'  => 'The DaVinci Code',
				'Author' => 'Dan Brown',
			],
		];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}

		$this->assertSame( [ 'meta_box.events', 'meta_box.members' ], get_meta_box_keys() );

		// Clean up.
		self::empty_the_store( $configs );
	}
}

