<?php
/**
 *  Tests for render_postmeta_before_content()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\CornerstoneTours\Template\Tests\Integration
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours\Template;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\render_the_tour_regions;
use function spiralWebDb\CornerstoneTours\render_tour_comments;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\Template\render_postmeta_before_content
 *
 * @group tours
 * @group template
 */
class Tests_RenderPostmetaBeforeContent extends Test_Case {

	/**
	 * Clean up the test environment after each test.
	 */
	public function tearDown() {
		parent::tearDown();

		// Database cleanup.
		delete_post_meta( $tour_id, 'tour_regions' );
		delete_post_meta( $tour_id, 'tour_comments' );
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_render_postmeta_before_entry_content( $post_data, $post_meta, $expected_html ) {
		$tour_id = $this->factory->post->create( $post_data );

		// Add post_meta so that it can be called during test assertion.
		foreach ( $post_meta as $key => $meta ) {
			add_post_meta( $tour_id, $key, $meta );
		}

		// Invoke postmeta functions from plugin.
		render_the_tour_regions( $tour_id );
		get_post_meta( $tour_id, 'tour_comments', true );
		render_tour_comments( $tour_id );

		ob_start();
		do_action( 'genesis_before_entry_content' );
		$this->assertEquals( $expected_html, ob_get_clean() );
	}

	public function addTestData() {
		return [
			'regions_post_meta'             => [
				'post_data'     => [
					'post_type' => 'tours',
				],
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
				'post_data'     => [
					'post_type' => 'tours',
				],
				'post_meta'     => [
					'tour_regions'  => 'Midwest/Mid-South/Southeast',
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

