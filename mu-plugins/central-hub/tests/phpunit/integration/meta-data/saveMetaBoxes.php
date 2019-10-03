<?php
/**
 * Tests for the function save_meta_boxes().
 *
 * @package     spiralWebDb\centralHub\Tests\Integration\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use function KnowTheCode\ConfigStore\loadConfig;
use function spiralWebDB\Metadata\save_meta_boxes;
use function wp_create_nonce;
use function add_post_meta;
use function get_post_meta;
use function delete_post_meta;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_SaveMetaBoxes
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_SaveMetaBoxes extends Test_Case {

	/**
	 * Instance of the post object for each test.
	 *
	 * @var WP_Post
	 */
	protected $post;

	/**
	 * Empty the store before starting these tests.
	 */
	public static function setUpBeforeClass() {
		self::empty_the_store();
	}

	/**
	 * Set up each test.
	 */
	public function setUp() {
		parent::setUp();

		// Create and get the post_id via the factory method.
		$this->post = self::factory()->post->create();
	}

	/**
	 * Cleans up the test environment after each test.
	 */
	public function tearDown() {
		parent::tearDown();
		// Clean up.
		self::empty_the_store();
		$_POST = [];
		delete_post_meta( $this->post, 'role' );
		delete_post_meta( $this->post, 'residence_city' );
		delete_post_meta( $this->post, 'residence_state' );
		delete_post_meta( $this->post, 'tour_number' );
	}

	/*
	* Test save_meta_boxes() should register to add_action( save_post' ) when event fires.
	*/
	public function test_function_should_register_to_action_hook_when_event_fires() {
		$this->assertTrue( has_action( 'save_post' ) );
		// `has_action()` returns the priority level of the callback registered to the event ($tag).
		$this->assertEquals( 10, has_action( 'save_post', 'spiralWebDB\Metadata\save_meta_boxes' ) );
	}

	/**
	 * Test save_meta_boxes() should not save when custom fields config (config store) and
	 *    post meta values in $_POST are empty.
	 */
	public function test_should_not_save_when_custom_fields_config_and_post_meta_in_POST_are_empty() {
		// By default, $config is an empty array when the config store is empty.
		// Add post meta to the database.
		add_post_meta( $this->post, 'role', 'Bass/Baritone' );
		add_post_meta( $this->post, 'residence_city', 'Houston' );
		add_post_meta( $this->post, 'residence_state', 'TX' );
		add_post_meta( $this->post, 'tour_number', '1' );
		$_POST = [
			'post_ID'            => $this->post,
			'post_status'        => 'publish',
			'members'            => [
				'role'            => '',
				'residence_city'  => '',
				'residence_state' => '',
				'tour_number'     => '',
			],
			'members_nonce_name' => wp_create_nonce( 'members_nonce_action' ),
		];
		$this->assertSame( 'Bass/Baritone', get_post_meta( $this->post, 'role', true ) );
		$this->assertSame( 'Houston', get_post_meta( $this->post, 'residence_city', true ) );
		$this->assertSame( 'TX', get_post_meta( $this->post, 'residence_state', true ) );
		$this->assertSame( '1', get_post_meta( $this->post, 'tour_number', true ) );

		save_meta_boxes( $this->post );

		$this->assertSame( 'Bass/Baritone', get_post_meta( $this->post, 'role', true ) );
		$this->assertSame( 'Houston', get_post_meta( $this->post, 'residence_city', true ) );
		$this->assertSame( 'TX', get_post_meta( $this->post, 'residence_state', true ) );
		$this->assertSame( '1', get_post_meta( $this->post, 'tour_number', true ) );
	}

	/**
	 * Test save_meta_boxes() should not save when the store_key does not start with `meta_box.`.
	 */
	public function test_should_not_save_when_store_key_does_not_start_with_meta_box() {
		$configs = [
			'notametabox.members' => [
				'custom_fields' => [
					'role'            => 'Soprano',
					'residence_city'  => 'Chicago',
					'residence_state' => 'IL',
					'tour_number'     => '3',
				],
			],
		];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}
		$_POST = [
			'post_ID'            => $this->post,
			'post_status'        => 'publish',
			'members'            => [
				'role'            => '',
				'residence_city'  => '',
				'residence_state' => '',
				'tour_number'     => '',
			],
			'members_nonce_name' => wp_create_nonce( 'members_nonce_action' ),
		];
		// Before function call, check that database is empty of post meta for this post.
		$this->assertSame( '', get_post_meta( $this->post, 'role', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'residence_city', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'residence_state', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'tour_number', true ) );

		save_meta_boxes( $this->post );

		// After function call, check that database was not updated with custom field data from config store.
		$this->assertSame( '', get_post_meta( $this->post, 'role', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'residence_city', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'residence_state', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'tour_number', true ) );

		// Add post meta to the database.
		add_post_meta( $this->post, 'role', 'Tenor Trombone' );
		add_post_meta( $this->post, 'residence_city', 'Philadelphia' );
		add_post_meta( $this->post, 'residence_state', 'PA' );
		add_post_meta( $this->post, 'tour_number', '2' );
		// Before function call, check that post meta was added to database.
		$this->assertSame( 'Tenor Trombone', get_post_meta( $this->post, 'role', true ) );
		$this->assertSame( 'Philadelphia', get_post_meta( $this->post, 'residence_city', true ) );
		$this->assertSame( 'PA', get_post_meta( $this->post, 'residence_state', true ) );
		$this->assertSame( '2', get_post_meta( $this->post, 'tour_number', true ) );

		save_meta_boxes( $this->post );

		// Check that database was not updated with custom field data from config store.
		$this->assertSame( 'Tenor Trombone', get_post_meta( $this->post, 'role', true ) );
		$this->assertSame( 'Philadelphia', get_post_meta( $this->post, 'residence_city', true ) );
		$this->assertSame( 'PA', get_post_meta( $this->post, 'residence_state', true ) );
		$this->assertSame( '2', get_post_meta( $this->post, 'tour_number', true ) );
	}

	/**
	 * Test save_meta_boxes() should delete post meta keys passed to empty $_POST array element when value equals
	 * config delete state.
	 */
	public function test_should_delete_post_meta_keys_passed_to_empty_POST_array_element_when_value_equals_config_delete_state() {
		// Custom fields config.
		$configs = [
			'meta_box.members' => [
				'custom_fields' => [
					'role'            => [
						'is_single'    => true,
						'default'      => '',
						'delete_state' => '',
						'sanitize'     => 'sanitize_text_field',
					],
					'residence_city'  => [
						'is_single'    => true,
						'default'      => '',
						'delete_state' => '',
						'sanitize'     => 'sanitize_text_field',
					],
					'residence_state' => [
						'is_single'    => true,
						'default'      => '',
						'delete_state' => '',
						'sanitize'     => 'sanitize_text_field',
					],
					'tour_number'     => [
						'is_single'    => true,
						'default'      => '',
						'delete_state' => '',
						'sanitize'     => 'sanitize_text_field',
					],
				],
			],
		];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}
		// Add post meta to the database.
		add_post_meta( $this->post, 'role', 'Bass/Baritone' );
		add_post_meta( $this->post, 'residence_city', 'Houston' );
		add_post_meta( $this->post, 'residence_state', 'TX' );
		add_post_meta( $this->post, 'tour_number', '1' );
		$_POST = [
			'post_ID'            => $this->post,
			'post_status'        => 'publish',
			'members'            => [],
			'members_nonce_name' => wp_create_nonce( 'members_nonce_action' ),
		];
		// Before calling the function, check that post meta was added to the database.
		$this->assertSame( 'Bass/Baritone', get_post_meta( $this->post, 'role', true ) );
		$this->assertSame( 'Houston', get_post_meta( $this->post, 'residence_city', true ) );
		$this->assertSame( 'TX', get_post_meta( $this->post, 'residence_state', true ) );
		$this->assertSame( '1', get_post_meta( $this->post, 'tour_number', true ) );

		save_meta_boxes( $this->post );

		// After function call, check that post meta keys are deleted from the database. 
		$this->assertSame( [], $_POST['members'] );
		$this->assertSame( '', get_post_meta( $this->post, 'role', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'residence_city', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'residence_state', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'tour_number', true ) );
	}

	/**
	 * Test save_meta_boxes() should delete actual post meta values set in $_POST when they equal the config delete
	 * state.
	 */
	public function test_should_delete_actual_post_meta_values_set_in_POST_when_they_equal_the_config_delete_state() {
		// Custom fields config.
		$configs = [
			'meta_box.members' => [
				'custom_fields' => [
					'role'            => [
						'is_single'    => true,
						'delete_state' => '',
						'sanitize'     => 'sanitize_text_field',
					],
					'residence_city'  => [
						'is_single'    => true,
						'delete_state' => '',
						'sanitize'     => 'sanitize_text_field',
					],
					'residence_state' => [
						'is_single'    => true,
						'delete_state' => '',
						'sanitize'     => 'sanitize_text_field',
					],
					'tour_number'     => [
						'is_single'    => true,
						'delete_state' => '',
						'sanitize'     => 'sanitize_text_field',
					],
				],
			],
		];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}
		// Add post meta to the database.
		add_post_meta( $this->post, 'role', 'Tenor Trombone' );
		add_post_meta( $this->post, 'residence_city', 'Philadelphia' );
		add_post_meta( $this->post, 'residence_state', 'PA' );
		add_post_meta( $this->post, 'tour_number', '2' );
		// $_POST contains the actual value for each custom field.
		$_POST = [
			'post_ID'            => $this->post,
			'post_status'        => 'publish',
			'members'            => [
				'role'            => '',
				'residence_city'  => '',
				'residence_state' => '',
				'tour_number'     => '',
			],
			'members_nonce_name' => wp_create_nonce( 'members_nonce_action' ),
		];
		// Before calling the function, check that post meta was added to the database.
		$this->assertSame( 'Tenor Trombone', get_post_meta( $this->post, 'role', true ) );
		$this->assertSame( 'Philadelphia', get_post_meta( $this->post, 'residence_city', true ) );
		$this->assertSame( 'PA', get_post_meta( $this->post, 'residence_state', true ) );
		$this->assertSame( '2', get_post_meta( $this->post, 'tour_number', true ) );

		save_meta_boxes( $this->post );

		// After function call, check that post meta keys are deleted from the database.
		$this->assertSame( '', $_POST['members']['role'] );
		$this->assertSame( '', $_POST['members']['residence_city'] );
		$this->assertSame( '', $_POST['members']['residence_state'] );
		$this->assertSame( '', $_POST['members']['tour_number'] );
		$this->assertSame( '', get_post_meta( $this->post, 'role', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'residence_city', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'residence_state', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'tour_number', true ) );
	}

	/**
	 * Test save_meta_boxes() should save the sanitized current post meta from the custom field into the database.
	 */
	public function test_should_save_the_sanitized_current_post_meta_from_the_custom_fields_into_the_database() {
		$configs = [
			'meta_box.members' => [
				'custom_fields' => [
					'role'            => [
						'is_single'    => true,
						'default'      => '',
						'delete_state' => '',
						'sanitize'     => 'sanitize_text_field',
					],
					'residence_city'  => [
						'is_single'    => true,
						'default'      => '',
						'delete_state' => '',
						'sanitize'     => 'sanitize_text_field',
					],
					'residence_state' => [
						'is_single'    => true,
						'default'      => '',
						'delete_state' => '',
						'sanitize'     => 'sanitize_text_field',
					],
					'tour_number'     => [
						'is_single'    => true,
						'default'      => '',
						'delete_state' => '',
						'sanitize'     => 'sanitize_text_field',
					],
				],
			],
		];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}
		// $_POST contains the actual value for each custom field.
		$_POST = [
			'post_ID'            => $this->post,
			'post_status'        => 'publish',
			'members'            => [
				'role'            => 'Soprano',
				'residence_city'  => 'Chicago',
				'residence_state' => 'IL',
				'tour_number'     => '3',
			],
			'members_nonce_name' => wp_create_nonce( 'members_nonce_action' ),
		];
		// Before calling the function, check that post meta is not in the database.
		$this->assertSame( '', get_post_meta( $this->post, 'role', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'residence_city', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'residence_state', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'tour_number', true ) );

		save_meta_boxes( $this->post );

		// After function call, check that database was updated with post meta.
		$this->assertSame( 'Soprano', get_post_meta( $this->post, 'role', true ) );
		$this->assertSame( 'Chicago', get_post_meta( $this->post, 'residence_city', true ) );
		$this->assertSame( 'IL', get_post_meta( $this->post, 'residence_state', true ) );
		$this->assertSame( '3', get_post_meta( $this->post, 'tour_number', true ) );
	}
}
