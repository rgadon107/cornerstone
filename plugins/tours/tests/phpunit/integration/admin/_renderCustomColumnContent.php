<?php
/**
 * Tests for _render_custom_column_content().
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
 * @covers ::\spiralWebDb\CornerstoneTours\_render_custom_column_content
 *
 * @group   tours
 * @group   admin
 */
class Tests__RenderCustomColumnContent extends Test_Case {

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_render_custom_column_content( $column_name, $data, $expected ) {
		$post = $this->factory->post->create_and_get( $data['post_data'] );
		if ( 'tour_id' === $column_name ) {
			$expected = $post->ID;
		}

		foreach ( $data['post_meta'] as $key => $value ) {
			add_post_meta( $post->ID, $key, $value );
		}

		ob_start();
		do_action( "manage_{$post->post_type}_posts_custom_column", $column_name, $post->ID );
		$this->assertEquals( $expected, ob_get_clean() );

		// Clean up database.
		foreach ( $data['post_meta'] as $key => $value ) {
			delete_post_meta( $post->ID, $key );
		}
	}

	public function addTestData() {
		return [
			[
				'column_name' => 'tour_id',
				'tour_data'   => [
					'post_data' => [
						'post_type' => 'tours',
					],
					'post_meta' => [],
				],
				'expected'    => 0, // populated automatically.
			],
			[
				'column_name' => 'tour_year',
				'tour_data'   => [
					'post_data' => [
						'post_type' => 'tours',
					],
					'post_meta' => [
						'tour_year' => 2018,
					],
				],
				'expected'    => 2018,
			],
			[
				'column_name' => 'menu_order',
				'tour_data'   => [
					'post_data' => [
						'post_type'  => 'tours',
						'menu_order' => 5,
					],
					'post_meta' => [],
				],
				'expected'    => 5,
			],
		];
	}
}

