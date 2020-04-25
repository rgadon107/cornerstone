<?php
/**
 * Tests for _render_custom_column_content().
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
use function spiralWebDb\CornerstoneTours\_render_custom_column_content;

/**
 * Class Tests__RenderCustomColumnContent
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Unit
 * @group   tours
 * @group   admin
 */
class Tests__RenderCustomColumnContent extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	public static function setUpBeforeClass() {
		parent::setUpBeforeClass();

		require_once TOURS_ROOT_DIR . '/src/admin/wp-list-table.php';
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_render_custom_column_content( $column_name, $data, $expected ) {
		if ( 'tour_id' === $column_name ) {
			Functions\expect( 'get_post_meta' )->never();
			Functions\expect( 'get_post_field' )->never();

		} elseif ( 'tour_year' === $column_name ) {
			Functions\expect( 'get_post_meta' )
				->once()
				->with( $data['tour_id'], 'tour_year', true )
				->andReturn( $expected );
			Functions\expect( 'get_post_field' )->never();

		} elseif ( 'menu_order' === $column_name ) {
			Functions\expect( 'get_post_field' )
				->once()
				->with( 'menu_order', $data['tour_id'] )
				->andReturn( $expected );
			Functions\expect( 'get_post_meta' )->never();
		}

		ob_start();
		_render_custom_column_content( $column_name, $data['tour_id'] );
		$this->assertSame( $expected, ob_get_clean() );
	}

	public function addTestData() {
		return [
			[
				'column_name' => 'tour_id',
				'tour_data' => [
					'tour_id'    => 99,
					'tour_year'  => 2018,
					'menu_order' => 0,
				],
				'expected'  => '99',
			],
			[
				'column_name' => 'tour_year',
				'tour_data' => [
					'tour_id'    => 157,
					'tour_year'  => 2018,
				],
				'expected'  => '2018',
			],
			[
				'column_name' => 'menu_order',
				'tour_data' => [
					'tour_id'    => 211,
					'menu_order' => 5,
				],
				'expected'  => '5',
			],
		];
	}
}

