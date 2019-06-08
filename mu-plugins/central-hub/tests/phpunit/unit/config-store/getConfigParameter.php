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

use function KnowTheCode\ConfigStore\_load_config_from_filesystem;
use function KnowTheCode\ConfigStore\getConfig;
use function KnowTheCode\ConfigStore\getConfigParameter;
use function KnowTheCode\ConfigStore\_the_store;
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

	// Test 1: $store_key given from stored config. $paramater within config exists.
	// Expect array on return.
	public function test_should_return_array_when_store_and_parameter_keys_given() {
		// Load configuration array into memory with test fixture.
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-get-config-parameter.php';
		$config       = _load_config_from_filesystem( $path_to_file );

		// Add $config to _the_store().
		_the_store( 'foo', $config ); // returns true; stores key & config.
		getConfig( 'foo' ); // check entire config can be retrieved. Runs inside getConfigParamater.

		// Challenge: How do I isolate the $parameter_key of 'aaa' inside 'foo' as a string value?
		// getConfigParameter() returns error msg; array key exists. Must be either string or integer.
		// I'm returning an array value.

		// Error Message: Exception: The configuration parameter [aaa] within [foo] does not exist
		// in this configuration (even though it's clearly there).
		$this->assertArrayHasKey( 'aaa', getConfigParameter( 'foo', 'aaa' ) );
	}

	// Test 2: $store_key not found in config. Exception will be thrown.

	// Test 3: $parameter not found in config. Exception will be thrown.
}