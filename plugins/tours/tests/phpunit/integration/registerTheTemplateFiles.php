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
use function has_filter;
use function spiralWebDb\CornerstoneTours\register_the_template_files;

/**
 * Class Tests_RegisterTheTemplateFiles
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests_RegisterTheTemplateFiles extends Test_Case {

	/*
	 * Test register_the_template_files() is registered to filter 'register_templates_with_template_loader' when event fires.
	 */
	public function test_callback_is_registered_to_filter_hook_when_event_fires() {
		$this->assertTrue( has_filter( 'register_templates_with_template_loader' ) );
		$this->assertEquals( 10, has_filter( 'register_templates_with_template_loader', 'spiralWebDb\CornerstoneTours\register_the_template_files' ) );
	}
}

