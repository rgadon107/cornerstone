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
	 * Configuration array property for custom fields. 
	 *
	 * @var array
	 */
	protected $config;

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/helpers.php';

		$this->post     = m::mock( 'WP_Post' );
		$this->post->ID = 99;
		$this->config = [
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
	}

	/**
	 * Test get_custom_fields_values() should return an empty array when custom fields config is empty.
	 */
	public function test_should_return_empty_array_when_custom_fields_config_is_empty() {
		$this->config = [ 'custom_fields' => [] ];

		$this->assertSame( [], get_custom_fields_values( $this->post->ID, 'events', $this->config ) );
	}

	/**
	 * Test get_custom_fields_values() should return post meta from database when meta key exists in custom fields
	 * config.
	 */
	public function test_should_return_post_meta_from_database_when_meta_key_exists_in_custom_fields_config() {
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $this->post->ID, 'event-date', $this->config['custom_fields']['event-date']['is_single'] )
			->andReturn( '10-26-2019' );
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $this->post->ID, 'event-time', $this->config['custom_fields']['event-time']['is_single'] )
			->andReturn( '19:30:00' );
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $this->post->ID, 'venue-name', $this->config['custom_fields']['venue-name']['is_single'] )
			->andReturn( 'Carnegie Hall' );

		$expected_custom_fields = [
			'event-date' => '10-26-2019',
			'event-time' => '19:30:00',
			'venue-name' => 'Carnegie Hall',
		];

		$this->assertSame( $expected_custom_fields, get_custom_fields_values( $this->post->ID, 'events', $this->config ) );
	}

	/**
	 * Test get_custom_fields_values() should return custom fields default values when post meta is not in database.
	 */
	public function test_should_return_custom_fields_default_values_when_post_meta_is_not_in_database() {
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->andReturn( $this->config['custom_fields']['event-date']['default'] );
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->andReturn( $this->config['custom_fields']['event-time']['default'] );
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->andReturn( $this->config['custom_fields']['venue-name']['default'] );

		$expected_custom_fields = [
			'event-date' => '',
			'event-time' => '',
			'venue-name' => '',
		];

		$this->assertSame( $expected_custom_fields, get_custom_fields_values( $this->post->ID, 'events', $this->config ) );
	}

	/**
	 * Test get_custom_fields_values() should return custom field values passed through filter.
	 */
	public function test_should_return_custom_field_values_passed_through_filter() {
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $this->post->ID, 'event-date', $this->config['custom_fields']['event-date']['is_single'] )
			->andReturn( '10-26-2019' );
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $this->post->ID, 'event-time', $this->config['custom_fields']['event-date']['is_single'] )
			->andReturn( '19:30:00' );
		Monkey\Functions\expect( 'get_post_meta' )
			->once()
			->with( $this->post->ID, 'venue-name', $this->config['custom_fields']['event-date']['is_single'] )
			->andReturn( 'Carnegie Hall' );

		$expected_custom_fields = [
			'event-date' => '10-26-2019',
			'event-time' => '19:30:00',
			'venue-name' => 'Carnegie Hall',
		];

		Monkey\Functions\expect( 'apply_filters' )
			->once()
			->with( 'filter_meta_box_custom_fields', $expected_custom_fields, 'events', $this->post->ID )
			->andReturn( $expected_custom_fields );

		$this->assertSame( $expected_custom_fields, get_custom_fields_values( $this->post->ID, 'events', $this->config ) );
	}
}
