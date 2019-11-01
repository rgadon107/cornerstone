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
	 * Array of default config params.
	 *
	 * @var array
	 */
	private $defaults = [];

	/**
	 * Prepare the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/module.php';

		$this->defaults = (array) require CENTRAL_HUB_ROOT_DIR . '/src/meta-data/defaults/meta-box-config.php';
		$this->defaults    = current( $this->defaults );
	}

	/**
	 * Test autoload configurations() should load a metabox config from the filesystem into Config Store.
	 */
	public function test_should_load_config_from_filesystem_into_config_store() {
		$config_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-members-runtime-config.php';

		// Assert that loadConfigFromFilesystem() runs once and receives the expected parameters.
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\loadConfigFromFilesystem' )
			->once()
			->with( $config_file, $this->defaults )
			->andReturn( 'meta_box.members' );
		Monkey\Functions\when( 'spiralWebDB\Metadata\init_custom_fields_configuration' )->justReturn();

		autoload_configurations( [ $config_file ] );

		// This is a placeholder to avoid PHPUnit error. The "expect" above is the assertion in this test.
		$this->assertTrue( true );
	}

	/**
	 * Test autoload configurations() should load the initialized custom fields configuration, i.e. missing custom
	 * field's configuration parameters are populated by the default config.
	 */
	public function test_should_load_initialized_the_custom_fields_config() {
		Monkey\Functions\when( 'KnowTheCode\ConfigStore\loadConfigFromFilesystem' )->justReturn( 'meta_box.members' );
		// Assert that init_custom_fields_configuration() runs once and receives the expected parameter.
		Monkey\Functions\expect( 'spiralWebDB\Metadata\init_custom_fields_configuration' )
			->once()
			->with( 'meta_box.members' )
			->andReturn();

		autoload_configurations( [ CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-members-runtime-config.php' ] );

		// This is a placeholder to avoid PHPUnit error. The "expect" above is the assertion in this test.
		$this->assertTrue( true );
	}

	/**
	 * Test autoload configurations() should load multiple config files from the filesystem into Config Store.
	 */
	public function test_should_load_multiple_config_files_from_filesystem_into_config_store() {
		$config_files = [
			'some/path/to/config1.php',
			'some/path/to/config2.php',
			'some/path/to/config3.php',
		];

		// Assert that loadConfigFromFilesystem() runs three times and receives the expected parameters.
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\loadConfigFromFilesystem' )
			->once()
			->with( $config_files[0], $this->defaults )
			->andReturn( 'meta_box.members' )
			->andAlsoExpectIt()
			->once()
			->with( $config_files[1], $this->defaults )
			->andReturn( 'meta_box.members' )
			->once()
			->with( $config_files[2], $this->defaults )
			->andReturn( 'meta_box.members' );
		Monkey\Functions\when( 'spiralWebDB\Metadata\init_custom_fields_configuration' )->justReturn();

		autoload_configurations( $config_files );

		// This is a placeholder to avoid PHPUnit error. The "expect" above is the assertion in this test.
		$this->assertTrue( true );
	}
}
