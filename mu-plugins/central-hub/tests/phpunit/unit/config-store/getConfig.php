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

use function KnowTheCode\ConfigStore\getConfig;
use function KnowTheCode\ConfigStore\_the_store;
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

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/internals.php';
		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/api.php';
	}

	/**
	 * Test should return configuration from _the_store() when store key is given.
	 */
	public function test_should_return_configuration_when_store_key_is_given() {
		$config = (array) require CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		_the_store( 'foo', $config );
		$expected = getConfig( 'foo' );

		$this->assertArrayHasKey( 'foo', $expected );
		$this->assertSame( $expected, $config );

		// Clean up _the_store.
		_the_store( 'foo', null, true );
	}

	/**
	 * Test should throw Exception when configuration does not exist in store.
	 */
	public function test_should_throw_exception_when_config_does_not_exist() {
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( 'Configuration for [foo] does not exist in the ConfigStore' );

		getConfig( 'foo' );
	}

	/**
	 * Test should return empty array when store key does not exist.
	 */
	public function test_should_return_empty_array_when_key_does_not_exist() {
		$config = (array) require CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		_the_store( '', $config );

		$this->assertSame( [], getConfig( '' ) );

		// Clean up _the_store.
		_the_store( '', null, true );
	}

	/**
	 * Test should return an empty array when store key and config are not stored.
	 */
	public function test_should_return_empty_array_when_key_and_config_not_stored() {
		$this->assertSame( [], getConfig( '' ) );
	}
}

