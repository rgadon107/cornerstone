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
	 *  Test should return false when $path_to_file is empty string.
	 */
	public function test_should_return_false_when_path_to_file_is_empty_string() {
		$expected = false;

		$this->assertFalse( _load_config_from_filesystem( '') );
		$this->assertSame( $expected, _load_config_from_filesystem( '' ) );
	}

	/**
	 *  Test should return array key and current array when a configuration array is given.
	 */
	public function test_should_return_array_key_and_current_array_from_config() {
		$expected = 'foo';

		$config = [
			'foo' => [
				'aaa' => 'bbb',
				'ccc' => 'ddd'
			]
		];

		$this->assertArrayHasKey( 'foo', $config );
		$this->assertSame( $expected, key( $config ) );
		$this->assertSame( $config['foo'], current( $config ) );
	}
}
