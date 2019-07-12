<?php
/**
 *  Tests for external API function loadConfig()
 *
 * @package    spiralWebDb\centralHub\Tests\Integration\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\ConfigStore;

use function KnowTheCode\ConfigStore\loadConfig;
use function KnowTheCode\ConfigStore\_the_store;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_LoadConfig
 *
 * @package spiralWebDb\centralHub\Tests\Integration\ConfigStore
 * @group   config-store
 */
class Tests_LoadConfig extends Test_Case {

	/**
	 * Test loadConfig() should store a config given a valid store key and config.
	 */
	public function test_should_store_config_in_the_store_given_valid_key_and_config() {
		$config = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
		];
		$this->assertTrue( loadConfig( 'foo', $config ) );

		$config = [
			'aaa' => 37,
			'ccc' => 'Coding is fun!',
			'eee' => 'WordPress rocks!',
		];
		$this->assertTrue( loadConfig( __METHOD__, $config ) );

		// Clean up _the_store.
		_the_store( __METHOD__, null, true );
	}

	/**
	 * Test loadConfig() should throw an error when no store key is given with a config to store.
	 */
	public function test_should_throw_error_when_no_store_key_given_with_config_to_store() {
		$config  = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
		];
		$message = sprintf(
			'Unable to store as no store key was given with the configuration to store: %s',
			print_r( $config, true )
		);
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( $message );
		loadConfig( '', $config );
	}

	/**
	 * Test loadConfig() should throw an Exception and message when given a valid store key and empty config.
	 */
	public function test_should_throw_exception_when_given_valid_key_and_empty_config() {
		// Failed asserting that exception of type "Exception" is thrown.
		$config  = [];
		$message = "Configuration for [foo] does not exist in the ConfigStore";
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( $message );
		loadConfig( 'foo', $config );
	}
}

