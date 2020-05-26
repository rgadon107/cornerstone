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
	public function setUp() {
		parent::setUp();

		Functions\expect( 'genesis' )->andReturnNull();

		require_once TOURS_ROOT_DIR . '/src/template/single-tours.php';
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_title_is_echoed_when_filter_event_fires( $post_data, $meta, $expected ) {
		Functions\expect( 'get_post_field' )
			->once()
			->with( 'menu_order' )
			->andReturn( $post_data['menu_order'] );
		Functions\expect( 'get_the_ID' )
			->once()
			->andReturn( $post_data['tour_id'] );
		Functions\expect( 'get_post_meta' )
			->once()
			->with( $post_data['tour_id'], 'tour_year', true )
			->andReturn( $meta['tour_year'] );
		Functions\expect( 'get_the_title' )
			->once()
			->andReturn( $post_data['title'] );

		ob_start();
		render_post_title_text( $post_data['tour_id'] );
		$actual = ob_get_clean();

		$this->assertEquals( $expected, $actual );
	}

	public function addTestData() {
		return [
			'add post data' => [
				'post_data'     => [
					'tour_id'    => (int) 1542,
					'title'      => 'I Make All Things New',
					'menu_order' => (int) 15,
				],
				'post_meta'     => [
					'tour_year' => (int) 2011
				],
				'expected_view' => <<<PAST_TOUR_TITLE_VIEW
<h2 class="entry-title tour-title" itemprop="headline">
	Tour 15 | 2011 | I Make All Things New</h2>
PAST_TOUR_TITLE_VIEW
				,
			]
		];
	}
}

