<?php
/**
 * Tests for render_tour_comments().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function add_post_meta;
use function get_post_meta;
use function delete_post_meta;
use function spiralWebDb\CornerstoneTours\render_tour_comments;

/**
 * Class Tests_RenderTourComments
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 */
class Tests_RenderTourComments extends Test_Case {

	/*
	 * Test render_the_tour_regions() should echo 'tour_comments' when post_meta is available.
	 */
	public function test_should_echo_tour_comments_when_post_meta_is_available_from_database() {
		// Create and get the $tour_id for the 'tours' post_type using WordPress' factory method.
		$post    = self::factory()->post->create_and_get( [ 'post_type' => 'tours' ] );

		// Add post_meta to the database so we can call it.
		add_post_meta(
			$post->ID,
			'tour_comments',
			'Note: Performed in Zankel Hall at Carnegie Hall, New York, NY'
		);

		$expected    = (string) get_post_meta( $post->ID, 'tour_comments', true );

		// Run the output buffer to fire the callback and return the output.
		ob_start();
		render_tour_comments( $post->ID );
		$actual = ob_get_clean();

		$this->assertSame( $expected, $actual );

		// Clean up database.
		delete_post_meta( $post->ID, 'tour_region' );

		// Let's add some different post_meta and test the callback again.

		// Add post_meta to the database so we can call it.
		add_post_meta(
			$post->ID,
			'tour_comments',
			'Note: Performed at Alice Tully Hall, Lincoln Center, New York, NY'
		);

		$expected    = (string) get_post_meta( $post->ID, 'tour_comments', true );

		// Run the output buffer to fire the callback and return the output.
		ob_start();
		render_tour_comments( $post->ID );
		$actual = ob_get_clean();

		$this->assertSame( $expected, $actual );

		// Clean up database.
		delete_post_meta( $post->ID, 'tour_region' );
	}
}

