<?php
/**
 * Tests for _set_sortable_columns().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\_set_sortable_columns;

/**
 * Class Tests__SetSortableColumns
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests__SetSortableColumns extends Test_Case {

	/**
	 * Test _set_sortable_columns() should return filtered array of sortable columns.
	 */
	public function test_should_return_filtered_array_of_sortable_columns() {
		$expected = [
			'tour_id'    => 'Tour ID',
			'tour_year'  => 'Tour Year',
			'menu_order' => 'Order Number',
		];

		$this->assertSame( $expected, _set_sortable_columns() );
	}
}

