<?php
/**
 * Tests for the function autoload_configurations().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\Metadata;

use Brain\Monkey;
use function spiralWebDB\Metadata\autoload_configurations;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_AutoloadConfigurations
 *
 * @package spiralWebDb\centralHub\Tests\Unit\Metadata
 * @group   meta-data
 */
class Tests_AutoloadConfigurations extends Test_Case {

	/**
	 * Prepare the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/module.php';
	}

	/**
	 * Test autoload configurations() should load a metabox config, and initialize it's custom fields when given a
	 * custom config.
	 */
	public function test_should_load_a_meta_box_config_and_initialize_the_custom_fields_when_given_a_custom_config() {
		$config_array        = (array) require CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-members-runtime-config.php';
		$defaults            = (array) require CENTRAL_HUB_ROOT_DIR . '/src/meta-data/defaults/meta-box-config.php';
		$defaults            = current( $defaults );
		Monkey\Functions\when( 'KnowTheCode\ConfigStore\loadConfigFromFilesystem' )
			->justReturn( 'meta_box.members' );
		Monkey\Functions\expect( 'spiralWebDB\Metadata\init_custom_fields_configuration' )
			->once()
			->with( 'meta_box.members' )
			->andReturn();

		autoload_configurations( $config_array );

		$this->assertArrayHasKey( 'meta_box.members', $config_array );
		$this->assertArrayHasKey( 'add_meta_box', $defaults );
		$this->assertArrayHasKey( 'custom_fields', $defaults );
		$this->assertArrayHasKey( 'view', $defaults );
	}
}

