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

use Brain\Monkey;
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
	 * Test getConfigParameter() should return the expected value when a valid store and parameter keys are given.
	 */
	public function test_should_return_value_when_valid_store_and_parameter_keys_given() {
		$config = [
			'aaa' => [
				'ddd' => 'Know the Code',
				'eee' => 'Config Store',
			],
			'bbb' => 'WordPress rocks!',
			'ccc' => 37,
		];

		// Store the configuration to set up this test.
		_the_store( __METHOD__, static::$config );

		$this->assertSame(
			[
				'ddd' => 'Know the Code',
				'eee' => 'Config Store',
			],
			getConfigParameter( __METHOD__, 'aaa' ) );
		$this->assertSame( 'WordPress rocks!', getConfigParameter( __METHOD__, 'bbb' ) );
		$this->assertSame( 37, getConfigParameter( __METHOD__, 'ccc' ) );
	}
}
