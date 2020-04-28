<?php
/**
 * Tests for render_tour_comments().
 *
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Unit
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\render_tour_comments;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\render_tour_comments
 *
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

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_echo_tour_comments_when_post_meta_is_available_from_database( $post_data ) {
		Functions\expect( 'get_post_meta' )
			->once()
			->with( $post_data['tour_id'], 'tour_comments', true )
			->andReturn( $post_data['tour_comments'] );

		$this->expectOutputString( $post_data['tour_id'] );
		render_tour_comments( $post_data['tour_id'] );
	}

	public function addTestData() {
		return [
			'init_post_meta' => [
				'post_data' => [
					'tour_id'       => 359,
					'tour_comments' => 'Note: Performed in Zankel Hall at Carnegie Hall, New York, NY',
				]
			]
		];
	}
}

