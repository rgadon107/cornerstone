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
	 * @dataProvider addTestData
	 */
	public function test_should_render_postmeta_before_entry_content( $post_data, $post_meta, $expected_html ) {
		$post    = $this->factory->post->create_and_get( $post_data );
		$tour_id = $post->ID;

		// Add post_meta so that it can be called during test assertion.
		add_post_meta( $tour_id, 'tour_regions', $post_meta['tour_regions'] );
		add_post_meta( $tour_id, 'tour_comments', $post_meta['tour_comments'] );

		// Invoke postmeta functions from plugin.
		render_the_tour_regions( $tour_id );
		get_post_meta( $tour_id, 'tour_comments', true );
		render_tour_comments( $tour_id );

		ob_start();
		do_action( 'genesis_before_entry_content' );
		$this->assertEquals( $expected_html, ob_get_clean() );

		// Database cleanup.
		delete_post_meta( $tour_id, 'tour_regions' );
		delete_post_meta( $tour_id, 'tour_comments' );
	}

	public function addTestData() {
		return [
			'data_set' => [
				'post_data'     => [
					'post_type' => 'tours',
				],
				'post_meta'     => [
					'tour_regions'  => 'Mountain West/West Coast/Southwest',
					'tour_comments' => 'Performed at the Walt Disney Concert Hall in Los Angeles, CA',
				],
				'expected_html' => <<<POSTMETA_VIEW
<h3 class="tour-post-meta">
    <p><em class="tour-region">Region: Mountain West/West Coast/Southwest</em></p>
    <p class="tour-comments"><em>Note: Performed at Walt Disney Concert Hall in Los Angeles, CA</em></p>
</h3>
POSTMETA_VIEW
				,
			]
		];
	}
}

