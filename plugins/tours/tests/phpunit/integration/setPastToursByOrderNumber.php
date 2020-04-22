<?php
/**
 * Tests for set_past_tours_by_order_number().
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
 * Class Tests_SetPastToursByOrderNumber
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests_SetPastToursByOrderNumber extends Test_Case {

	/**
	 * Test set_past_tours_by_order_number() is registered to do_action_ref_array( 'pre_get_posts' ) when event fires.
	 */
	public function test_callback_is_registered_to_action_hook_when_event_fires() {
		$this->assertEquals( 10, has_action( 'pre_get_posts', 'spiralWebDb\CornerstoneTours\set_past_tours_by_order_number' ) );
	}

	/**
	 * Test set_past_tours_by_order_number() should return tours in DESC order by each tour's menu_order.
	 */
	public function test_should_return_tours_in_desc_order_menu_order() {
		$post_ids       = [];
		$expected_order = [
			0 => 4,
			1 => 3,
			2 => 2,
			3 => 1,
		];
		foreach ( $expected_order as $order => $menu_order ) {
			$post_ids[ $order ] = $this->factory()->post->create(
				[
					'post_type'  => 'tours',
					'menu_order' => $menu_order,
				]
			);
		}
		$this->go_to( '?post_type=tours' );

		$this->assertEqualSets( $post_ids, wp_list_pluck( $GLOBALS['wp_query']->posts, 'ID' ) );
	}
}

