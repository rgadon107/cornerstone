<?php
/**
 *  Tests for render_tours_entry_content()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\CornerstoneTours\Tests\Unit
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\render_tours_entry_content;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\Template\render_tours_entry_content
 *
 * @group   tours
 * @group   template
 */
class Tests_RenderToursEntryContent extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/template/single-tours.php';
	}
}
 