<?php
/**
 * Tests for set_custom_columns().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\set_custom_columns;

/**
 * Class Tests_SetCustomColumns
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests_SetCustomColumns extends Test_Case {
	
	/*
    * Test set_custom_columns() should return array of default admin columns for 'post' post type.
    */
	public function test_should_return_array_of_default_post_admin_columns() {
		$post_columns = [
			'cb'    => '<input type="checkbox"/>',
			'title' => _x( 'Title', 'column name' ),
			'date'  => __( 'Date' ),
		];

		$this->assertTrue( is_array( set_custom_columns( $post_columns ) ) );
		$this->assertArrayHasKey( 'cb', set_custom_columns( $post_columns ) );
		$this->assertArrayHasKey( 'title', set_custom_columns( $post_columns ) );
	}

	/*
	 * Test set_custom_columns() should return array of additional admin columns for 'tours' post type.
	 */
	public function test_should_return_array_of_additional_tours_admin_columns() {
		$post_columns = [
			'cb'    => '<input type="checkbox"/>',
			'title' => _x( 'Title', 'column name' ),
			'date'  => __( 'Date' ),
		];

		$this->assertTrue( is_array( set_custom_columns( $post_columns ) ) );
		$this->assertArrayHasKey( 'tour_id', set_custom_columns( $post_columns ) );
		$this->assertArrayHasKey( 'tour_year', set_custom_columns( $post_columns ) );
		$this->assertArrayHasKey( 'menu_order', set_custom_columns( $post_columns ) );
	}
}

