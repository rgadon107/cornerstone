<?php
/**
 * Tests for set_past_tours_by_order_number().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Mockery as m;
use Brain\Monkey;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\set_past_tours_by_order_number;

/**
 * Class Tests_SetPastToursByOrderNumber
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Unit
 * @group   tours
 */
class Tests_SetPastToursByOrderNumber extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/plugin.php';
	}

	/**
     * Test set_past_tours_by_order_number() should return unmodified query_vars from WP_Query when post_type_archive is false.
     */
	public function test_should_return_unmodified_query_vars_when_post_type_archive_is_false() {
		$this->query = m::mock( 'WP_Query' );
		$expected = $this->query;

		Monkey\Functions\expect( 'is_post_type_archive' )
			->once()
			->with( 'tours')
			->andReturn( false );

		$this->assertSame( $expected, set_past_tours_by_order_number( $this->query ) );
	}

	/**
	 * Test set_past_tours_by_order_number() should modify query_var default when tours post_type_archive is true.
	 */
	public function test_should_modify_query_var_default_when_tours_post_type_archive_is_true() {
		$query             = m::mock( 'WP_Query' );
		$query->query_vars = [
			'order'   => 'ASC',
			'orderby' => 'menu_order',
		];

		Monkey\Functions\expect( 'is_post_type_archive' )
			->once()
			->with( 'tours' )
			->andReturn( true );
		
		$query->shouldReceive( 'set' )
		      ->once()
		      ->with( 'orderby', 'menu_order' )
		      ->andReturnUsing(
			      function ( $key, $value ) use ( $query ) {
				      $this->setQueryVar( $query, $key, $value );
			      }
		      );

		$query->shouldReceive( 'set' )
		      ->once()
		      ->with( 'order', 'DESC' )
		      ->andReturnUsing(
			      function ( $key, $value ) use ( $query ) {
				      $this->setQueryVar( $query, $key, $value );
			      }
		      );

		$this->assertNull( set_past_tours_by_order_number( $query ) );

		$expected = [
			'order'   => 'DESC',
			'orderby' => 'menu_order',
		];
		$this->assertSame( $expected, $query->query_vars );
	}

	protected function setQueryVar( $query, $key, $value ) {
		$query->query_vars[ $key ] = $value;
	}
}

