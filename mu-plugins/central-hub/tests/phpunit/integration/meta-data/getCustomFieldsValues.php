<?php
/**
 * Tests for the function get_custom_fields_values().
 *
 * @package     spiralWebDb\centralHub\Tests\Integration\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use function get_post_meta;
use function add_post_meta;
use function delete_post_meta;
use function spiralWebDB\Metadata\get_custom_fields_values;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_GetCustomFieldsValues
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_GetCustomFieldsValues extends Test_Case {

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
	 * Test get_custom_fields_values() should return an empty array when custom fields config is empty.
	 */
	public function test_should_return_empty_array_when_custom_fields_config_is_empty() {
		$config = [
			'custom_fields' => [],
		];

		$this->assertSame( [], get_custom_fields_values( $this->post, 'events', $config ) );
	}

	/**
	 * Test get_custom_fields_values() should return post meta from database when meta key exists in custom fields
	 * config.
	 */
	public function test_should_return_post_meta_from_database_when_meta_key_exists_in_custom_fields_config() {
		$config = [
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
		];

		// Add post meta to the database so we have something to call.
		add_post_meta( $this->post, 'event-date', '10-04-2019' );
		add_post_meta( $this->post, 'event-time', '19:30:00' );
		add_post_meta( $this->post, 'venue-name', 'Carnegie Hall' );

		// Check database that post meta was added.
		$this->assertSame( '10-04-2019', get_post_meta( $this->post, 'event-date', true ) );
		$this->assertSame( '19:30:00', get_post_meta( $this->post, 'event-time', true ) );
		$this->assertSame( 'Carnegie Hall', get_post_meta( $this->post, 'venue-name', true ) );

		$expected_custom_fields = [
			'event-date' => '10-04-2019',
			'event-time' => '19:30:00',
			'venue-name' => 'Carnegie Hall',
		];

		$this->assertSame( $expected_custom_fields, get_custom_fields_values( $this->post, 'events', $config ) );

		// Clean up database.
		delete_post_meta( $this->post, 'event-date' );
		delete_post_meta( $this->post, 'event-time' );
		delete_post_meta( $this->post, 'venue-name' );
	}

	/**
	 * Test get_custom_fields_values() should return custom fields default values when post meta is not in database.
	 */
	public function test_should_return_custom_fields_default_values_when_post_meta_is_not_in_database() {
		$config = [
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
		];

		// Check that database does not contain post meta.
		$this->assertSame( '', get_post_meta( $this->post, 'event-date', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'event-time', true ) );
		$this->assertSame( '', get_post_meta( $this->post, 'venue-name', true ) );

		$expected_custom_fields = [
			'event-date' => '',
			'event-time' => '',
			'venue-name' => '',
		];

		$this->assertSame( $expected_custom_fields, get_custom_fields_values( $this->post, 'events', $config ) );
	}

	/**
	 * Test get_custom_fields_values() should return true when filter tag has registered callback.
	 */
	public function test_should_return_true_when_filter_tag_has_registered_callback() {
		// Register anonymous callback to filter $tag with priority of 20.
		add_filter( 'filter_meta_box_custom_fields', __FUNCTION__, 20 );

		$this->assertTrue( has_filter( 'filter_meta_box_custom_fields' ) );
		$this->assertEquals( 20, has_filter( 'filter_meta_box_custom_fields', __FUNCTION__ ) );
	}
}

