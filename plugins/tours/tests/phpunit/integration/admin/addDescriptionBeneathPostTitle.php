<?php
/**
 * Tests for add_description_beneath_post_title().
 *
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * @covers ::\spiralWebDb\Members\add_description_beneath_post_title
 *
 * @group   tours
 * @group   admin
 */
class Tests_AddDescriptionBeneathPostTitle extends Test_Case {

	/**
	 * @dataProvider addTestData
	 */
	public function testShouldRenderViewAsExpected( $post_data, $expected_html ) {
		$post = $this->factory->post->create_and_get( $post_data );

		// Run the output buffer to fire the event to which the callback is registered.
		ob_start();
		do_action( 'edit_form_before_permalink', $post );
		$actual_html = ob_get_clean();

		// Test the HTML
		$this->assertSame( $expected_html, $actual_html );
	}

	public function addTestData() {
		return [
			'test_should_not_contain_view_when_post_type_is_post' => [
				'post_data' => [
					'post_type' => 'post',
				],
				'expected'  => '',
			],
			'test_should_contain_view_when_post_type_is_tours'    => [
				'post_data' => [
					'post_type' => 'tours',
				],
				'expected'  => <<<VIEW
<span class="description">Enter the theme name above for this Cornerstone tour. In the editor below, add each of the venues and locations (city, state) where Cornerstone performed on this tour. Below the editor, enter additional tour information in the box labeled "Past Tour Custom Fields".</span>
VIEW
				,
			],
		];
	}
}
