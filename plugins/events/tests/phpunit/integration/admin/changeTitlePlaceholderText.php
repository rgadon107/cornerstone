<?php
/**
 * Tests for change_title_placeholder_text().
 *
 * @package     spiralWebDb\Events\Tests\Integration
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Events\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_ChangeTitlePlaceholderText
 *
 * @package spiralWebDb\Events\Tests\Integration
 * @group   events
 * @group   admin
 */
class Tests_ChangeTitlePlaceholderText extends Test_Case {

	/**
	 * Test change_title_placeholder_text() should return the given text when the post type is not 'events'.
	 */
	public function test_should_return_given_text_when_post_type_not_events() {
		$text = 'original text';
		$this->assertSame( $text, change_title_placeholder_text( $text ) );
	}
}
