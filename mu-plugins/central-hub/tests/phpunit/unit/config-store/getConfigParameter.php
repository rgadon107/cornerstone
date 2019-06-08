<?php
/**
 * Tests for getConfigParameter().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\ConfigStore;

use Brain\Monkey;
use function KnowTheCode\ConfigStore\getConfigParameter;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_GetConfigParameter
 *
 * @package spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @group   config-store
 */
class Tests_GetConfigParameter extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/api.php';
	}

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

		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\getConfig' )
			// For the 1st assertion.
			->once()
			->with( __METHOD__ )
			->ordered()
			->andReturn( $config )
			// For the 2nd assertion.
			->andAlsoExpectIt()
			->once()
			->with( __METHOD__ )
			->ordered()
			->andReturn( $config )
			// For the 3rd assertion.
			->andAlsoExpectIt()
			->once()
			->with( __METHOD__ )
			->ordered()
			->andReturn( $config );

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
