<?php
/**
 * Tests for the function is_okay_to_save_meta_box().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\Metadata;

use Brain\Monkey;
use function KnowTheCode\ConfigStore\loadConfig;
use function spiralWebDB\Metadata\is_okay_to_save_meta_box;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_RegisterMetaBoxes
 *
 * @package spiralWebDb\centralHub\Tests\Unit\Metadata
 * @group   meta-data
 */
class Tests_IsOkayToSaveMetaBox extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/meta-box.php';
	}

	/**
	 * Test is_okay_to_save_meta_box() should check the meta box key exists in the $_POST array.
	 */
	public function test_should_check_that_the_meta_box_key_exists_in_the_post_array() {
		$_POST = [
			'events' => [
				'add_meta_box'  => [],
				'custom_fields' => [],
				'view'          => '',
			],
		];
		foreach ( $_POST as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}
		Monkey\Functions\expect( '\wp_verify_nonce' )
			->once()
			->with( $_POST[ 'events' . '_nonce_name' ], 'events' . '_nonce_action' )
			->andReturn( 1 );

		$this->assertEquals( 1, is_okay_to_save_meta_box( 'events' ) );
	}

	/**
	 *  Test is_okay_to_save_meta_box() should return false if the meta box key does not exist in the $_POST array.
	 */
	function test_function_should_return_false_if_the_meta_box_key_does_not_exist_in_the_post_array() {
		$_POST = [
			'events' => [
				'add_meta_box'  => [],
				'custom_fields' => [],
				'view'          => '',
			],
		];
		foreach ( $_POST as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}

		$this->assertFalse( is_okay_to_save_meta_box( 'members' ) );
	}

	/**
	 *  Test is_okay_to_save_meta_box() should return false when doing autosave, ajax, or cron.
	 */
	public function test_function_should_return_false_when_doing_autosave_ajax_or_cron() {
		$_POST = [
			'events' => [
				'add_meta_box'  => [],
				'custom_fields' => [],
				'view'          => '',
			],
		];
		foreach ( $_POST as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}
		define( 'DOING_AUTOSAVE', true );
		define( 'DOING_AJAX', true );
		define( 'DOING_CRON', true );
		defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE && ! DOING_AJAX && ! DOING_CRON;

		$this->assertFalse( is_okay_to_save_meta_box( 'events' ) );

		defined( 'DOING_AJAX' ) && DOING_AJAX && ! DOING_AUTOSAVE  && ! DOING_CRON;

		$this->assertFalse( is_okay_to_save_meta_box( 'events' ) );

		defined( 'DOING_CRON' ) && DOING_CRON && ! DOING_AUTOSAVE && ! DOING_AJAX;

		$this->assertFalse( is_okay_to_save_meta_box( 'events' ) );
	}
}

