<?php
/**
 *  Tests for _get_plugin_url()
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
use function spiralWebDb\CornerstoneTours\_get_plugin_url;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\_get_plugin_url
 *
 * @group   tours
 */
class Tests__GetPluginUrl extends Test_Case {

	public function test_should_get_the_url_to_the_plugin_root_directory() {
		$expected = plugins_url( 'tours', _get_plugin_directory() );

		$this->assertEquals( $expected, _get_plugin_url() );
	}
}
 