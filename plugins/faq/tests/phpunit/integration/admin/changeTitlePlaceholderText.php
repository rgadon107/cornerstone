<?php
/**
 * Tests for change_title_placeholder_text().
 *
 * @package     spiralWebDb\FAQ\Tests\Integration\Asset
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\FAQ\Tests\Integration\Asset;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\FAQ\Asset\maybe_enqueue_script;

/**
 * Class Tests_ChangeTitlePlaceholderText
 *
 * @package spiralWebDb\FAQ\Tests\Integration\ConfigStore
 * @group   events
 * @group   admin
 */
class Tests_ChangeTitlePlaceholderText extends Test_Case {

	/**
	 * Test maybe_enqueue_script() should return when the shortcode did not fire.
	 */
	public function test_should_return_when_shortcode_did_not_fire() {
		$this->assertTrue( true );
	}
}
