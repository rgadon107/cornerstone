<?php
/**
 *  Tests for external API function getAllKeysStartingWith()
 *
 * @package    spiralWebDb\centralHub\Tests\Integration\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\ConfigStore;

use function KnowTheCode\ConfigStore\_the_store;
use function KnowTheCode\ConfigStore\loadConfig;
use function KnowTheCode\ConfigStore\getAllKeysStartingWith;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_GetAllKeysStartingWith
 *
 * @package spiralWebDb\centralHub\Tests\Integration\ConfigStore
 * @group   config-store
 */
class Tests_GetAllKeysStartingWith extends Test_Case {

	/**
	 * Empty the store before starting these tests.
	 */
	public static function setUpBeforeClass() {
		self::empty_the_store();
	}

	/**
	 * Test getAllKeysStartingWith() should filter and return all store keys that start with the given string.
	 */
	public function test_should_filter_and_return_all_store_keys_starting_with_given_string() {
		$configs = [
			'metabox.events'         => [
				'Trinity Lutheran Church'  => 'Columbus, OH',
				'Sanibel Episcopal Church' => 'Sanibel Island, FL',
			],
			'metabox.members'        => [
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

		$this->assertSame( [ 'metabox.events', 'metabox.members' ], getAllKeysStartingWith( 'metabox.' ) );
		$this->assertSame( [ 'shortcode.qa' ], getAllKeysStartingWith( 'shortcode.' ) );
		$this->assertSame( [ 'custom_post_type.books' ], getAllKeysStartingWith( 'custom_post_type.' ) );

		// Clean up by removing the configs (added by this test) from the store.
		self::empty_the_store( $configs );
	}

	/**
	 * Test getAllKeysStartingWith() should return an empty array when filtered keys do not start with a given string.
	 */
	public function test_should_return_empty_array_when_filtered_keys_do_not_start_with_a_given_string() {
		$expected = [];
		$this->assertSame( $expected, getAllKeysStartingWith( 'taxonomy.' ) );
	}

	/**
	 * Test getAllKeysStartingWith() should return an empty array when the store is empty.
	 */
	public function test_should_return_empty_array_when_the_store_is_empty() {
		$expected = [];
		$this->assertSame( $expected, getAllKeysStartingWith( 'taxonomy.' ) );
		$this->assertSame( $expected, getAllKeysStartingWith( '' ) );
	}

	/**
	 * Empty all of the configs from the store.
	 *
	 * @since 1.0.0
	 *
	 * @param array $configs    Optional. Array of configs stored in the store.
	 * @param array $store_keys Optional. Array of store keys to remove from store.
	 *
	 * @return void
	 * @throws \Exception
	 */
	protected static function empty_the_store( $configs = [], $store_keys = [] ) {
		// If no store keys or configs were given, grab the all configs from the store.
		if ( empty( $store_keys ) && empty( $configs ) ) {
			$configs = _the_store();
			if ( empty( $configs ) ) {
				return;
			}
		}

		// Extract store keys from the given configs.
		if ( empty( $store_keys ) ) {
			$store_keys = array_keys( $configs );
			if ( empty( $store_keys ) ) {
				return;
			}
		}

		foreach ( $store_keys as $store_key ) {
			_the_store( $store_key, null, true );
		}
	}
}
