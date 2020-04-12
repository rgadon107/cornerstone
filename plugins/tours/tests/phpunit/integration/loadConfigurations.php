<?php
/**
 * Tests for load_configurations().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function KnowTheCode\ConfigStore\getConfig;
use function spiralWebDb\CornerstoneTours\load_configurations;

/**
 * Class Tests_LoadConfigurations
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests_LoadConfigurations extends Test_Case {

	/*
	 * Test load_configurations() should load the 'tours' plugin meta-box configuration.
	 */
	public function test_should_load_plugin_meta_box_config() {
		load_configurations();

		$actual_config = getConfig( 'meta_box.tours' );
		$this->assertArrayHasKey( 'add_meta_box', $actual_config );
		$this->assertArrayHasKey( 'custom_fields', $actual_config );
		$this->assertArrayHasKey( 'view', $actual_config );

		// Clean up.
		self::remove_from_store( 'meta_box.tours' );
	}
}

