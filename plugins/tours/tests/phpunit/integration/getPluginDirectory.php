<?php
/**
 *  Tests for _get_plugin_directory()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\CornerstoneTours\Tests\Integration
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\_get_plugin_directory;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\_get_plugin_directory
 *
 * @group   tours
 */
class Tests_GetPluginDirectory extends Test_Case {

	public function test_should_return_absolute_path_to_plugin_root_directory() {
		$expected_path = dirname( dirname( dirname( __DIR__ ) ) );

		$this->assertEquals( $expected_path,_get_plugin_directory() );
	}
}
 