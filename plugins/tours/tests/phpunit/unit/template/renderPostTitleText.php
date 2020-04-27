<?php
/**
 * Tests for render_post_title_text().
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
use function spiralWebDb\CornerstoneTours\Template\render_post_title_text;

/**
 * Class Tests_RenderPostTitleText
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Unit
 * @group   tours
 * @group   template
 */
class Tests_RenderPostTitleText extends Test_Case {

	/**
	 * Prepare the test environment before each test.
	 */
	public static function setUpBeforeClass() {
		parent::setUpBeforeClass();

		Monkey\Functions\expect( 'genesis' )
			->once()
			->with()
			->andReturn();

		require_once TOURS_ROOT_DIR . '/src/template/single-tours.php';
	}

	/**
	 * Test render_post_title_text() echoes the title when the filter event fires.
	 */
	public function test_title_is_echoed_when_filter_event_fires() {
		$tour_id = (int) 1542;
		Monkey\Functions\expect( 'get_post_field' )
			->once()
			->with( 'menu_order')
			->andReturn( '15' );
		Monkey\Functions\expect( 'get_the_ID' )
			->once()
			->with()
			->andReturn( $tour_id );
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $tour_id, 'tour_year', true )
			->andReturn( '2011' );
		Monkey\Functions\expect( 'get_the_title' )
			->once()
			->with()
			->andReturn( 'I Make All Things New' );

		$expected_html = <<<VIEW
<h2 class="entry-title tour-title" itemprop="headline">
       Tour 15 | 2011 | I Make All Things New</h2>
VIEW;

		ob_start();
		render_post_title_text( $tour_id );
		$actual_html = ob_get_clean();
		
		$this->assertSame( $expected_html, $actual_html );
	}
}

