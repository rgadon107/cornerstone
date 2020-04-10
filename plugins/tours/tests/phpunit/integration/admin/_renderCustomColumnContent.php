<?php
/**
 * Tests for _render_custom_column_content().
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
 * Class Tests__RenderCustomColumnContent
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests__RenderCustomColumnContent extends Test_Case {

	/*
	 * Test _render_custom_column_content() should echo $tour_id when column_name is 'tour_id'.
	 */
	public function test_should_echo_tour_id_when_column_name_is_tour_id() {
		// Create and get the $tour_id for the 'tours' post_type using WordPress' factory method.
		$post        = self::factory()->post->create_and_get( [ 'post_type' => 'tours' ] );
		$column_name = 'tour_id';
		$expected    = $post->ID;

		// Run the output buffer to fire the event to which the callback is registered.
		ob_start();
		do_action( "manage_{$post->post_type}_posts_custom_column", $column_name, $post->ID );
		$actual = (int) ob_get_clean();

		$this->assertSame( $expected, $actual );
	}

	/*
	 * Test _render_custom_column_content() should echo $tour_year when column_name is 'tour_year'.
	 */
	public function test_should_echo_tour_year_when_column_name_is_tour_year() {
		// Create and get the $tour_id for the 'tours' post_type using WordPress' factory method.
		$post = self::factory()->post->create_and_get( [ 'post_type' => 'tours' ] );

		// Add post_meta to the database so we can call it.
		add_post_meta( $post->ID, 'tour_year', '2018' );

		$column_name = 'tour_year';
		$expected    = (int) get_post_meta( $post->ID, 'tour_year', true );

		// Run the output buffer to fire the event to which the callback is registered.
		ob_start();
		do_action( "manage_{$post->post_type}_posts_custom_column", $column_name, $post->ID );
		$actual = (int) ob_get_clean();

		$this->assertSame( $expected, $actual );

		// Clean up database.
		delete_post_meta( $post->ID, 'tour_year' );
	}

	/*
	 * Test _render_custom_column_content() should echo $menu_order when column_name is 'menu_order'.
	 */
	public function test_should_echo_menu_order_when_column_name_is_menu_order() {
		// Create and get the $tour_id for the 'tours' post_type using WordPress' factory method.
		$post        = self::factory()->post->create_and_get(
			[
				'post_type'  => 'tours',
				'menu_order' => 5
			]
		);
		$column_name = 'menu_order';
		$expected    = $post->menu_order;

		// Run the output buffer to fire the event to which the callback is registered.
		ob_start();
		do_action( "manage_{$post->post_type}_posts_custom_column", $column_name, $post->ID );
		$actual = (int) ob_get_clean();

		$this->assertSame( $expected, $actual );
	}
}
