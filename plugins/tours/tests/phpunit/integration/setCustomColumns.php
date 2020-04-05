<?php
/**
 * Tests for _set_custom_columns().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\_set_custom_columns;

/**
 * Class Tests_SetCustomColumns
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests_SetCustomColumns extends Test_Case {

	/*
     * Test _set_custom_columns() should return expected array of custom admin columns.
     */
	public function test_should_return_expected_array_of_custom_columns() {
		 $expected = [
			 'cb'         => '<input type="checkbox"/>',
			 'title'      => 'Tour Name',
			 'tour_id'    => 'Tour ID',
			 'tour_year'  => 'Tour Year',
			 'menu_order' => 'Order Number',
		];

		$this->assertSame( $expected, _set_custom_columns() );
	}
}

