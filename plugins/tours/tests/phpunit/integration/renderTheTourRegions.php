<?php
/**
 * Tests for render_the_tour_regions().
 *
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\render_the_tour_regions;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\render_the_tour_regions
 *
 * @group   tours
 */
class Tests_RenderTheTourRegions extends Test_Case {

	/**
	 * Cleans up the test environment after each test.
	 */
	public function tearDown() {
		parent::tearDown();

		// Clean up database.
		delete_post_meta( $this->tour_id, $this->meta );
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_echo_meta_key_values_when_postmeta_exists( $post_data, $meta ) {
		// Get the $tour_id using WordPress' factory method.
		$this->tour_id = $this->factory->post->create( $post_data );
		// Assign the $meta parameter to a property of the test class.
		$this->meta = $meta;

		// Add post_meta to the database so we can call it.
		foreach ( $meta as $key => $value ) {
			add_post_meta( $this->tour_id, $key, $value );
		}

		$region   = (string) get_post_meta( $this->tour_id, 'tour_region', true );
		$expected = esc_html( $region );

		// Run the output buffer to fire the callback and return the output.
		ob_start();
		render_the_tour_regions( $this->tour_id );
		$actual = ob_get_clean();

		$this->assertSame( $expected, $actual );
	}

	public function addTestData() {
		return [
			'postmeta key value is empty' => [
				'post_data' => [
					'post_type' => 'tours'
				],
				'post_meta' => [
					'tour_region' => ''
				]
			],
			'postmeta key value1 exists'  => [
				'post_data' => [
					'post_type' => 'tours'
				],
				'post_meta' => [
					'tour_region' => 'Midwest/West/Southwest'
				]
			],
			'postmeta key value2 exists'  => [
				'post_data' => [
					'post_type' => 'tours'
				],
				'post_meta' => [
					'tour_region' => 'Midwest/Mid-Atlantic/Southeast'
				]
			]
		];
	}
}

