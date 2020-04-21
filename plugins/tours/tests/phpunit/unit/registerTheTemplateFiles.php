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

	/**
	 * Test register_the_template_files() should return an array of configuration template files when given an empty
	 * templates array.
	 */
	public function test_should_return_an_array_of_configuration_template_files_given_an_empty_templates_array() {
		Monkey\Functions\expect( 'spiralWebDb\CornerstoneTours\_get_plugin_directory' )
			->times( 3 )
			->with()
			->andReturn( TOURS_ROOT_DIR );
		$templates = [];
		$config = [
			'single' => [
				'tours' => TOURS_ROOT_DIR . '/src/template/single-tours.php',
			],
			'post_type_archive' => [
				'tours' => TOURS_ROOT_DIR . '/src/template/archive-tours.php',
			],
		];

		$this->assertSame( $config, register_the_template_files( (array) $templates ) );
	}

	/**
	 * Test register_the_template_files() should return a merged array of configuration template files when given a templates array.
	 */
	public function test_should_return_a_merged_array_of_config_template_files_when_given_a_templates_array()   {
		Monkey\Functions\expect( 'spiralWebDb\CornerstoneTours\_get_plugin_directory' )
			->times( 3 )
			->with()
			->andReturn( TOURS_ROOT_DIR );
		$templates = [
			'single' => [
				'baz' => __DIR__ . '/baz/templates.php',
			]
		];
		$config = [
			'single' => [
				'tours' => TOURS_ROOT_DIR . '/src/template/single-tours.php',
			],
			'post_type_archive' => [
				'tours' => TOURS_ROOT_DIR . '/src/template/archive-tours.php',
			],
		];

		$this->assertSame( array_merge_recursive( $templates, $config ), register_the_template_files( (array) $templates ) );
	}
}

