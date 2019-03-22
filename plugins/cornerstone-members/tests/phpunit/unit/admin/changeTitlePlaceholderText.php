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
	public function test_should_return_given_text_when_post_type_not_members() {
		// Set up the mocks.
		Functions\expect( 'get_post_type' )->once()->andReturn( 'post' );
		Functions\expect( 'esc_html' )->never();

		$text = 'original text';
		$this->assertSame( $text, change_title_placeholder_text( $text ) );
	}

	/**
	 * Test change_title_placeholder_text() should return text when the post type is 'members'.
	 */
	public function test_should_return_text_when_post_type_is_members() {
		Functions\expect( 'get_post_type' )->once()->andReturn( 'members' );

		$this->assertSame( 'Enter member first and last name.', change_title_placeholder_text( 'original text' ) );
	}
}
