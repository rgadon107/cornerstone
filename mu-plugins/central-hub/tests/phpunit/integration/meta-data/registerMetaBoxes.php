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
	}

	/**
	 * Test register_meta_boxes() should return null when no store key starts with 'meta_box.'.
	 */
	public function test_should_return_null_when_no_store_key_starts_with_meta_box() {
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
		];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}

		$this->assertNull( register_meta_boxes() );

		self::empty_the_store_by_keys(
			[ 'taxonomy.roles', 'shortcode.qa', 'custom_post_type.books' ]
		);
	}
}
