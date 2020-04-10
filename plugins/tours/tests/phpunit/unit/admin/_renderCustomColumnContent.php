<?php
/**
 * Tests for _render_custom_column_content().
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
	 *  Test _render_custom_column_content() should echo 'tour_id' when $tour_id is given.
	 */
	public function test_should_echo_tour_id_when_column_name_is_tour_id() {
		$tour_id = 99;

		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $tour_id, 'tour_year', true )
			->never();
		Monkey\Functions\expect( 'get_post_field' )
			->once()
			->with( 'menu_order', $tour_id )
			->never();

		$this->expectOutputString( $tour_id );
		_render_custom_column_content( 'tour_id', $tour_id );
	}

	/*
	 * Test _render_custom_column_content() should echo the 'tour_year' when $tour_year is given.
	 */
	public function test_should_echo_tour_year_when_tour_year_is_given() {
		$tour_id   = 157;
		$tour_year = 2018;

		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $tour_id, 'tour_year', true )
			->andReturn( $tour_year );
		Monkey\Functions\expect( 'get_post_field' )
			->once()
			->with( 'menu_order', $tour_id )
			->never();

		$this->expectOutputString( $tour_year );
		_render_custom_column_content( 'tour_year', $tour_id );
	}

	/*
	 * Test _render_custom_column_content() should echo the 'menu_order' when $menu_order is given.
	 */
	public function test_should_echo_menu_order_when_menu_order_is_given() {
		$tour_id    = 211;
		$menu_order = 5;

		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $tour_id, 'tour_year', true )
			->never();
		Monkey\Functions\expect( 'get_post_field' )
			->once()
			->with( 'menu_order', $tour_id )
			->andReturn( $menu_order );

		$this->expectOutputString( $menu_order );
		_render_custom_column_content( 'menu_order', $tour_id );
	}
}

