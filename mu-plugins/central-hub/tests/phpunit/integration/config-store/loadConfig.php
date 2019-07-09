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


	}
}