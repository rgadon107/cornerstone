<?php
/**
 * Tests for register_the_template_files().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Brain\Monkey;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\_get_plugin_directory;
use function spiralWebDb\CornerstoneTours\register_the_template_files;

/**
 * Class Tests_RegisterTheTemplateFiles
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Unit
 * @group   tours
 */
class Tests_RegisterTheTemplateFiles extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/config-loader.php';
	}

	/*
	 * Test register_the_template_files() should return template files when given valid path to plugin config.
	 */
	public function test_should_return_template_files_given_valid_path_to_plugin_config() {
		$templates = [];
		// _get_plugin_directory() is called 3 times when register_the_template_files() is invoked.
		// _get_plugin_directory() is called an additional time when the assertArraySubset() method is run.
		Monkey\Functions\expect( 'spiralWebDb\CornerstoneTours\_get_plugin_directory' )
			->times( 14 )
			->with()
			->andReturn( TOURS_ROOT_DIR );

		$this->assertArrayHasKey( 'single', register_the_template_files( (array) $templates ) );
		$this->assertArraySubset( [ 'single' => [ 'tours' => _get_plugin_directory() . '/src/template/single-tours.php' ] ], register_the_template_files( (array) $templates ) );
		$this->assertArrayHasKey( 'post_type_archive', register_the_template_files( (array) $templates ) );
		$this->assertArraySubset( [ 'post_type_archive' => [ 'tours' => _get_plugin_directory() . '/src/template/archive-tours.php' ] ], register_the_template_files( (array) $templates ) );
	}
}

