<?php
/**
 * Tests for _set_custom_columns().
 *
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\_set_custom_columns;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\_set_custom_columns
 *
 * @group   tours
 * @group   admin
 */
class Tests__SetCustomColumns extends Test_Case {

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_return_expected_array_of_custom_columns( $expected_columns ) {
		
		$this->assertSame( $expected_columns, _set_custom_columns() );
	}

	public function addTestData() {
		return [
			'custom_admin_columns' => [
				'expected_columns' => [
					'cb'         => '<input type="checkbox"/>',
					'title'      => 'Tour Name',
					'tour_id'    => 'Tour ID',
					'tour_year'  => 'Tour Year',
					'menu_order' => 'Order Number',
				]
			]
		];
	}
}

