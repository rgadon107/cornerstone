<?php
/**
 * Tests for the function register_meta_boxes().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use function spiralWebDB\Metadata\register_meta_boxes;
use function KnowTheCode\ConfigStore\loadConfig;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_RegisterMetaBoxes
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_RegisterMetaBoxes extends Test_Case {

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

		global $wp_meta_boxes;
		if ( is_null( $wp_meta_boxes ) ) {
			$wp_meta_boxes = [];
		}
	}

	/*
 * Test register_meta_boxes() should register to add_action( 'admin_menu' ) when event fires.
 */
	public function test_function_should_register_to_action_hook_when_event_fires() {
		$this->assertTrue( has_action( 'admin_menu' ) );
		$this->assertSame( 10, has_action( 'admin_menu', 'spiralWebDB\Metadata\register_meta_boxes' ) );
	}

	/**
	 * Test register_meta_boxes() should register the configured meta box with WordPress.
	 */
	function test_should_register_configured_meta_box_with_wordpress() {
		$configs = [
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
		];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}

		global $wp_meta_boxes;

		// Test state prior to registering the meta box.
		$this->assertArrayNotHasKey( 'events', $wp_meta_boxes );

		register_meta_boxes();

		// Test the meta box is registered.
		$this->assertArrayHasKey( 'events', $wp_meta_boxes['events']['advanced']['default'] );
		$meta_box = $wp_meta_boxes['events']['advanced']['default']['events'];
		$this->assertSame( $configs['meta_box.events']['add_meta_box']['id'], $meta_box['id'] );
		$this->assertSame( $configs['meta_box.events']['add_meta_box']['title'], $meta_box['title'] );
		$this->assertSame( 'spiralWebDB\Metadata\render_meta_box', $meta_box['callback'] );
		$this->assertNull( $meta_box['args'] );

		// Clean up.
		self::remove_from_store( 'meta_box.events' );
		unset( $wp_meta_boxes['events'] );
	}

	/**
	 * Test register_meta_boxes() should register multiple configured meta boxes with WordPress.
	 */
	function test_should_register_multiple_configured_meta_boxes_with_wordpress() {
		$configs = [
			'meta_box.events'  => [
				'add_meta_box' => [
					'id'            => 'events',
					'title'         => 'Event Info',
					'screen'        => 'events',
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
					'screen'        => [ 'reviews' ],
					'context'       => 'advanced',
					'priority'      => 'default',
					'callback_args' => null,
				],
			],
		];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}
		$metabox_ids = [ 'events', 'members', 'reviews' ];

		global $wp_meta_boxes;

		// Test state prior to registering the meta box.
		foreach ( $metabox_ids as $id ) {
			$this->assertArrayNotHasKey( $id, $wp_meta_boxes );
		}

		register_meta_boxes();

		// Check that only the expected meta boxes are registered.
		$this->assertSame( $metabox_ids, array_keys( $wp_meta_boxes ) );

		// Test the meta boxes are registered.
		foreach ( $metabox_ids as $id ) {
			$this->assertArrayHasKey( $id, $wp_meta_boxes[ $id ]['advanced']['default'] );
			$meta_box = $wp_meta_boxes[ $id ]['advanced']['default'][ $id ];
			$this->assertSame( $configs["meta_box.{$id}"]['add_meta_box']['id'], $meta_box['id'] );
			$this->assertSame( $configs["meta_box.{$id}"]['add_meta_box']['title'], $meta_box['title'] );
			$this->assertSame( 'spiralWebDB\Metadata\render_meta_box', $meta_box['callback'] );
			$this->assertNull( $meta_box['args'] );
		}

		// Clean up.
		self::empty_the_store( $configs );
		foreach ( $metabox_ids as $id ) {
			unset( $wp_meta_boxes[ $id ] );
		}
	}

	/**
	 * Test register_meta_boxes() should not register meta boxes when there are no store keys that start with
	 * 'meta_box.'.
	 */
	public function test_should_not_register_meta_boxes_when_no_store_keys_start_with_meta_box() {
		$configs = [
			'taxonomy.roles'         => [
				'Soprano' => 'Soprano (vocalist)',
			],
			'shortcode.qa'           => [
				'Question 1' => 'How many angels can dance on the head of a pin?',
			],
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
		];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}

		global $wp_meta_boxes;
		$pre = $wp_meta_boxes;

		register_meta_boxes();

		// Test that no additional meta boxes were registered.
		$this->assertSame( $pre, $wp_meta_boxes );

		// Clean up.
		self::empty_the_store( $configs );
	}
}
