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

		self::empty_the_store();
	}

	/*
	* Test save_meta_boxes() should register to add_action( save_post' ) when event fires.
	*/
	public function test_function_should_register_to_action_hook_when_event_fires() {

		// `has_action()` returns the priority level of the callback registered to the event ($tag).
		$this->assertEquals( 10, has_action( 'save_post', 'spiralWebDB\Metadata\save_meta_boxes' ) );
		$this->assertTrue( has_action( 'save_post' ) );
	}

	/**
	 * Test save_meta_boxes() should not save when no meta box keys are in the Config Store or
	 *    config does not begin with `meta_box.`.
	 */
	public function test_should_not_save_when_no_meta_box_keys_are_in_store() {
		$expected = [];
		save_meta_boxes( $this->post->ID );

		$this->assertSame( $expected, get_meta_box_keys() );
	}

	/**
	 * Test save_meta_boxes() should not save when the $meta_box_key is not validated in $_POST.
	 */
	public function test_should_not_save_when_the_meta_box_key_is_not_validated_in_POST() {
		$configs = [
			'meta_box.members' => [
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
		$_POST        = [
			'post_ID'            => $this->post->ID,
			'post_status'        => 'published',
			'members_nonce_name' => '0390a99dc5',
		];
		$expected     = [ 0 => 'meta_box.members' ];
		$meta_box_key = 'members';
		save_meta_boxes( $this->post->ID );

		$this->assertSame( $expected, get_meta_box_keys() );
		$this->assertSame( $meta_box_key, get_meta_box_id( 'meta_box.members' ) );
		$this->assertFalse( is_okay_to_save_meta_box( $meta_box_key ) );
	}

	/**
	 * Test save_meta_boxes() should not save when the $meta_box_key is not validated by wp_verify_nonce().
	 */
	public function test_should_not_save_when_the_meta_box_key_is_not_validated_by_wp_verify_nonce() {
		$configs = [
			'meta_box.members' => [
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
		$_POST        = [
			'post_ID'     => $this->post->ID,
			'post_status' => 'published',
			'members'     => [
				'role'            => 'Soprano',
				'residence_city'  => 'Chicago',
				'residence_state' => 'IL',
				'tour_number'     => '3',
			],
		];
		$expected     = [ 0 => 'meta_box.members' ];
		$meta_box_key = 'members';
		save_meta_boxes( $this->post->ID );

		$this->assertSame( $expected, get_meta_box_keys() );
		$this->assertSame( $meta_box_key, get_meta_box_id( 'meta_box.members' ) );
		$this->assertFalse( is_okay_to_save_meta_box( $meta_box_key ) );
	}


	/**
	 * Test save_meta_boxes() should save when one or more valid post meta values are added.
	 */
	public function test_should_save_when_one_or_more_valid_post_meta_values_are_added() {
		$configs = [
			'meta_box.members' => [
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
		$_POST                = [
			'post_ID'              => $this->post->ID,
			'post_status'          => 'published',
			'members'              => [
				'role'            => 'Soprano',
				'residence_city'  => 'Chicago',
				'residence_state' => 'IL',
				'tour_number'     => '3',
			],
			'members_nonce_name'   => '0390a99dc5',
			'members_nonce_action' => 1,
		];
		$expected             = [ 0 => 'meta_box.members' ];
		$meta_box_key         = 'members';
		$custom_fields_config = $configs['meta_box.members']['custom_fields'];

		save_meta_boxes( $this->post->ID );
	}
}
