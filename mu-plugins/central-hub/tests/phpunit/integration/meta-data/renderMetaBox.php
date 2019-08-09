<?php
/**
 * Tests for the function render_meta_box().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use \WP_Post;
use function spiralWebDB\Metadata\render_meta_box;
use function spiralWebDB\Metadata\get_custom_fields_values;
use function KnowTheCode\ConfigStore\loadConfig;
use function KnowTheCode\ConfigStore\getConfig;
use function \wp_nonce_field;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_RenderMetaBox
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_RenderMetaBox extends Test_Case {

	/**
	 * Empty the store before starting these tests.
	 */
	public static function setUpBeforeClass() {
		self::empty_the_store();
	}

	/*
	 * Test render_meta_box() should assign meta box ID to the HTML field names.
	 */
	public function test_should_assign_meta_box_id_to_html_field_names() {
		// Instantiate the WP_Post object and call the ID.
		$post     = new \WP_Post();
		$post->ID = 23;

		// Define the $meta_box_args argument to get the meta box ID.
		$meta_box_args = [ 'id' => 'events' ];

		// Initialize the $config_to_store
		$config_to_store = [
			'meta_box.events' => [
				'custom_fields' => [
					'event_date' => [ 'is_single' => true, 'default' => '' ],
					'event_time' => [ 'is_single' => true, 'default' => '' ],
					'venue_name' => [ 'is_single' => true, 'default' => '' ],
				],
				'view'          => CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-events-view.php',
			],
		];

		// Load a config into _the_store to get the custom fields and view file.
		foreach ( $config_to_store as $store_key => $metabox_config ) {
			loadConfig( $store_key, $metabox_config );
		}

		// Get the stored custom fields config and view file.
		$config = getConfig( 'meta_box.' . $meta_box_args['id'] );

		// Load the nonce field for the meta box custom fields using the meta box ID.
		wp_nonce_field( $meta_box_args['id'] . '_nonce_action', $meta_box_args['id'] . '_nonce_name' );

		// Get the metadata
		$custom_fields = get_custom_fields_values( $post->ID, $meta_box_args['id'], $config );

		// Start the output buffer, fire the rendering function, and grab the HTML out of the buffer.
		ob_start();
		render_meta_box( $post, $meta_box_args );
		$actual_html = ob_get_clean();

		// Test the HTML in the rendering function to ensure that it was called.
		$this->assertContains( 'name="events[event-date]"', $actual_html );
		$this->assertContains( 'name="events[event-time]"', $actual_html );
		$this->assertContains( 'name="events[venue-name]"', $actual_html );
	}
}