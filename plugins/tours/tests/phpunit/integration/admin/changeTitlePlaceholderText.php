<?php
/**
 * Tests for change_title_placeholder_text().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_ChangeTitlePlaceholderText
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests_ChangeTitlePlaceholderText extends Test_Case {

	/**
	 * Test change_title_placeholder_text() should return the given text when post type is 'post'.
	 */
	public function test_should_return_given_text_when_post_type_is_not_tours() {
		// Create and get the post object via the factory method with 'post' post_type.
		$post = self::factory()->post->create_and_get();
		$expected = 'Add title';

		// Run the output buffer to fire the event to which the callback is registered.
		ob_start();
		// Echo the value returned by the registered callback to compare in assert below.
		echo apply_filters( 'enter_title_here', 'Add title', $post );
		$actual_html = ob_get_clean();

		$this->assertSame( $expected, $actual_html );
	}

	/**
	 * Test change_title_placeholder_text() should return modified text when post type is 'tours'.
	 */
	public function test_should_return_modified_text_when_post_type_is_tours() {
		// Create and get the post object via the factory method and set post_type to 'tours' .
		$post = $this->factory()->post->create_and_get( [ 'post_type' => 'tours' ] );
		$expected_html = <<<PLACEHOLDER
Theme of this Cornerstone tour.
PLACEHOLDER;

		// Run the output buffer to fire the event to which the callback is registered.
		ob_start();
		// Echo the value returned by the registered callback to compare in assert below.
		echo apply_filters( 'enter_title_here', 'Add title', $post );
		$actual_html = ob_get_clean();

		// Test the HTML.
		$this->assertContains( $expected_html, $actual_html );
	}
}

