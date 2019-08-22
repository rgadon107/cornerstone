<?php
/**
 * Tests for the function is_okay_to_save_meta_box().
 *
 * @package     spiralWebDb\centralHub\Tests\Integration\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use function KnowTheCode\ConfigStore\loadConfig;
use function wp_verify_nonce;
use function spiralWebDB\Metadata\is_okay_to_save_meta_box;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_RegisterMetaBoxes
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_IsOkayToSaveMetaBox extends Test_Case {

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
		array_key_exists( 'events', $_POST );

		// CLI Error message:
		// 1) spiralWebDb\centralHub\Tests\Integration\Metadata\Tests_IsOkayToSaveMetaBox::test_should_check_that_the_meta_box_key_exists_in_the_post_array

		// Fatal error: Default value for parameters with a class type hint can only be NULL in
		// /app/public/wp-content/tests/vendor/symfony/yaml/Yaml.php on line 52

//		define( 'DOING_AUTOSAVE', true );
//		define( 'DOING_AJAX', true );
//		define( 'DOING_CRON', true );
//		defined( 'DOING_AUTOSAVE' ) && ! DOING_AUTOSAVE;
//		defined( 'DOING_AJAX' ) && ! DOING_AJAX;
//		defined( 'DOING_CRON' ) && ! DOING_CRON;

//		wp_verify_nonce( $_POST[ 'events' . '_nonce_name' ], 'events' . '_nonce_action' );

//		var_dump( wp_verify_nonce( $_POST[ 'events' . '_nonce_name' ], 'events' . '_nonce_action' ) );

		$this->assertEquals( 1, is_okay_to_save_meta_box( 'events' ) );
	}
}