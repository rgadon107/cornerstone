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
use function has_action;
use WP_Query;
use function spiralWebDb\CornerstoneTours\set_past_tours_by_order_number;

/**
 * Class Tests_SetPastToursByOrderNumber
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests_SetPastToursByOrderNumber extends Test_Case {

	/**
	 * Instance of WP_Query for each test.
	 *
	 * @var object WP_Query
	 */
	protected $query;

	/**
	 * Query vars, after parsing
	 *
	 * @var array
	 */
	public $query_vars = array();

	/**
	 * Test set_past_tours_by_order_number() is registered to do_action_ref_array( 'pre_get_posts' ) when event fires.
	 */
	public function test_callback_is_registered_to_action_hook_when_event_fires() {
		$this->assertEquals( 10, has_action( 'pre_get_posts', 'spiralWebDb\CornerstoneTours\set_past_tours_by_order_number' ) );
	}

	/**
     * Test set_past_tours_by_order_number() should return modified query object from WP_Query when post_type_is 'tours'.
     */
	public function test_should_return_modified_query_when_post_type_is_tours() {
		// Create and get a post object for 'post' post_type with WordPress' factory method.
		$post = self::factory()->post->create_and_get( [ 'post_type' => 'tours' ] );
		// Instantiate a new WP_Query object.
		$query = new WP_Query();
		$query->query_vars( [ 'orderby' => 'menu_order', 'order' => 'DESC' ] );
		
		set_past_tours_by_order_number( $query );

		// When post_type is 'tours', $query object should contain updated query_vars.
		$this->assertContains( $query->query_vars( [ 'orderby' ] ), $query );
		$this->assertContains( $query->query_vars( [ 'order' ] ), $query );
	}
}

