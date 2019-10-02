<?php
/**
 * Tests for the function save_custom_fields().
 *
 * @package     spiralWebDb\centralHub\Tests\Integration\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use function spiralWebDB\Metadata\save_custom_fields;
use function add_post_meta;
use function get_post_meta;
use function delete_post_meta;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_SaveCustomFields
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_SaveCustomFields extends Test_Case {

	/**
	 * Instance of the post for each test.
	 *
	 * @var WP_Post
	 */
	protected $post;

	/**
	 * Prepare the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		// Create and get the post_id.
		$this->post = self::factory()->post->create();
	}

	/**
	 * Clean up the test environment after each test.
	 */
	public function tearDown() {
		parent::tearDown();
		$_POST = [];

		// Clean up.
		delete_post_meta( $this->post, 'event-date' );
		delete_post_meta( $this->post, 'event-time' );
		delete_post_meta( $this->post, 'venue-name' );
	}

	/**
	 * Test save_custom_fields() should delete post meta keys passed to empty $_POST array element when value equals
	 * config delete state.
	 */
	public function test_should_delete_post_meta_keys_passed_to_empty_POST_array_element_when_value_equals_config_delete_state() {
		// Custom fields config.
		$config = [
			'event-date' => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
			'event-time' => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
			'venue-name' => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
		];
		// Add post meta to the database.
		add_post_meta( $this->post, 'event-date', '10-01-2019' );
		add_post_meta( $this->post, 'event-time', '15:00:00' );
		add_post_meta( $this->post, 'venue-name', 'Bartlett United Methodist Church' );
		$_POST = [
			'events' => [],
		];

		save_custom_fields( $config, 'events', $this->post );

		// Check that post meta keys are deleted when their value equals the config delete state.
		$this->assertSame( [], $_POST['events'] );
		$this->assertSame( '', get_post_meta( $this->post, 'event-date', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'event-time', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'venue-name', true ) );
	}

	/**
	 * Test save_custom_fields() should delete actual post meta values set in $_POST when they equal the config delete
	 * state.
	 */
	public function test_should_delete_actual_post_meta_values_set_in_POST_when_they_equal_the_config_delete_state() {
		// Custom fields config.
		$config = [
			'event-date' => [
				'is_single'    => true,
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
			'event-time' => [
				'is_single'    => true,
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
			'venue-name' => [
				'is_single'    => true,
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
		];
		// Add post meta to the database.
		add_post_meta( $this->post, 'event-date', '10-27-2019' );
		add_post_meta( $this->post, 'event-time', '16:00:00' );
		add_post_meta( $this->post, 'venue-name', 'Holy Trinity Lutheran Church' );
		// $_POST contains the actual value for each custom field.
		$_POST = [
			'events' => [
				'event-date' => '',
				'event-time' => '',
				'venue-name' => '',
			],
		];
		// Check that post meta was added to the database.
		$this->assertSame( '10-27-2019', get_post_meta( $this->post, 'event-date', true ) );
		$this->assertSame( '16:00:00', get_post_meta( $this->post, 'event-time', true ) );
		$this->assertSame( 'Holy Trinity Lutheran Church', get_post_meta( $this->post, 'venue-name', true ) );

		save_custom_fields( $config, 'events', $this->post );

		// Check that post meta keys are deleted when their value equals the config delete state.
		$this->assertSame( '', $_POST['events']['event-date'] );
		$this->assertSame( '', $_POST['events']['event-time'] );
		$this->assertSame( '', $_POST['events']['venue-name'] );
		$this->assertSame( '', get_post_meta( $this->post, 'event-date', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'event-time', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'venue-name', true ) );
	}

	/**
	 * Test save_custom_fields() saves the sanitized current post meta from the custom field into the database.
	 */
	public function test_should_save_the_sanitized_current_post_meta_from_the_custom_field_into_the_database() {
		// Custom fields config.
		$config = [
			'event-date' => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
			'event-time' => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
			'venue-name' => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
		];
		// $_POST contains the actual value for each custom field.
		$_POST = [
			'events' => [
				'event-date' => '09-27-2019',
				'event-time' => '19:30:00',
				'venue-name' => 'First Presbyterian Church of St. Louis',
			],
		];

		save_custom_fields( $config, 'events', $this->post );

		$this->assertSame( '09-27-2019', get_post_meta( $this->post, 'event-date', true ) );
		$this->assertSame( '19:30:00', get_post_meta( $this->post, 'event-time', true ) );
		$this->assertSame( 'First Presbyterian Church of St. Louis', get_post_meta( $this->post, 'venue-name', true ) );
	}
}

