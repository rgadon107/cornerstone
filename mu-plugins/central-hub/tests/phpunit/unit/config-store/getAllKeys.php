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
	 * Test getAllKeys() should return all store keys.
	 */
	public function test_should_return_all_store_keys() {
		$config_store = [
			'foo' => [
				'aaa' => 37,
				'ccc' => 'Coding is fun!',
				'eee' => 'WordPress rocks!',
			],
			'bar' => [
				'bbb' => 'Hello World',
			],
			'baz' => [
				'ddd' => 'Brain Monkey',
			],
		];
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\_the_store' )
			->once()
			->withNoArgs()
			->andReturn( $config_store );
		$this->assertSame( [ 'foo', 'bar', 'baz' ], getAllKeys() );
	}
}
