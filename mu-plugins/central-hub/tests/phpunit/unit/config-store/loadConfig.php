<?php
/**
 *  Tests for external API function loadConfig()
 *
 * @package    spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\ConfigStore;

use Brain\Monkey;
use function KnowTheCode\ConfigStore\loadConfig;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_LoadConfig
 *
 * @package spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @group   config-store
 */
class Tests_LoadConfig extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/api.php';
	}

	/**
	 * Test loadConfig() should store a config given a valid store key and config.
	 */
	public function test_should_store_config_in_the_store_given_valid_key_and_config() {
		$config = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
		];
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\_the_store' )
			->once()
			->with( 'foo', $config )
			->andReturn( true );
		$this->assertTrue( loadConfig( 'foo', $config ) );

		$config = [
			'aaa' => 37,
			'ccc' => 'Coding is fun!',
			'eee' => 'WordPress rocks!',
		];
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\_the_store' )
			->once()
			->with( __METHOD__, $config )
			->andReturn( true );
		$this->assertTrue( loadConfig( __METHOD__, $config ) );
	}

	/**
	 * Test loadConfig() should throw an Exception and message when given an empty store_key and valid config.
	 */
	public function test_should_throw_exception_when_given_empty_key_and_valid_config() {
		$config  = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
		];
		$message = sprintf(
			'Unable to store as no store key was given with the configuration to store: %s',
			print_r( $config, true )
		);
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\_the_store' )
			->once()
			->with( '', $config )
			->andThrow( new \Exception( $message ) );
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( $message );
		loadConfig( '', $config );
	}

	/**
	 * Test loadConfig() should throw an Exception and message when given a valid store key and empty config.
	 */
	public function test_should_throw_exception_when_given_valid_key_and_empty_config() {
		$config = [];
		$message = "Configuration for [foo] does not exist in the ConfigStore";
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\_the_store' )
			->once()
			->with( 'foo', $config )
			->andThrow( new \Exception( $message ) );
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( $message );
		loadConfig( 'foo', $config );
	}
}

