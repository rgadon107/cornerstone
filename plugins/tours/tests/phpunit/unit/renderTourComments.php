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
	public function test_should_echo_meta_key_values_when_postmeta_exists( $tour_id, $meta ) {
		Functions\expect( 'get_post_meta' )
			->once()
			->with( $tour_id, 'tour_comments', true )
			->andReturn( $meta );

		if ( ! is_null( $meta ) ) {
			$this->expectOutputString( $meta );
		}

		render_tour_comments( $tour_id );
	}

	public function addTestData() {
		return [
			'empty postmeta key value'   => [
				'tour_id'   => 143,
				'post_meta' => [
					'tour_comments' => '',
				]
			],
			'postmeta key value1 exists' => [
				'tour_id'   => 359,
				'post_meta' => [
					'tour_comments' => 'Note: Performed in Zankel Hall at Carnegie Hall, New York, NY',
				]
			],
			'postmeta key value2 exists' => [
				'tour_id'   => 502,
				'post_meta' => [
					'tour_comments' => 'Note: Performed at Alice Tully Hall, Lincoln Center, New York, NY',
				]
			]
		];
	}
}

