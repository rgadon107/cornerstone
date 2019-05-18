<?php
/**
 *  Tests for getConfig
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
 * Class Tests_getConfig
 *
 * @package spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @group   config-store
 */
class Tests_getConfig extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/internals.php';
		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/api.php';
	}

	/*
	 * Test that _the_store returns true when given a store key and config to store.
	 */
	public function test_that_the_store_returns_true_when_given_a_store_key_and_config() {
		$config_to_store = (array) require CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		$actual          = _the_store( __METHOD__, $config_to_store );

		$this->assertTrue( $actual );
		$this->assertSame( true, $actual );

		// Clean up _the_store.
		_the_store( __METHOD__, null, true );
	}

	/*
	 *  Test that _the_store is empty when no key is given.
	 */
	public function test_that_store_config_is_empty() {
		$expected = [];
		$actual   = getConfig( '' );

		$this->assertSame( $expected, $actual );
	}

	public function test_should_throw_error_when_store_key_does_not_exist_in_store() {
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( 'Configuration for [foo] does not exist in the ConfigStore' );
		getConfig( 'foo' );
	}
}

