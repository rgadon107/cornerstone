<?php
/**
 * Tests for register_custom_configs().
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

/**
 * @covers ::\spiralWebDb\CornerstoneTours\register_custom_configs
 *
 * @group   tours
 */
class Tests_RegisterCustomConfigs extends Test_Case {

	public function test_callback_is_registered_to_filter_hook_when_event_fires() {
		$this->assertEquals( 7, has_filter( 'add_custom_post_type_runtime_config', 'spiralWebDb\CornerstoneTours\register_custom_configs' ) );
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_add_runtime_post_type_config_to_existing_configs( array $existing, array $expected ) {
		$configs = apply_filters( 'add_custom_post_type_runtime_config', $existing );

		$this->assertArrayHasKey( 'tours', $configs );
		$this->assertSame( $expected, $configs['tours'] );

		foreach ( $existing as $key => $config ) {
			$this->assertArrayHasKey( $key, $configs );
			$this->assertSame( $config, $configs[ $key ] );
		}
	}

	public function addTestData() {
		$tours = (array) require _get_plugin_directory() . '/config/post-type.php';

		return [
			'testShouldIncludToursConfig' => [
				'existing_configs' => [],
				'tours'            => $tours,
			],

			'testShouldMergeToursWithExistinConfigs' => [
				'existing_configs' => [
					'ipseum' => [
						'post_type' => 'ipseum',
						'labels'    => [
							'singular_label' => 'Ipseum',
						],
						'features'  => [
							'base_post_type' => 'post',
						],
						'args'      => [],
					],
				],
				'tours'            => $tours,
			],
		];
	}
}

