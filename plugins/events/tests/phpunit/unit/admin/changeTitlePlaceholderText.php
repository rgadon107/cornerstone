<?php
/**
 * Tests for change_title_placeholder_text().
 *
 * @package     spiralWebDb\Events\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Events\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\Events\change_title_placeholder_text;

/**
 * Class Tests_ChangeTitlePlaceholderText
 *
 * @package spiralWebDb\Events\Tests\Unit
 * @group   events
 * @group   admin
 */
class Tests_ChangeTitlePlaceholderText extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once EVENTS_ROOT_DIR . '/src/admin/edit-form-advanced.php';
	}

	/**
	 * Test change_title_placeholder_text() should return the given text when the post type is not 'events'.
	 */
	public function test_should_return_given_text_when_post_type_not_events() {
		Functions\expect( 'get_post_type' )->once()->andReturn( 'post' );

		$text = 'original text';
		$this->assertSame( $text, change_title_placeholder_text( $text ) );
	}

	/**
	 * Test change_title_placeholder_text() should return text when the post type is 'events'.
	 */
	public function test_should_return_text_when_post_type_is_events() {
		Functions\expect( 'get_post_type' )->once()->andReturn( 'events' );

		$this->assertSame( 'Title of performance event.', change_title_placeholder_text( 'original text' ) );
	}
}
