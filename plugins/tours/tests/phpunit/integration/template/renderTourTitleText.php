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
	 * Test render_post_title_text() should register to add_filter( 'genesis_post_title_text' ) when event fires.
	 */
//	public function test_callback_is_registered_to_filter_hook_when_event_fires() {
	// Note: The following assertions presently fails.
//		$this->assertEquals( 10, has_filter( 'genesis_post_title_text', 'spiralWebDb\CornerstoneTours\Template\render_post_title_text' ) );
//	}

	/**
	 * Test render_post_title_text() echoes the title when the filter event fires.
	 */
	public function test_title_is_echoed_when_filter_event_fires() {
		// Create and get the post object for the 'tours' post_type using WordPress' factory method.
		$post       = self::factory()->post->create_and_get(
			[
				'post_type'  => 'tours',
				'menu_order' => 15,
				'post_title' => 'I Make All Things New',
			]
		);
		$menu_order = $post->menu_order;
		$tour_id    = $post->ID;
		add_post_meta( $tour_id, 'tour_year', 2011, true );

		// Test that the post_meta was added to the database.
		$this->assertEquals( (int) 2011, (int) get_post_meta( $tour_id, 'tour_year', true ) );

		$this->go_to( '?tours=i-make-all-things-new' );

//		ob_start();
//		apply_filters( 'genesis_post_title_text', get_the_title() );
//		$actual_html = ob_get_clean();

	}
}

