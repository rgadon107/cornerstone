<?php
/**
 * Tests for render_post_title_text().
 *
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\Template\render_post_title_text
 *
 * @group   tours
 * @group   template
 */
class Tests_RenderPostTitleText extends Test_Case {

	/**
	 * Clean up the test environment after each test.
	 */
	public function tearDown() {
		parent::tearDown();

		// Database cleanup.
		delete_post_meta( $tours, 'tour_year' );
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_echo_post_title_when_filter_event_fires( $post_data, $meta, $expected ) {
		$tours = $this->factory->post->create( $post_data );

		foreach ( $meta as $key => $value ) {
			add_post_meta( $tours, $key, true );
		}
		get_post_meta( $tours, 'tour_year', true );

		$this->go_to( '?tours=i-make-all-things-new' );

		ob_start();
		apply_filters( 'genesis_post_title_text', get_the_title() );
		$actual = ob_get_clean();

		$this->assertEquals( $expected, $actual );
	}

	public function addTestData() {
		return [
			'add post data' => [
				'post_data'     => [
					'post_type'  => 'tours',
					'post_title' => 'I Make All Things New',
					'menu_order' => 5
				],
				'post_meta'     => [
					'tour_year' => 2011,
				],
				'expected_view' => <<<PAST_TOUR_TITLE_VIEW
<h2 class="entry-title tour-title" itemprop="headline">Tour 5 | 2011 | I Make All Things New</h2>
PAST_TOUR_TITLE_VIEW
				,
			]
		];
	}
}


