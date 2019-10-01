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

		// Create and get the post.
		$this->post     = self::factory()->post->create_and_get();
		$this->post->ID = 287;
	}

	/**
	 * Clean up the test environment after each test.
	 */
	public function tearDown() {
		parent::tearDown();
		$config = [];
		$_POST  = [];
	}

	/**
	 * Test save_custom_fields() should delete empty post meta keys when their value equals the config delete state.
	 */
	public function test_should_delete_empty_post_meta_keys_when_value_equals_config_delete_state() {
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
		add_post_meta( $this->post->ID, 'event-date', '' );
		add_post_meta( $this->post->ID, 'event-time', '' );
		add_post_meta( $this->post->ID, 'venue-name', '' );
		$_POST = [
			'events' => [],
		];

		save_custom_fields( $config, 'events', $this->post->ID );

		// Check that post meta keys are deleted when their value equals the config delete state.
		$this->assertSame( [], $_POST['events'] );
		$this->assertSame( '', get_post_meta( $this->post->ID, 'event-date', true ) );
		$this->assertSame( '', get_post_meta( $this->post->ID, 'event-time', true ) );
		$this->assertSame( '', get_post_meta( $this->post->ID, 'venue-name', true ) );
	}

}