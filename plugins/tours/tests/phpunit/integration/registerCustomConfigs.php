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
use function spiralWebDb\CornerstoneTours\register_custom_configs;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\register_custom_configs
 *
 * @group   tours
 */
class Tests_RegisterCustomConfigs extends Test_Case {

	/**
	 * Test register_custom_configs() is registered to filter 'add_custom_post_type_runtime_config' when event fires.
	 */
	public function test_callback_is_registered_to_filter_hook_when_event_fires() {
		$this->assertEquals( 7, has_filter( 'add_custom_post_type_runtime_config', 'spiralWebDb\CornerstoneTours\register_custom_configs' ) );
	}

	/**
	 * @dataProvider addTestData
	 * @param array $configurations
	 * @param array $tours
	 */
	public function test_should_add_runtime_post_type_config_to_existing_configs( array $configurations, array $tours) {

		$this->assertArrayHasKey( 'tours', register_custom_configs( (array) $configurations ) );
		$this->assertContains( $tours['post_type'], (array) $tours );
		$this->assertContains( $tours['features'], (array) $tours );
		$this->assertContains( $tours['args'], (array) $tours );
	}

	public function addTestData() {
		return [
			'post type config' => [
				'configurations' => [],
				'tours'          => [
					'post_type' => 'tours',
					'features'  => [
						'base_post_type' => 'post',
						'exclude'        => [
							'excerpt',
							'comments',
							'trackbacks',
	//			            'custom-fields',
							'thumbnail', // also known as the 'featured image'.
							'author',
							'post-formats',
							'genesis-seo',
							'genesis-scripts',
							'genesis-layouts',
							'genesis-rel-author',
						],
						'additional'     => [
							'page-attributes',
						],
					],
					'args'      => [
						'description'  => '', // For informational purposes only.
						'label'        => '',
						'labels'       => '', // automatically generate the labels.
						'public'       => true,
						'show_in_rest' => true,
						'menu_icon'    => 'dashicons-admin-site',
						'supports'     => '', // automatically generate the support features.
						'has_archive'  => true,
					],
				]
			]
		];
	}
}

