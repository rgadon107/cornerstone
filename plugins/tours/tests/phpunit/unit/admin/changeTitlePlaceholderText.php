<?php
/**
 * Tests for change_title_placeholder_text().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\change_title_placeholder_text;

/**
 * Class Tests_ChangeTitlePlaceholderText
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Unit
 * @group   tours
 * @group   admin
 */
class Tests_ChangeTitlePlaceholderText extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/admin/edit-form-advanced.php';
	}

	/**
	 * Test change_title_placeholder_text() should return original text when the post type is not 'tours'.
	 */
	public function test_should_return_given_text_when_post_type_is_not_tours() {
		$text = 'Add title.';
		Functions\expect( 'get_post_type' )
			->once()
			->andReturn( 'post' );

		$this->assertSame( $text, change_title_placeholder_text( $text ) );
	}

	/**
	 * Test change_title_placeholder_text() should return modified text when post type is 'tours'.
	 */
	public function test_should_return_modified_text_when_post_type_is_tours() {
		Functions\expect( 'get_post_type' )
			->once()
			->andReturn( 'tours' );
		$text     = 'Add title.';
		$expected = '<em>' . "Theme of this Cornerstone tour." . '</em>';

		$this->assertSame( $expected, change_title_placeholder_text( $text ) );
	}
}
