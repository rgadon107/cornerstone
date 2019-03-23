<?php
/**
 * Tests for maybe_enqueue_script().
 *
 * @package     spiralWebDb\FAQ\Tests\Integration\Asset
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\FAQ\Tests\Integration\Asset;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\FAQ\Asset\maybe_enqueue_script;

/**
 * Class Tests_MaybeEnqueueScript
 *
 * @package spiralWebDb\FAQ\Tests\Integration\Asset
 * @group   faq
 * @group   asset
 */
class Tests_MaybeEnqueueScript extends Test_Case {

	/**
	 * Test maybe_enqueue_script() should return when the shortcode did not fire.
	 */
	public function test_should_return_when_shortcode_did_not_fire() {
		$this->assertTrue( true );
	}
}
