<?php
/**
 *  Tests for _is_in_development_mode()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\CornerstoneTours\Tests\Integration
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\_is_in_development_mode;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\_is_in_development_mode
 *
 * @group   tours
 */
class Tests__IsInDevelopmentMode extends Test_Case {

	public function test_should_return_true_when_wp_debug_is_defined_and_true() {
		$expected = define( WP_DEBUG, true );

		$this->assertSame( $expected, _is_in_development_mode() );
	}
}
 