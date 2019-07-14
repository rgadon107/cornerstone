<?php
/**
 *  Tests for external API function getAllKeysStartingWith()
 *
 * @package    spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\ConfigStore;

use Brain\Monkey;
use function KnowTheCode\ConfigStore\getAllKeysStartingWith;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_GetAllKeysStartingWith
 *
 * @package spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @group   config-store
 */
class Tests_GetAllKeysStartingWith extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/api.php';
	}

	/**
	 * Test should filter all array keys and return keys that start with substring.
	 */
	public function test_should_get_all_array_keys_and_filter_by_substring_that_starts_with() {
		$config_store = [
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
				'Author' => 'Dan Brown'
			],
		];
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\getAllKeys' )
			->once()
			->withNoArgs()
			->andReturn( array_keys( $config_store ) );
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\str_starts_with' )
			->times( 4 )
			->with( 'getAllKeys', 'metabox.' )
			->andReturn( true );
		$expected = [ 'events', 'members' ];

		$this->assertSame( $expected, getAllKeysStartingWith( 'metabox.' ) );
	}


}

