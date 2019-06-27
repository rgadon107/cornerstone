<?php
/**
 *  Tests for external API function loadConfigFromFilesystem()
 *
 * @package    spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\ConfigStore;

use function KnowTheCode\ConfigStore\loadConfigFromFilesystem;
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

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/api.php';
	}

	/**
	 * Test loadConfigFromFilesystem() should merge defaults with config
	 *   and return store key.
	 */
	public function test_should_merge_defaults_and_return_store_key() {
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		$defaults     = [
			'foo' => [
				'aaa' => 37,
				'eee' => 'Coding is fun!'
			]
		];

		$this->assertSame( 'foo', loadConfigFromFilesystem( $path_to_file, $defaults ) );
	}

	/**
	 * Test for edge case #2.
	 */


}