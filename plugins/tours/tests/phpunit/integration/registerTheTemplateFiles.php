<?php
/**
 * Tests for register_the_template_files().
 *
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\_get_plugin_directory;
use function spiralWebDb\CornerstoneTours\register_the_template_files;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\register_the_template_files
 *
 * @group   tours
 * @group   admin
 */
class Tests_RegisterTheTemplateFiles extends Test_Case {

	/**
	 * Test register_the_template_files() is registered to filter 'register_templates_with_template_loader' when event
	 * fires.
	 */
	public function test_callback_is_registered_to_filter_hook_when_event_fires() {
		$this->assertEquals( 10, has_filter( 'register_templates_with_template_loader', 'spiralWebDb\CornerstoneTours\register_the_template_files' ) );
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
			'empty_templates_array' => [
				'templates' => [],
				'config'    => [
					'single'            => [
						'tours' => _get_plugin_directory() . '/src/template/single-tours.php',
					],
					'post_type_archive' => [
						'tours' => _get_plugin_directory() . '/src/template/archive-tours.php',
					],
				],
			],
			'non_empty_templates_array'    => [
				'templates' => [
					'single' => [
						'baz' => __DIR__ . '/baz/templates.php',
					]
				],
				'config'    => [
					'single'            => [
						'tours' => _get_plugin_directory() . '/src/template/single-tours.php',
					],
					'post_type_archive' => [
						'tours' => _get_plugin_directory() . '/src/template/archive-tours.php',
					],
				],
			]
		];
	}
}

