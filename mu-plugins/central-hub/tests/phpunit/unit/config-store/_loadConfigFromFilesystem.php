<?php
/**
 *  Tests for _load_config_from_filesystem
 *
 * @package    spiralWebDb\centralHub\Tests\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\ConfigStore;

use function KnowTheCode\ConfigStore\_load_config_from_filesystem;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_LoadConfigFromFilesystem
 *
 * @package spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @group   config-store
 */
class Tests_LoadConfigFromFilesystem extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/internals.php';
	}

	/**
	 *  Test _load_config_from_filesystem() should return an array when a configuration array is given.
	 */
	public function test_should_return_array_when_config_array_is_given() {
		$config = [
			'foo' => [
				'aaa' => 'bbb',
				'ccc' => 'ddd'
			]
		];

		$this->assertArrayNotHasKey( 'foo', $config[ 'foo' ]   );
	}
}