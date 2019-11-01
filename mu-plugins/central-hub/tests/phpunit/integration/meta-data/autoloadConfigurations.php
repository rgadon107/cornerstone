<?php
/**
 * Tests for the function autoload_configurations().
 *
 * @package     spiralWebDb\centralHub\Tests\Integration\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use function KnowTheCode\ConfigStore\loadConfigFromFilesystem;
use function spiralWebDB\Metadata\autoload_configurations;
use function spiralWebDB\Metadata\init_custom_fields_configuration;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_AutoloadConfigurations
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_AutoloadConfigurations extends Test_Case {

	/**
	 * Set up each test.
	 */
	public function setUp() {
		parent::setUp();
	}

	/**
	 * Test autoload configurations() should load a metabox config, and initialize it's custom fields when given a
	 * custom config.
	 */
	public function test_should_load_a_meta_box_config_and_initialize_the_custom_fields_when_given_a_custom_config() {
		$config_files = [
			0 => CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-members-runtime-config.php'
		];
		$config_file  = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-members-runtime-config.php';
		$defaults     = (array) require CENTRAL_HUB_ROOT_DIR . '/src/meta-data/defaults/meta-box-config.php';
		$defaults     = current( $defaults );

		$store_key = loadConfigFromFilesystem( $config_file, $defaults );
		init_custom_fields_configuration( $store_key );

		autoload_configurations( $config_files );

		$this->assertArrayHasKey( 0, $config_files );
		$this->assertArrayHasKey( 'add_meta_box', $defaults );
		$this->assertArrayHasKey( 'custom_fields', $defaults );
		$this->assertArrayHasKey( 'view', $defaults );
		$this->assertSame( 'meta_box.members', loadConfigFromFilesystem( $config_file, $defaults ) );
	}
}

