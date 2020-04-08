<?php
/**
 * Tests for add_description_beneath_post_title().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_AddDescriptionBeneathPostTitle
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests_AddDescriptionBeneathPostTitle extends Test_Case {

	/**
	 * Test add_description_beneath_post_title() should npt contain view when the post type is 'post'.
	 */
	public function test_should_not_contain_view_when_post_type_is_post() {
		// Create and get the post object for the 'post' post_type via the factory method.
		$post = self::factory()->post->create_and_get();
		$expected_html = <<<VIEW
<span class="description">Enter the theme name above for this Cornerstone tour. In the editor below, add each of the venues and locations (city, state) where Cornerstone performed on this tour. Below the editor, enter additional tour information in the box labeled "Past Tour Custom Fields".</span>
VIEW;

		// Run the output buffer to fire the event to which the callback is registered.
		ob_start();
		do_action( 'edit_form_before_permalink', $post );
		$actual_html = ob_get_clean();

		$this->assertNotContains( $expected_html, $actual_html );
	}

	/**
	 * Test add_description_beneath_post_title() should contain view when the post type is 'tours'.
	 */
	public function test_should_contain_view_when_post_type_is_tours() {
		// Create and get the post object with 'tours' post_type via the factory method.
		$post = $this->factory()->post->create_and_get( [ 'post_type' => 'tours' ] );
		$expected_html = <<<VIEW
<span class="description">Enter the theme name above for this Cornerstone tour. In the editor below, add each of the venues and locations (city, state) where Cornerstone performed on this tour. Below the editor, enter additional tour information in the box labeled "Past Tour Custom Fields".</span>
VIEW;

		// Run the output buffer to fire the event to which the callback is registered.
		ob_start();
		do_action( 'edit_form_before_permalink', $post );
		$actual_html = ob_get_clean();

		// Test the HTML
		$this->assertSame( $expected_html, $actual_html );
	}
}

