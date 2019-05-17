<?php
/**
 *  Tests for _merge_with_defaults
 *
 * @package    spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\ConfigStore;

use function KnowTheCode\ConfigStore\_merge_with_defaults;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_MergeWithDefaults
 *
 * @package spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @group   config-store
 */
class Tests_MergeWithDefaults extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/internals.php';
	}

	/**
	 *  Test should merge configuration array with array of default parameters
	 *
	 */
	public function test_should_merge_config_array_with_defaults() {
		$config = (array) require CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		$defaults = [];
		$actual = _merge_with_defaults( (array) $config, (array) $defaults );

		$this->assertEmpty( $defaults );
		$this->assertArrayHasKey( 'foo', $actual );
		$this->assertSame( $config, $actual );
	}
}

