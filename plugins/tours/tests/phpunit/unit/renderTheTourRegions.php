<?php
/**
 * Tests for render_the_tour_regions().
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
use function spiralWebDb\CornerstoneTours\render_the_tour_regions;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\render_the_tour_regions
 *
 * @group   tours
 */
class Tests_RenderTheTourRegions extends Test_Case {

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
	public function test_should_echo_meta_key_values_when_postmeta_exists( $tour_id, $meta, $expected ) {
		Functions\expect( 'get_post_meta' )
			->times( 1 )
			->with( $tour_id, 'tour_region', true )
			->andReturn( $meta );

		if ( ! is_null( $expected ) ) {
			$this->expectOutputString( $expected );
		}

		render_the_tour_regions( $tour_id );
	}

	public function addTestData() {
		return [
			'postmeta key value is empty' => [
				'tour_id'     => 79,
				'tour_region' => '',
				'expected'    => '',
			],
			'postmeta key value1 exists'  => [
				'tour_id'     => 106,
				'tour_region' => 'Midwest/Mid-Atlantic/Southeast',
				'expected'    => 'Midwest/Mid-Atlantic/Southeast',
			],
			'postmeta key value2 exists'  => [
				'tour_id'     => 147,
				'tour_region' => 'Midwest/West Coast/Southwest',
				'expected'    => 'Midwest/West Coast/Southwest',
			],
		];
	}
}

