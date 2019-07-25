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

use Brain\Monkey;
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

	/*
    * Test register_meta_boxes() will add a meta box for each store key that starts with 'metabox.'.
    */
	function test_function_will_add_a_meta_box_for_each_store_key_that_starts_with_metabox() {
		$configs = [
			'metabox.events' => [
				'add_meta_box' => [
					'id'            => 'events',
					'title'         => 'Event Info',
					'screen'        => 'events',
					'context'       => 'advanced',
					'priority'      => 'default',
					'callback_args' => null
				]
			]
		];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}

		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_meta_box_id' )
			->once()
			->with( 'metabox.events' )
			->andReturn( 'events' );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\render_meta_box' )
			->never();

		$this->assertTrue( register_meta_boxes() );

		self::empty_the_store_by_keys( [ 'metabox.events' ] );
	}

	/*
    * Test register_meta_boxes() returns null when no store key starts with 'metabox.'.
    */
	public function test_function_should_return_null_when_no_store_key_starts_with_metabox() {
		$configs = [
			'taxonomy.roles'         => [
				'Soprano' => 'Soprano (vocalist)'
			],
			'shortcode.qa'           => [
				'Question 1' => 'How many angels can dance on the head of a pin?'
			],
			'custom_post_type.books' => [
				'Title' => 'To Kill a Mockingbird',
			]
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