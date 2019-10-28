<?php
/**
 * Tests for the function get_custom_fields_values().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\Metadata;

use Mockery as m;
use Brain\Monkey;
use function spiralWebDB\Metadata\get_custom_fields_values;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_GetCustomFieldsValues
 *
 * @package spiralWebDb\centralHub\Tests\Unit\Metadata
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
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/helpers.php';

		$this->post     = m::mock( 'WP_Post' );
		$this->post->ID = 99;
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
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $this->post->ID, 'event-date', $config['custom_fields']['event-date']['is_single'] )
			->andReturn( '10-26-2019' );
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $this->post->ID, 'event-time', $config['custom_fields']['event-time']['is_single'] )
			->andReturn( '19:30:00' );
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $this->post->ID, 'venue-name', $config['custom_fields']['venue-name']['is_single'] )
			->andReturn( 'Carnegie Hall' );

		$expected_custom_fields = [
			'event-date' => '10-26-2019',
			'event-time' => '19:30:00',
			'venue-name' => 'Carnegie Hall',
		];

		$this->assertSame( $expected_custom_fields, get_custom_fields_values( $this->post->ID, 'events', $config ) );
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

		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->andReturn( $config['custom_fields']['event-date']['default'] );
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->andReturn( $config['custom_fields']['event-time']['default'] );
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->andReturn( $config['custom_fields']['venue-name']['default'] );

		$expected_custom_fields = [
			'event-date' => '',
			'event-time' => '',
			'venue-name' => '',
		];

		$this->assertSame( $expected_custom_fields, get_custom_fields_values( $this->post->ID, 'events', $config ) );
	}
//
//	/**
//	 * Test get_custom_fields_values() should return filtered custom field values.
//	 */
//	public function test_should_return_filtered_custom_field_values() {
//		// Add post meta to the database so we have something to call.
//		add_post_meta( $this->post, 'event-date', '10-12-2019' );
//		add_post_meta( $this->post, 'event-time', '19:30:00' );
//		add_post_meta( $this->post, 'venue-name', 'Carnegie Hall' );
//
//		// Check database that post meta was added.
//		$this->assertSame( '10-12-2019', get_post_meta( $this->post, 'event-date', true ) );
//		$this->assertSame( '19:30:00', get_post_meta( $this->post, 'event-time', true ) );
//		$this->assertSame( 'Carnegie Hall', get_post_meta( $this->post, 'venue-name', true ) );
//
//		// Register custom callback to filter $tag with priority of 20 and 3 available arguments.
//		add_filter( 'filter_meta_box_custom_fields', [ $this, 'filter_custom_field_values' ], 20, 3 );
//		$this->assertTrue( has_filter( 'filter_meta_box_custom_fields' ) );
//		$this->assertEquals( 20, has_filter( 'filter_meta_box_custom_fields', [ $this, 'filter_custom_field_values' ] ) );
//
//		$updated_custom_fields = [
//			'event-date' => '10-19-2019',
//			'event-time' => '15:00:00',
//			'venue-name' => 'The Fabulous Fox Theater',
//		];
//		$this->assertSame( $updated_custom_fields, get_custom_fields_values( $this->post, 'events', $this->config ) );
//
//		// Clean up.
//		remove_all_filters( 'filter_meta_box_custom_fields', 20 );
//		delete_post_meta( $this->post, 'event-date' );
//		delete_post_meta( $this->post, 'event-time' );
//		delete_post_meta( $this->post, 'venue-name' );
//	}
//
//	/*
//	 * Filter the custom field values with a custom callback.
//	 *
//	 * @param array  $custom_fields Array of custom fields values
//	 * @param string $meta_box_id   Meta box's key (ID) - used to identify this meta box
//	 * @param int    $post_id       Post's ID
//	 * @return array Updated custom fields values.
//	 */
//	public function filter_custom_field_values( $custom_fields, $meta_box_id, $post_id ) {
//		$args          = func_get_args();
//		$expected_args = [
//			[
//				'event-date' => '10-12-2019',
//				'event-time' => '19:30:00',
//				'venue-name' => 'Carnegie Hall',
//			],
//			'events',
//			$this->post,
//		];
//
//		// Test that the callback received the 3 arguments and the values are as expected.
//		$this->assertCount( 3, $args );
//		$this->assertSame( $expected_args, $args );
//
//		// Modify the custom field values.
//		$custom_fields['event-date'] = '10-19-2019';
//		$custom_fields['event-time'] = '15:00:00';
//		$custom_fields['venue-name'] = 'The Fabulous Fox Theater';
//
//		return $custom_fields;
//	}
}
