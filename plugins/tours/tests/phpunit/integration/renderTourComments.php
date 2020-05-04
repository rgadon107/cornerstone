<?php
/**
 * Tests for render_tour_comments().
 *
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\render_tour_comments;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\render_tour_comments
 *
 * @group   tours
 */
class Tests_RenderTourComments extends Test_Case {

	/**
	 * Cleans up the test environment after each test.
	 */
	public function tearDown() {
		parent::tearDown();

		// Clean up database.
		delete_post_meta( $this->tour_id, 'tour_comments' );
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_echo_meta_key_values_when_postmeta_exists( $post_data, $meta ) {
		// Get the $tour_id using WordPress' factory method.
		$this->tour_id = $this->factory->post->create( $post_data );

		// Add post_meta to the database so we can call it.
		foreach ( $meta as $key => $value ) {
			add_post_meta( $this->tour_id, $key, $value );
		}

		$comments = (string) get_post_meta( $this->tour_id, 'tour_comments', true );
		$expected = esc_html( $comments );
		
		// Run the output buffer to fire the callback and return the output.
		ob_start();
		render_tour_comments( $this->tour_id );
		$actual = ob_get_clean();

		$this->assertSame( $expected, $actual );
	}

	public function addTestData() {
		return [
			'empty postmeta key value'   => [
				'post_data' => [
					'post_type' => 'tours'
				],
				'post_meta' => [
					'tour_comments' => ''
				]
			],
			'postmeta key value1 exists' => [
				'post_data' => [
					'post_type' => 'tours'
				],
				'post_meta' => [
					'tour_comments' => 'Note: Performed in Zankel Hall at Carnegie Hall, New York, NY'
				]
			],
			'postmeta key value2 exists' => [
				'post_data' => [
					'post_type' => 'tours'
				],
				'post_meta' => [
					'tour_comments' => 'Note: Performed at Alice Tully Hall, Lincoln Center, New York, NY'
				]
			]
		];
	}
}

