<?php
/**
 * Tests for change_title_placeholder_text().
 *
 * @package     spiralWebDb\FAQ\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\FAQ\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\FAQ\Asset\maybe_enqueue_script;

/**
 * Class Tests_ChangeTitlePlaceholderText
 *
 * @package spiralWebDb\FAQ\Tests\Unit
 * @group   events
 * @group   admin
 */
class Tests_MaybeEnqueueScript extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once FAQ_ROOT_DIR . '/src/asset/handler.php';
	}

	/**
	 * Test maybe_enqueue_script() should return when the shortcode did not fire.
	 */
	public function test_should_return_when_shortcode_did_not_fire() {
		Functions\expect( 'spiralWebDb\Module\Custom\Shortcode\did_shortcode' )
			->once()
			->with( 'invalid_shortcode' )
			->andReturn( false );

		$this->assertNull( maybe_enqueue_script( 'invalid_shortcode' ) );
	}
}
