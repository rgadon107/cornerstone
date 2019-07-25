<?php
/**
 * Tests for getConfigParameter().
 *
 * @package     spiralWebDb\centralHub\Tests\Integration\ConfigStore
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\ConfigStore;

use function KnowTheCode\ConfigStore\_the_store;
use function KnowTheCode\ConfigStore\getConfigParameter;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_GetConfigParameter
 *
 * @package spiralWebDb\centralHub\Tests\Integration\ConfigStore
 * @group   config-store
 */
class Tests_GetConfigParameter extends Test_Case {

	/**
	 * Empty the store before starting these tests.
	 */
	public static function setUpBeforeClass() {
		self::empty_the_store();
	}

	/**
	 * Test getConfigParameter() should return the expected value when a valid store and parameter keys are given.
	 */
	public function test_should_return_value_when_valid_store_and_parameter_keys_given() {
		// Store the configuration to set up this test.
		$config = [
			'aaa' => [
				'ddd' => 'Know the Code',
				'eee' => 'Config Store',
			],
			'bbb' => 'WordPress rocks!',
			'ccc' => 37,
		];
		_the_store( __METHOD__, $config );

		$this->assertSame(
			[
				'ddd' => 'Know the Code',
				'eee' => 'Config Store',
			],
			getConfigParameter( __METHOD__, 'aaa' ) );
		$this->assertSame( 'WordPress rocks!', getConfigParameter( __METHOD__, 'bbb' ) );
		$this->assertSame( 37, getConfigParameter( __METHOD__, 'ccc' ) );

		// Clean up.
		self::remove_from_store( __METHOD__ );
	}

	/**
	 * Test getConfigParameter() should throw an error when the parameter key does not exist in the stored
	 * configuration.
	 */
	public function test_should_throw_error_when_parameter_key_does_not_exist() {
		// Store the configuration to set up this test.
		$config = [
			'bbb' => 'WordPress rocks!',
		];
		_the_store( __METHOD__, $config );

		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( sprintf( 'The configuration parameter [key_does_not_exist] within [%s] does not exist in this configuration', __METHOD__ ) );
		getConfigParameter( __METHOD__, 'key_does_not_exist' );

		// Clean up.
		self::remove_from_store( __METHOD__ );
	}
}

