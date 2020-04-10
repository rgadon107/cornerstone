<?php
/**
 * Tests for render_tour_comments().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Brain\Monkey;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\render_tour_comments;

/**
 * Class Tests_RenderTourComments
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Unit
 * @group   tours
 */
class Tests_RenderTourComments extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/meta.php';
	}

	/*
	 * Test render_the_tour_regions() should echo 'tour_comments' when post_meta is available.
	 */
	public function test_should_echo_tour_comments_when_post_meta_is_available_from_database() {
		$tour_id     = 359;
		$tour_comments = 'Note: Performed in Zankel Hall at Carnegie Hall, New York, NY';
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $tour_id, 'tour_comments', true )
			->andReturn( $tour_comments );

		$this->expectOutputString( $tour_id );
		render_tour_comments( $tour_id );
	}
}

