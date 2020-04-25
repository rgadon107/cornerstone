<?php
/**
 * Tests for the function register_meta_boxes().
 *
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use function spiralWebDB\Metadata\register_meta_boxes;
use function KnowTheCode\ConfigStore\loadConfig;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * @covers ::\spiralWebDB\Metadata\register_meta_boxes
 * @uses    ::\spiralWebDB\Metadata\get_meta_box_keys
 * @uses    ::\spiralWebDB\Metadata\get_meta_box_id
 * @uses    ::\KnowTheCode\ConfigStore\getConfigParameter
 *
 * @group   meta-data
 */
class Tests_RegisterMetaBoxes extends Test_Case {

	public static function setUpBeforeClass() {
		parent::setUpBeforeClass();
		self::empty_the_store();
	}

	/**
	 * Set up each test.
	 */
	public function setUp() {
		parent::setUp();

		global $wp_meta_boxes;
		if ( is_null( $wp_meta_boxes ) ) {
			$wp_meta_boxes = [];
		}
	}

	/**
	 * @dataProvider addShouldRegisterTestData
	 */
	public function test_should_register_metaboxes( $configs ) {
		global $wp_meta_boxes;

		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );

			$mb_config = $config_to_store['add_meta_box'];

			// Test state prior to registering the meta box.
			foreach( (array) $mb_config['screen']  as $screen ) {
				$this->assertArrayNotHasKey( $screen, $wp_meta_boxes );
			}

			register_meta_boxes();

			foreach( (array) $mb_config['screen'] as $screen ) {
				// Test the meta box is registered.
				$this->assertArrayHasKey( $screen, $wp_meta_boxes );

				$meta_box = $wp_meta_boxes[ $screen ][ $mb_config['context'] ][ $mb_config['priority'] ][ $mb_config['id'] ];
				$this->assertSame( $mb_config['id'], $meta_box['id'] );
				$this->assertSame( $mb_config['title'], $meta_box['title'] );
				$this->assertSame( 'spiralWebDB\Metadata\render_meta_box', $meta_box['callback'] );
				$this->assertSame( $mb_config['callback_args'], $meta_box['args'] );

				// Clean up.
				unset( $wp_meta_boxes[ $screen ] );
			}

			self::remove_from_store( $store_key );
		}
	}

	public function addShouldRegisterTestData() {
		return [
			[
				'configs' => [
					'meta_box.events' => [
						'add_meta_box' => [
							'id'            => 'events',
							'title'         => 'Event Info',
							'screen'        => 'events',
							'context'       => 'advanced',
							'priority'      => 'default',
							'callback_args' => null,
						],
					],
				],
			],
			[
				'configs' => [
					'meta_box.events'  => [
						'add_meta_box' => [
							'id'            => 'events',
							'title'         => 'Event Info',
							'screen'        => [ 'events' ],
							'context'       => 'advanced',
							'priority'      => 'default',
							'callback_args' => null,
						],
					],
					'meta_box.members' => [
						'add_meta_box' => [
							'id'            => 'members',
							'title'         => 'Tour Member Profile Information',
							'screen'        => [ 'members' ],
							'context'       => 'advanced',
							'priority'      => 'default',
							'callback_args' => null,
						],
					],
					'meta_box.reviews' => [
						'add_meta_box' => [
							'id'            => 'reviews',
							'title'         => 'Cornerstone Reviews',
							'screen'        => 'reviews',
							'context'       => 'advanced',
							'priority'      => 'default',
							'callback_args' => null,
						],
					],
				],
			],
		];
	}

	/**
	 * @dataProvider addShouldNotRegisterTestData
	 */
	public function test_should_not_register_metaboxes( $configs ) {
		global $wp_meta_boxes;
		$meta_boxes_before = $wp_meta_boxes;

		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}

		register_meta_boxes();

		// Test that no additional meta boxes were registered.
		$this->assertSame( $meta_boxes_before, $wp_meta_boxes );

		// Clean up.
		self::empty_the_store( $configs );
	}

	public function addShouldNotRegisterTestData() {
		return [
			[
				'configs' => [
					'taxonomy.roles' => [
						'Soprano' => 'Soprano (vocalist)',
					],
				],
			],
			[
				'configs' => [
					'shortcode.qa' => [
						'Question 1' => 'How many angels can dance on the head of a pin?',
					],
				],
			],
			[
				'configs' => [
					'custom_post_type.books' => [
						'Title' => 'To Kill a Mockingbird',
					],
					'metabox.notametabox'    => [
						'add_meta_box' => [
							'id'     => 'notametabox',
							'title'  => 'Does not start with the right meta_box. structure',
							'screen' => [ 'notametabox' ],
						],
					],
				],
			],
		];
	}
}
