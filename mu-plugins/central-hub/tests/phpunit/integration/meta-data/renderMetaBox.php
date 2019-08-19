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
		// Define the $meta_box_args argument to get the meta box ID.
		$meta_box_args = [ 'id' => 'events' ];
		$meta_box_id   = $meta_box_args['id'];

		// Create and get the post object via the factory method.
		$post     = self::factory()->post->create_and_get();
		$post->ID = 23;

		// Initialize the $config_to_store
		$config_to_store = [
			'meta_box.events' => [
				'custom_fields' => [
					'event-date' => [
						'is_single' => true,
						'default'   => '',
					],
					'event-time' => [
						'is_single' => true,
						'default'   => '',
					],
					'venue-name' => [
						'is_single' => true,
						'default'   => '',
					],
				],
				'view'          => CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-events-view-accepts-metabox-key-name-only.php',
			],
		];

		// Load a config into _the_store to get the custom fields and view file.
		foreach ( $config_to_store as $store_key => $metabox_config ) {
			loadConfig( $store_key, $metabox_config );
		}

		// Get the stored custom fields config and view file.
		$config = getConfig( 'meta_box.' . $meta_box_id );

		/**
		 *  Load the nonce field for the meta box custom fields using the meta box ID.
		 *  Set $echo = false to return the `wp_referer_field` to the calling function.
		 */
		wp_nonce_field( $meta_box_id . '_nonce_action', $meta_box_id . '_nonce_name', $referer = true, $echo = false );

		// Get the metadata
		$custom_fields = get_custom_fields_values( $post->ID, $meta_box_id, $config );

		// Start the output buffer, fire the rendering function, and grab the HTML out of the buffer.
		ob_start();
		render_meta_box( $post, $meta_box_args );
		$actual_html = ob_get_clean();

		// Test the HTML in the rendering function to ensure that it was called.
		$this->assertContains( 'name="' . $meta_box_id . '[event-date]"', $actual_html );
		$this->assertContains( 'name="' . $meta_box_id . '[event-time]"', $actual_html );
		$this->assertContains( 'name="' . $meta_box_id . '[venue-name]"', $actual_html );

		// Clean up.
		self::remove_from_store( 'meta_box.events' );
	}

	/**
	 * Test render_meta_box() should render WordPress nonce HTML field.
	 */
	public function test_should_render_wp_nonce_field() {
		// Define the $meta_box_args argument to get the meta box ID.
		$meta_box_args = [ 'id' => 'testing_nonce' ];
		$meta_box_id   = $meta_box_args['id'];

		// Create and get the post object via the factory method.
		$post     = self::factory()->post->create_and_get();
		$post->ID = 99;

		// Initialize the $config_to_store.
		$config_to_store = [
			'meta_box.testing_nonce' => [
				'custom_fields' => [
					'event-date' => [
						'is_single' => true,
						'default'   => '',
					],
					'event-time' => [
						'is_single' => true,
						'default'   => '',
					],
					'venue-name' => [
						'is_single' => true,
						'default'   => '',
					],
				],
				'view'          => CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-events-view-accepts-metabox-key-name-only.php',
			],
		];

		// Load a config into _the_store to get the custom fields and view file.
		foreach ( $config_to_store as $store_key => $metabox_config ) {
			loadConfig( $store_key, $metabox_config );
		}

		// Get the stored custom fields config and view file.
		$config = getConfig( 'meta_box.' . $meta_box_id );

		/**
		 *  Load the nonce field for the meta box custom fields using the meta box ID.
		 *  Set $echo = false to return the hidden `wp_referer_field` to the calling function.
		 */
		wp_nonce_field( $meta_box_id . '_nonce_action', $meta_box_id . '_nonce_name', $referer = true, $echo = false );

		// Get the metadata
		$custom_fields = get_custom_fields_values( $post->ID, $meta_box_id, $config );

		$nonce_html = <<<NONCE
<input type="hidden" id="testing_nonce_nonce_name" name="testing_nonce_nonce_name" value=
NONCE;

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		render_meta_box( $post, $meta_box_args );
		$actual_html = ob_get_clean();

		$this->assertContains( $nonce_html, $actual_html );

		// Clean up.
		self::remove_from_store( 'meta_box.testing_nonce' );
	}

	/**
	 * Test render_meta_box() should render the custom field values.
	 */
	public function test_should_render_the_custom_field_values() {
		// Define the $meta_box_args argument to get the meta box ID.
		$meta_box_args = [ 'id' => 'events' ];
		$meta_box_id   = $meta_box_args['id'];

		// Create and get the post object via the factory method.
		$post     = self::factory()->post->create_and_get();
		$post->ID = 108;

		// Initialize the $config_to_store
		$config_to_store = [
			'meta_box.events' => [
				'custom_fields' => [
					'event-date' => [
						'is_single' => true,
						'default'   => '2019-08-07',
					],
					'event-time' => [
						'is_single' => true,
						'default'   => '09:36:00',
					],
					'venue-name' => [
						'is_single' => true,
						'default'   => 'Some really cool venue',
					],
				],
				'view'            => CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-events-view-accepts-metabox-value-only.php',
			],
		];

		// Load a config into _the_store to get the custom fields and view file.
		foreach ( $config_to_store as $store_key => $metabox_config ) {
			loadConfig( $store_key, $metabox_config );
		}

		// Get the stored custom fields config and view file.
		$config = getConfig( 'meta_box.' . $meta_box_id );

		/**
		 *  Load the nonce field for the meta box custom fields using the meta box ID.
		 *  Set $echo = false to return the hidden `wp_referer_field` to the calling function.
		 */
		wp_nonce_field( $meta_box_id . '_nonce_action', $meta_box_id . '_nonce_name', $referer = true, $echo = false );

		// Get the metadata
		$custom_fields = get_custom_fields_values( $post->ID, $meta_box_id, $config );

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		render_meta_box( $post, $meta_box_args );
		$actual_html = ob_get_clean();

		// Test the HTML.
		$this->assertContains( "name=\"events[event-date]\" value=\"2019-08-07\"", $actual_html );
		$this->assertContains( "name=\"events[event-time]\" value=\"09:36:00\"", $actual_html );
		$this->assertContains( "name=\"events[venue-name]\" value=\"Some really cool venue\"", $actual_html );

		// Clean up.
		self::remove_from_store( 'meta_box.events' );
	}

	/**
	 * Test render_meta_box() should render the meta box's HTML.
	 */
	public function test_should_render_meta_box_html() {
		// Define the $meta_box_args argument to get the meta box ID.
		$meta_box_args = [ 'id' => 'events' ];
		$meta_box_id   = $meta_box_args['id'];

		// Create and get the post object via the factory method.
		$post     = self::factory()->post->create_and_get();
		$post->ID = 241;

		// Initialize the $config_to_store
		$config_to_store = [
			'meta_box.events' => [
				'custom_fields' => [
					'event-date' => [
						'is_single' => true,
						'default'   => '2019-08-18',
					],
					'event-time' => [
						'is_single' => true,
						'default'   => '19:00:00',
					],
					'venue-name' => [
						'is_single' => true,
						'default'   => 'First Presbyterian Church of St. Louis',
					],
				],
				'view'            => CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-events-view-accepts-metabox-key-value-inputs.php',
			],
		];

		// Load a config into _the_store to get the custom fields and view file.
		foreach ( $config_to_store as $store_key => $metabox_config ) {
			loadConfig( $store_key, $metabox_config );
		}

		// Get the stored custom fields config and view file.
		$config = getConfig( 'meta_box.' . $meta_box_id );

		/**
		 *  Load the nonce field for the meta box custom fields using the meta box ID.
		 *  Set $echo = false to return the hidden `wp_referer_field` to the calling function.
		 */
		wp_nonce_field( $meta_box_id . '_nonce_action', $meta_box_id . '_nonce_name', $referer = true, $echo = false );

		// Get the metadata
		$custom_fields = get_custom_fields_values( $post->ID, $meta_box_id, $config );

		$nonce_html = <<<NONCE
<input type="hidden" id="events_nonce_name" name="events_nonce_name" value=
NONCE;
		$expected_fixture_view_html = <<<VIEW
<div class="event-date">
	<label for="event-date"><strong>Performance Date</strong></label>
	<p>
		<input id="event-date" type="date" name="events[event-date]" value="2019-08-18">
	</p>
	<span class="description">Event date description.</span>
</div>
<div class="event-time">
	<p>
		<label for="event-time"><strong>Performance Time</strong></label>
	</p>
	<p>
		<input id="event-time" type="time" name="events[event-time]" value="19:00:00">
	</p>
	<p>
		<span class="description">Event time description.</span>
	</p>
</div>
<hr>
<div class="performance-venue">
	<p>
		<label for="performance-venue"><strong>Performance Venue</strong></label>
	</p>
	<label for="venue-name">Name</label>
	<p>
		<input id="venue-name" class="large-text" type="text" name="events[venue-name]" value="First Presbyterian Church of St. Louis" placeholder="e.g. First Presbyterian Church of St. Louis">
	</p>
	<p>
		<span class="description">Performance venue description.</span>
	</p>
</div>
VIEW;

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		render_meta_box( $post, $meta_box_args );
		$actual_html = ob_get_clean();

		$this->assertContains( $nonce_html, $actual_html );
		$this->assertContains( $expected_fixture_view_html, $actual_html );

		// Clean up.
		self::remove_from_store( 'meta_box.events' );
	}
}

