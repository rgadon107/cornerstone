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
	 * @dataProvider addTestData
	 */
	public function echo_post_title_when_filter_event_fires( $post_data ) {
		$post = $this->factory->post->create_and_get( $post_data );
		$this->go_to( '?tours=i-make-all-things-new' );

		$this->assertSame( $post_data['post_title'], apply_filters( 'genesis_post_title_text', get_the_title() ) );
	}

	public function addTestData() {
		return [
			'past tour title' => [
				'post_data' => [
					'post_type'  => 'tours',
					'post_title' => 'I Make All Things New',
				]
			]
		];
	}
}

