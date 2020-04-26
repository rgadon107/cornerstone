<?php
/**
 * Tests for change_title_placeholder_text().
 *
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\change_title_placeholder_text
 *
 * @group   tours
 * @group   admin
 */
class Tests_ChangeTitlePlaceholderText extends Test_Case {

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_return_expected_html( $text, $post_data, $expected_html ) {
		$post = $this->factory->post->create_and_get( $post_data );

		// Run the output buffer to fire the event to which the callback is registered.
		ob_start();
		// Echo the value returned by the registered callback to compare in assert below.
		echo apply_filters( 'enter_title_here', $text, $post );
		$actual_html = ob_get_clean();

		// Test the HTML.
		$this->assertSame( $expected_html, $actual_html );
	}

	public function addTestData() {
		return [
			[
				'text'          => 'Lorem ipsum',
				'post_data'     => [
					'post_type' => 'post',
				],
				'expected_html' => 'Lorem ipsum',
			],
			[
				'text'          => 'Lorem ipsum',
				'post_data'     => [
					'post_type' => 'events',
				],
				'expected_html' => 'Lorem ipsum',
			],
			[
				'text'          => 'Lorem ipsum',
				'post_data'     => [
					'post_type' => 'tours',
				],
				'expected_html' => <<<PLACEHOLDER
<em>Theme of this Cornerstone tour.</em>
PLACEHOLDER
	,
			],
		];
	}
}
