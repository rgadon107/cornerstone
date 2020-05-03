<?php
/**
 *  Tests for render_postmeta_before_content()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\CornerstoneTours\Template\Tests\Unit
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours\Template;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\Template\render_postmeta_before_content;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\Template\render_postmeta_before_content
 *
 * @group tours
 * @group template
 */
class Tests_RenderPostmetaBeforeContent extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		Functions\expect( 'genesis' )->with()->andReturnNull();

		require_once TOURS_ROOT_DIR . '/src/template/single-tours.php';
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_render_postmeta_before_entry_content( $tour_id, $post_meta, $expected_html ) {
		Functions\expect( 'get_the_ID' )
			->once()
			->with()
			->andReturn( $tour_id );
		Functions\expect( 'render_the_tour_regions' )
			->once()
			->with( 'tour_id' )
			->andReturn( $post_meta['tour_regions'] );
		Functions\expect( 'get_post_meta' )
			->once()
			->with( $tour_id, 'tour_comments', true )
			->andReturn( $post_meta['tour_comments'] );
		Functions\expect( 'render_tour_comments' )
			->once()
			->with( 'tour_id' )
			->andReturn( $post_meta['tour_comments'] );

			ob_start();
			render_postmeta_before_content( $tour_id );
			$actual_html = ob_get_clean();

			$this->assertEquals( $expected_html, $actual_html );
		}

		public function addTestData() {
			return [
				'regions_post_meta' => [
					'tour_id'       => 99,
					'post_meta'     => [
						'tour_regions'  => 'Mountain West/West Coast/Southwest',
						'tour_comments' => '',
					],
					'expected_html' => <<<POSTMETA_VIEW_WITHOUT_COMMENTS
<h3 class="tour-post-meta">
    <p><em class="tour-region">Region: Mountain West/West Coast/Southwest</em></p>
</h3>
POSTMETA_VIEW_WITHOUT_COMMENTS
					,
				],
				'regions_and_comment_post_meta' => [
					'tour_id'=> 108,
					'post_meta' => [
						'tour_regions' => 'Midwest/Mid-South/Southeast',
						'tour_comments' => 'Performed at Atlanta Symphony Hall in the Woodruff Arts Center, Atlanta, GA',
					],
					'expected_html' => <<<POSTMETA_VIEW_WITH_COMMENTS
<h3 class="tour-post-meta">
    <p><em class="tour-region">Region: Midwest/Mid-South/Southeast</em></p>
    <p class="tour-comments"><em>Note: Performed at Atlanta Symphony Hall in the Woodruff Arts Center, Atlanta, GA</em></p>
</h3>
POSTMETA_VIEW_WITH_COMMENTS
					,
				]
			];
		}
}

