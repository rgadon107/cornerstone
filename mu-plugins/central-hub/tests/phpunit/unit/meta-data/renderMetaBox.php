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

namespace spiralWebDb\centralHub\Tests\Unit\Metadata;

use Brain\Monkey;
use function spiralWebDB\Metadata\render_meta_box;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_RenderMetaBox
 *
 * @package spiralWebDb\centralHub\Tests\Unit\Metadata
 * @group   meta-data
 */
class Tests_RenderMetaBox extends Test_Case {

	/**
	 * Meta box configuration paramaters.
	 *
	 * @var array
	 */
	protected $config = [
		'custom_fields' => [
			'event-date' => '',
			'event-time' => '',
			'venue-name' => '',
		],
		'view'          => CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-events-view.php',
	];

	/**
	 * Array of meta box arguments.
	 *
	 * @var array
	 */
	protected $meta_box_args = [ 'id' => 'events' ];

	/**
	 * Nonce html.
	 *
	 * @var string
	 */
	protected $nonce_html = <<<NONCE
<input type="hidden" id="events_nonce_name" name="events_nonce_name" value="" />
NONCE;

	/**
	 * Expected meta box view html.
	 *
	 * @var string
	 */
	protected $expected_fixture_view_html    = <<<VIEW
<div class="event-date">
	<label for="event-date"><strong>Performance Date</strong></label>
	<p>
		<input id="event-date" type="date" name="events[event-date]" value="2019-08-07">
	</p>
	<span class="description">Event date description.</span>
</div>
<div class="event-time">
	<p>
		<label for="event-time"><strong>Performance Time</strong></label>
	</p>
	<p>
		<input id="event-time" type="time" name="events[event-time]" value="09:00:00">
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
		<input id="venue-name" class="large-text" type="text" name="events[venue-name]" value="Some venue" placeholder="e.g. First Presbyterian Church of St. Louis">
	</p>
	<p>
		<span class="description">Performance venue description.</span>
	</p>
</div>
VIEW;

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/meta-box.php';
	}

	/**
	 * Test render_meta_box() should assign meta box ID to the HTML field names.
	 */
	public function test_should_assign_meta_box_id_to_html_field_names() {
		// Set up the test.
		$this->meta_box_args;
		$this->config['custom_fields'];

		// Set up the mocks.
		$post     = \Mockery::mock( 'WP_Post' );
		$post->ID = 23;
		Monkey\Functions\when( 'KnowTheCode\ConfigStore\getConfig' )->justReturn( $this->config );
		Monkey\Functions\when( 'spiralWebDB\Metadata\get_custom_fields_values' )->justReturn( $custom_fields );
		Monkey\Functions\when( 'wp_nonce_field' )->justReturn();

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		render_meta_box( $post, $this->meta_box_args );
		$actual_html = ob_get_clean();

		// Test the HTML.
		$this->assertContains( 'name="events[event-date]"', $actual_html );
		$this->assertContains( 'name="events[event-time]"', $actual_html );
		$this->assertContains( 'name="events[venue-name]"', $actual_html );
	}

	/**
	 * Test render_meta_box() should render WordPress nonce HTML field.
	 */
	public function test_should_render_wp_nonce_field() {
		// Set up the test.
		$meta_box_args = [ 'id' => 'testing_nonce' ];
		$this->config['custom_fields'];
		$nonce_html = <<<NONCE
<input type="hidden" id="events_nonce_name" name="events_nonce_name" value="" />
NONCE;
		// Set up the mocks.
		$post     = \Mockery::mock( 'WP_Post' );
		$post->ID = 99;
		Monkey\Functions\when( 'KnowTheCode\ConfigStore\getConfig' )->justReturn( $this->config );
		Monkey\Functions\when( 'spiralWebDB\Metadata\get_custom_fields_values' )->justReturn( $custom_fields );

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		Monkey\Functions\expect( 'wp_nonce_field' )
			->once()
			->with( 'testing_nonce_nonce_action', 'testing_nonce_nonce_name' )
			->andReturnUsing( function () use ( $nonce_html ) {
				echo $nonce_html;
			} );
		render_meta_box( $post, $meta_box_args );
		$actual_html = ob_get_clean();

		// Test the HTML.
		$this->assertContains( $nonce_html, $actual_html );
	}

	/**
	 * Test render_meta_box() should render the custom field values.
	 */
	public function test_should_rendering_of_custom_field_values() {
		// Set up the test.
		$meta_box_args = [ 'id' => 'events' ];
		$custom_fields = [
			'event-date' => '2019-08-07',
			'event-time' => '09:36:00',
			'venue-name' => 'Some really cool venue',
		];

		// Set up the mocks.
		$post     = \Mockery::mock( 'WP_Post' );
		$post->ID = 108;
		Monkey\Functions\when( 'KnowTheCode\ConfigStore\getConfig' )->justReturn( $this->config );
		Monkey\Functions\when( 'wp_nonce_field' )->justReturn();
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_custom_fields_values' )
			->once()
			->with( 108, 'events', $this->config )
			->andReturn( $custom_fields );

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		render_meta_box( $post, $meta_box_args );
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
		$meta_box_args              = [ 'id' => 'events' ];
		$custom_fields              = [
			'event-date' => '2019-08-07',
			'event-time' => '09:00:00',
			'venue-name' => 'Some venue',
		];
		$nonce_html                 = <<<NONCE
<input type="hidden" id="events_nonce_name" name="events_nonce_name" value="" />
NONCE;
		$expected_fixture_view_html = <<<VIEW
<div class="event-date">
	<label for="event-date"><strong>Performance Date</strong></label>
	<p>
		<input id="event-date" type="date" name="events[event-date]" value="2019-08-07">
	</p>
	<span class="description">Event date description.</span>
</div>
<div class="event-time">
	<p>
		<label for="event-time"><strong>Performance Time</strong></label>
	</p>
	<p>
		<input id="event-time" type="time" name="events[event-time]" value="09:00:00">
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
		<input id="venue-name" class="large-text" type="text" name="events[venue-name]" value="Some venue" placeholder="e.g. First Presbyterian Church of St. Louis">
	</p>
	<p>
		<span class="description">Performance venue description.</span>
	</p>
</div>
VIEW;

		// Set up the mocks.
		$post     = \Mockery::mock( 'WP_Post' );
		$post->ID = 47;
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\getConfig' )
			->once()
			->with( 'meta_box.events' )
			->andReturn( $this->config );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_custom_fields_values' )
			->once()
			->with( 47, 'events', $this->config )
			->andReturn( $custom_fields );

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		Monkey\Functions\when( 'wp_nonce_field' )->justEcho( $nonce_html );
		render_meta_box( $post, $meta_box_args );
		$actual_html = ob_get_clean();

		// Test the HTML.
		$this->assertContains( $nonce_html, $actual_html );
		$this->assertContains( $expected_fixture_view_html, $actual_html );
	}
}
