<?php
/**
 * Tests for render_post_title_text().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\Template\render_post_title_text;

/**
 * Class Tests_RenderPostTitleText
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   template
 */
class Tests_RenderPostTitleText extends Test_Case {
	
	/**
	 * Test render_post_title_text() echoes the post title when the filter event fires.
	 */
	public function test_title_is_echoed_when_filter_event_fires() {
		// Create and get the post object for the 'tours' post_type using WordPress' factory method.
		$post     = self::factory()->post->create_and_get(
			[
				'post_type'  => 'tours',
				'post_title' => 'I Make All Things New',
			]
		);
		$expected = $post->post_title;
		$this->go_to( '?tours=i-make-all-things-new' );

		$this->assertSame( $expected, apply_filters( 'genesis_post_title_text', get_the_title() ) );
	}
}

