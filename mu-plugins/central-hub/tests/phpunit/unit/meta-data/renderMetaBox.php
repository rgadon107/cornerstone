<?php
/**
 * Tests for the function render_meta_box().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\Metadata;

use Brain\Monkey;
use function spiralWebDB\Metadata\render_meta_box;
use function KnowTheCode\ConfigStore\loadConfig;
use function KnowTheCode\ConfigStore\getConfig;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_RenderMetaBox
 *
 * @package spiralWebDb\centralHub\Tests\Unit\Metadata
 * @group   meta-data
 */
class Tests_RenderMetaBox extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/meta-box.php';
	}

	/*  Test render_meta_box() should register a nonce and the metadata for each custom field given a
	 *	meta_box.{id}, and load the metadata view file.
	 */
	public function test_should_register_nonce_and_metadata_for_each_custom_field_and_load_view() {
		$meta_box_args = [];
		$config_store  = [
			'meta_box.events' => [
				'custom_fields' => [
					'event_date',
					'event_time',
					'venue_name',
					'venue_address',
					'venue_city',
					'venue_state',
				],
				// Q: Specify a path to a fixture file that mocks the view?
				'view'          => '',
			]
		];
		foreach ( $config_store as $store_key => $custom_fields_meta_key ) {
			loadConfig( $store_key, $custom_fields_meta_key );
		}
		$config = getConfig( 'meta_box.events' );
		// Call the view file ( $config[''] ) here.

		Monkey\Functions\expect( 'spiralWebDB\Metadata\wp_nonce_field' )
			->andReturn( 'events_nonce_action', 'events_nonce_name' );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\get_custom_fields_values' )
			->andReturn( $post, 'events', $config );

		$this->assertNull( render_meta_box( $post, $meta_box_args ) );
	}
}

