<?php
/**
 * Tests for change_title_placeholder_text().
 *
 * @package     spiralWebDb\Members\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Members\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\Members\change_title_placeholder_text;

/**
 * Class Tests_ChangeTitlePlaceholderText
 *
 * @package spiralWebDb\Members\Tests\Unit
 * @group   members
 * @group   admin
 */
class Tests_ChangeTitlePlaceholderText extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once MEMBERS_ROOT_DIR . '/src/admin/edit-form-advanced.php';
	}

	/**
	 * Test change_title_placeholder_text() should return the given text when the post type is not 'members'.
	 */
	public function test_should_return_given_text_when_not_members_post_type() {
		// Set up the mocks.
		Functions\expect( 'get_post_type' )->once()->andReturn( 'post' );
		Functions\expect( 'esc_html' )->never();

		$text = 'original text';
		$this->assertSame( $text, change_title_placeholder_text( $text ) );
	}
}
