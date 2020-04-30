<?php
/**
 * Tests for render_post_title_text().
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
use function spiralWebDb\CornerstoneTours\Template\render_post_title_text;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\Template\render_post_title_text
 *
 * @group   tours
 * @group   template
 */
class Tests_RenderPostTitleText extends Test_Case {

	/**
	 * Prepare the test environment before each test.
	 */
	public static function setUpBeforeClass() {
		parent::setUpBeforeClass();

		Functions\expect( 'genesis' )
			->once()
			->with()
			->andReturn();

		require_once TOURS_ROOT_DIR . '/src/template/single-tours.php';
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_title_is_echoed_when_filter_event_fires( $tour_id, $title, $menu_order ) {
		Functions\expect( 'get_post_field' )
			->once()
			->with( 'menu_order' )
			->andReturn( $menu_order );
		Functions\expect( 'get_the_ID' )
			->once()
			->with()
			->andReturn( $tour_id );
		Functions\expect( 'get_post_meta' )
			->once()
			->with( $tour_id, 'tour_year', true )
			->andReturn( 2011 );
		Functions\expect( 'get_the_title' )
			->once()
			->with()
			->andReturn( $title );

		$expected_html = <<<VIEW
<h2 class="entry-title tour-title" itemprop="headline">
	Tour 15 | 2011 | I Make All Things New</h2>
VIEW;


		ob_start();
		render_post_title_text( $tour_id );
		$actual_html = ob_get_clean();

		$this->assertEquals( $expected_html, $actual_html );
	}

	public function addTestData() {
		return [
			'post_data' => [
				'tour_id'    => (int) 1542,
				'title'      => 'I Make All Things New',
				'menu_order' => (int) 15,
			]
		];
	}
}

