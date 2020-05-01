<?php
/**
 * Tests for _set_sortable_columns().
 *
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\_set_sortable_columns;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\_set_sortable_columns
 *
 * @group   tours
 * @group   admin
 */
class Tests__SetSortableColumns extends Test_Case {

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_return_filtered_array_of_sortable_columns( $expected_columns ) {
		
		$this->assertSame( $expected_columns, _set_sortable_columns() );
	}

	public function addTestData()   {
		return [
			'sortable_columns' => [
				'expected_columns' => [
					'tour_id'    => 'Tour ID',
					'tour_year'  => 'Tour Year',
					'menu_order' => 'Order Number',
				]
			]
		];
	}
}

