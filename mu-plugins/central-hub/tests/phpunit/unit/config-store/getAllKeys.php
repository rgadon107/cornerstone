<?php
/**
 *  Tests for getAllKeys()
 *
 * @package    spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\ConfigStore;

use Brain\Monkey;
use function KnowTheCode\ConfigStore\getAllKeys;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_GetAllKeys
 *
 * @package spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @group   config-store
 */
class Tests_GetAllKeys extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/internals.php';
		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/api.php';
	}

	/**
	 * Test getAllKeys() should return the array keys from `_the_store()`.
	 */
	public function test_should_return_the_array_keys_from_the_store() {
		// array_keys() expects parameter 1 to be array, null given
		$config = [
			'aaa' => 37,
			'ccc' => 'Coding is fun!',
			'eee' => 'WordPress rocks!',
		];
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\_the_store' )
			->once()
			->with( 'foo', $config )
			->andReturnValues( [ 'foo' ] );
		$this->assertArrayHasKey( 'foo', getAllKeys() );
		$this->assertSame( 'foo', getAllKeys() );
	}
}

