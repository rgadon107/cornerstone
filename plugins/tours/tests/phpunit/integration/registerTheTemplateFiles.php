<?php
/**
 * Tests for register_the_template_files().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\_get_plugin_directory;
use function spiralWebDb\CornerstoneTours\register_the_template_files;

/**
 * Class Tests_RegisterTheTemplateFiles
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
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
	 * Test register_the_template_files() should return an array of configuration template files when given an empty templates array.
	 */
	public function test_should_return_an_array_of_configuration_template_files_given_an_empty_templates_array() {
		$config = require _get_plugin_directory() . '/config/templates.php';

		$this->assertSame( $config, register_the_template_files( [] ) );
	}

	/**
	 * Test register_the_template_files() should return a merged array of configuration template files when given a templates array.
	 */
	public function test_should_return_a_merged_array_of_config_template_files_when_given_a_templates_array()   {
		$templates = [
			'single' => [
				'baz' => __DIR__ . '/baz/templates.php',
			]
		];
		$config = require _get_plugin_directory() . '/config/templates.php';

		$this->assertSame( array_merge_recursive( $templates, $config ), register_the_template_files( (array) $templates ) );
	}
}


