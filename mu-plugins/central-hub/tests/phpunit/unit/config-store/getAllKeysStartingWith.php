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
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\getAllKeys' )
			->once()
			->withNoArgs()
			->andReturn( [
				'metabox.events',
				'metabox.members',
				'shortcode.qa',
				'custom_post_type.books',
			] );
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\str_starts_with' )
			->once()
			->with( 'metabox.events', 'metabox.' )
			->ordered()
			->andReturn( true )
			->andAlsoExpectIt()
			->once()
			->with( 'metabox.members', 'metabox.' )
			->ordered()
			->andReturn( true )
			->andAlsoExpectIt()
			->once()
			->with( 'shortcode.qa', 'metabox.' )
			->ordered()
			->andReturn( false )
			->andAlsoExpectIt()
			->once()
			->with( 'custom_post_type.books', 'metabox.' )
			->ordered()
			->andReturn( false );

		$this->assertSame( [ 'metabox.events', 'metabox.members' ], getAllKeysStartingWith( 'metabox.' ) );
	}
}
