<?php
/**
 *  Tests for getConfig()
 *
 * @package    spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\ConfigStore;

use Brain\Monkey;
use function KnowTheCode\ConfigStore\getConfig;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_GetConfig
 *
 * @package spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @group   config-store
 */
class Tests_GetConfig extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/api.php';
	}

	/**
	 * Test getConfig() should return the requested configuration when a valid store key is given.
	 */
	public function test_should_return_configuration_when_store_key_is_given() {
		$config = [
			'foo' => [
				'aaa' => 'bbb',
				'ccc' => 'ddd',
			],
		];

		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_the_store' )
			->once()
			->with( __METHOD__ )
			->andReturn( $config );

		$expected = getConfig( __METHOD__ );
		$this->assertArrayHasKey( 'foo', $expected );
		$this->assertSame( $expected, $config );
	}

	/**
	 * Test getConfig() should return an empty array when the store key does not exist.
	 */
	public function test_should_return_empty_array_when_key_does_not_exist() {
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_the_store' )->never();

		$this->assertSame( [], getConfig( '' ) );
	}
}

