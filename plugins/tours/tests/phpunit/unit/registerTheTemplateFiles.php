<?php
/**
 * Tests for register_the_template_files().
 *
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Unit
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\register_the_template_files;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\register_the_template_files
 *
 * @group   tours
 */
class Tests_RegisterTheTemplateFiles extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/config-loader.php';

		Functions\expect( 'spiralWebDb\CornerstoneTours\_get_plugin_directory' )
			->times( 3 )
			->with()
			->andReturn( TOURS_ROOT_DIR );
	}

	/**
	 * @dataProvider addTestData
	 *
	 * @param array $templates Array of templates to merge with configuration array.
	 * @param array $config    Configuration of templates array loaded from plugin.
	 */
	public function test_merge_of_configuration_template_files_with_templates_array( array $templates, array $config ) {
		if ( empty( $templates ) ) {
			$this->assertSame( $config, register_the_template_files( (array) $templates ) );
		} else {
			$this->assertSame( array_merge_recursive( $templates, $config ), register_the_template_files( (array) $templates ) );
		}
	}

	public function addTestData() {
		return [
			'templates_array_empty' => [
				'templates' => [],
				'config'    => [
					'single'            => [
						'tours' => TOURS_ROOT_DIR . '/src/template/single-tours.php',
					],
					'post_type_archive' => [
						'tours' => TOURS_ROOT_DIR . '/src/template/archive-tours.php',
					],
				],
			],
			'templates_to_merge'    => [
				'templates' => [
					'single' => [
						'baz' => __DIR__ . '/baz/templates.php',
					]
				],
				'config'    => [
					'single'            => [
						'tours' => TOURS_ROOT_DIR . '/src/template/single-tours.php',
					],
					'post_type_archive' => [
						'tours' => TOURS_ROOT_DIR . '/src/template/archive-tours.php',
					],
				],
			]
		];
	}
}

