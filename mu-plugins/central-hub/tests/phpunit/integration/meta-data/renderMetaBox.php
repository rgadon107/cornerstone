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
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_RenderMetaBox
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_RenderMetaBox extends Test_Case {

	/**
	 * Instance of the post for each test.
	 *
	 * @var WP_Post
	 */
	protected $post;

	/**
	 * Events' meta data configuration - to be stored in the database.
	 * @var array
	 */
	protected $meta_config;

	/**
	 * Empty the store before starting these tests.
	 */
	public static function setUpBeforeClass() {
		self::empty_the_store();
	}

	/**
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		// Create and get the post.
		$this->post        = self::factory()->post->create_and_get();
		$this->meta_config = [
			'event-date' => '',
			'event-time' => '',
			'venue-name' => '',
		];

		// Store the events config into the Config Store.
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
				'view'          => CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-events-view.php',
			],
		];
		foreach ( $config_to_store as $store_key => $metabox_config ) {
			loadConfig( $store_key, $metabox_config );
		}
	}

	/**
	 * Cleans up the test environment after each test.
	 */
	public function tearDown() {
		parent::tearDown();

		self::remove_from_store( 'meta_box.events' );
	}

	/*
	 * Test render_meta_box() should assign meta box ID to the HTML field names.
	 */
	public function test_should_assign_meta_box_id_to_html_field_names() {
		// Set up the test.
		$meta_box_args = [ 'id' => 'events' ];
		$meta_box_id   = $meta_box_args['id'];
		$this->add_post_meta();

		// Get the stored custom fields config and view file.
		$config = getConfig( 'meta_box.' . $meta_box_id );

		// Get the metadata
		$custom_fields = get_custom_fields_values( $this->post->ID, $meta_box_id, $config );

		// Start the output buffer, fire the rendering function, and grab the HTML out of the buffer.
		ob_start();
		render_meta_box( $this->post, $meta_box_args );
		$actual_html = ob_get_clean();

		// Test the HTML in the rendering function to ensure that it was called.
		$this->assertContains( 'name="' . $meta_box_id . '[event-date]"', $actual_html );
		$this->assertContains( 'name="' . $meta_box_id . '[event-time]"', $actual_html );
		$this->assertContains( 'name="' . $meta_box_id . '[venue-name]"', $actual_html );
	}

	/**
	 * Test render_meta_box() should render WordPress nonce HTML field.
	 */
	public function test_should_render_wp_nonce_field() {
		// Set up the test.
		$meta_box_args = [ 'id' => 'events' ];
		$meta_box_id   = $meta_box_args['id'];
		$this->add_post_meta();

		// Get the stored custom fields config and view file.
		$config = getConfig( 'meta_box.' . $meta_box_id );

		// Get the metadata
		$custom_fields = get_custom_fields_values( $this->post->ID, $meta_box_id, $config );

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		render_meta_box( $this->post, $meta_box_args );
		$actual_html = ob_get_clean();

		$this->assertContains( '<input type="hidden" id="events_nonce_name" name="events_nonce_name" value=', $actual_html );
	}

	/**
	 * Test render_meta_box() should render the custom field values.
	 */
	public function test_should_render_the_custom_field_values() {
		// Set up the test.
		$meta_box_args     = [ 'id' => 'events' ];
		$meta_box_id       = $meta_box_args['id'];
		$this->meta_config = [
			'event-date' => '2019-08-07',
			'event-time' => '09:36:00',
			'venue-name' => 'Some really cool venue',
		];
		$this->add_post_meta();

		// Get the stored custom fields config and view file.
		$config = getConfig( 'meta_box.' . $meta_box_id );

		// Get the metadata
		$custom_fields = get_custom_fields_values( $this->post->ID, $meta_box_id, $config );

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		render_meta_box( $this->post, $meta_box_args );
		$actual_html = ob_get_clean();

		// Test the HTML.
		$this->assertContains( 'name="events[event-date]" value="2019-08-07"', $actual_html );
		$this->assertContains( 'name="events[event-time]" value="09:36:00"', $actual_html );
		$this->assertContains( 'name="events[venue-name]" value="Some really cool venue"', $actual_html );
	}

	/**
	 * Test render_meta_box() should render the meta box's HTML.
	 */
	public function test_should_render_meta_box_html() {
		// Set up the test.
		$meta_box_args     = [ 'id' => 'events' ];
		$meta_box_id       = $meta_box_args['id'];
		$this->meta_config = [
			'event-date' => '2019-08-26',
			'event-time' => '18:00:00',
			'venue-name' => 'First Presbyterian Church of St. Louis',
		];
		$this->add_post_meta();

		// Get the stored custom fields config and view file.
		$config = getConfig( 'meta_box.' . $meta_box_id );

		// Get the metadata
		$custom_fields = get_custom_fields_values( $this->post->ID, $meta_box_id, $config );

		$nonce_html                 = <<<NONCE
<input type="hidden" id="events_nonce_name" name="events_nonce_name" value=
NONCE;
		$expected_fixture_view_html = <<<VIEW
<div class="event-date">
	<label for="event-date"><strong>Performance Date</strong></label>
	<p>
		<input id="event-date" type="date" name="events[event-date]" value="2019-08-26">
	</p>
	<span class="description">Event date description.</span>
</div>
<div class="event-time">
	<p>
		<label for="event-time"><strong>Performance Time</strong></label>
	</p>
	<p>
		<input id="event-time" type="time" name="events[event-time]" value="18:00:00">
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
		render_meta_box( $this->post, $meta_box_args );
		$actual_html = ob_get_clean();

		$this->assertContains( $nonce_html, $actual_html );
		$this->assertContains( $expected_fixture_view_html, $actual_html );
	}

	/**
	 * Adds the configured meta data into database.
	 */
	private function add_post_meta() {
		foreach ( $this->meta_config as $meta_name => $value ) {
			add_post_meta( $this->post->ID, $meta_name, $value );
		}
	}
}
