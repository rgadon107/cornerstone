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
	 * Test _set_sortable_columns() should return an array when registered to filter.
	 */
	public function test_should_return_an_array_when_registered_to_filter() {
		$sortable_columns = [
			'title'    => 'title',
			'parent'   => 'parent',
			'comments' => 'comment_count',
			'date'     => [ 'date', true ],
		];

		$this->assertContains( is_array( $sortable_columns ), _set_sortable_columns( $sortable_columns ) );
		$this->assertArrayHasKey( 'title', $sortable_columns );
		$this->assertArrayHasKey( 'parent', $sortable_columns );
		$this->assertArrayHasKey( 'comments', $sortable_columns );
		$this->assertArrayHasKey( 'date', $sortable_columns );
	}

	/**
	 * Test _set_sortable_columns() should return a filtered array when registered to filter.
	 */
	public function test_should_return_filtered_array_when_registered_to_filter() {
		$sortable_columns = [
			'title'    => 'title',
			'parent'   => 'parent',
			'comments' => 'comment_count',
			'date'     => [ 'date', true ],
		];

		$expected = [
			'tour_id'    => 'Tour ID',
			'tour_year'  => 'Tour Year',
			'menu_order' => 'Order Number',
		];

		$this->assertSame( $expected, _set_sortable_columns( $sortable_columns ) );
		$this->assertArrayHasKey( 'tour_id', _set_sortable_columns( $sortable_columns ) );
		$this->assertArrayHasKey( 'tour_year', _set_sortable_columns( $sortable_columns ) );
		$this->assertArrayHasKey( 'menu_order', _set_sortable_columns( $sortable_columns ) );



	}

}