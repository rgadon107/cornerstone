<?php
/**
 * Tests for add_description_beneath_post_title().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Brain\Monkey;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\add_description_beneath_post_title;

/**
 * Class Tests_AddDescriptionBeneathPostTitle
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Unit
 * @group   tours
 * @group   admin
 */
class Tests_AddDescriptionBeneathPostTitle extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/admin/edit-form-advanced.php';
	}

	/**
	 * Test add_description_beneath_post_title() should return empty when the post type is not 'tours'.
	 */
	public function test_should_return_empty_when_post_type_is_not_tours() {
		Monkey\Functions\expect( 'get_post_type' )
			->once()
			->andReturn( 'post' );

		$this->assertEmpty( add_description_beneath_post_title() );
	}

	/**
	 * Test add_description_beneath_post_title() should return string when the post type is 'tours'.
	 */
	public function test_should_return_string_when_post_type_is_tours() {
		Monkey\Functions\expect( 'get_post_type' )
			->once()
			->andReturn( 'tours' );

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		add_description_beneath_post_title();
		$actual_html = ob_get_clean();

		// Test the HTML.
		$this->assertContains( '<span class="description">', $actual_html );
		$this->assertContains( 'Enter the theme name above for this Cornerstone tour.', $actual_html );
		$this->assertContains( 'In the editor below, add each of the venues and locations (city, state) where Cornerstone performed on this tour.', $actual_html );
	}
}