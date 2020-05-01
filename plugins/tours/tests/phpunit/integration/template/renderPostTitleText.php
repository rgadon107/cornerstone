<?php
/**
 * Tests for render_post_title_text().
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
 * @covers ::\spiralWebDb\CornerstoneTours\Template\render_post_title_text
 *
 * @group   tours
 * @group   template
 */
class Tests_RenderPostTitleText extends Test_Case {

	/**
	 * Test render_post_title_text() should render the post title when the filter event fires.
	 */
	public function test_should_echo_post_title_when_filter_event_fires() {
		$post = $this->factory->post->create_and_get(
			[
				'post_type'  => 'tours',
				'post_title' => 'I Make All Things New',
			]
		);
		$expected_title = $post->post_title;
		$this->go_to( '?tours=i-make-all-things-new' );

		ob_start();
		apply_filters( 'genesis_post_title_text', get_the_title() );
		$actual_title = ob_get_clean();

		$this->assertEquals( $expected_title, $actual_title );
	}
}

