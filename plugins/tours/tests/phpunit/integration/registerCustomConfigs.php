<?php
/**
 * Tests for register_custom_configs().
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
use function spiralWebDb\CornerstoneTours\register_custom_configs;

/**
 * Class Tests_RegisterCustomConfigs
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests_RegisterCustomConfigs extends Test_Case {

	/*
	 * Test register_custom_configs() is registered to filter 'add_custom_post_type_runtime_config' when event fires.
	 */
	public function test_callback_is_registered_to_filter_hook_when_event_fires() {
		$this->assertTrue( has_filter( 'add_custom_post_type_runtime_config' ) );
		$this->assertEquals( 7, has_filter( 'add_custom_post_type_runtime_config', 'spiralWebDb\CornerstoneTours\register_custom_configs' ) );
	}

	/*
     * Test register_custom_configs() should add a runtime post_type config to existing configs.
	 */
	public function test_should_add_runtime_post_type_config_to_existing_configs() {
		$configurations      = [];
		$expected_subarray_1 = [
			'tours' => [
				'post_type' => 'tours'
			]
		];
		$expected_subarray_2 = [
			'tours' => [
				'labels' => [
					'singular_label'    => 'Past Tour',
					'plural_label'      => 'Past Tours',
					'in_sentance_label' => 'Tours', // The label used within a sentance.
					'text_domain'       => 'cornerstone-tours',
				]
			]
		];
		$expected_subarray_3 = [
			'tours' => [
				'features' => [
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
			]
		];
		$expected_subarray_4 = [
			'tours' => [
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
		];

		$this->assertArrayHasKey( 'tours', register_custom_configs( (array) $configurations ) );
		$this->assertArraySubset( $expected_subarray_1, register_custom_configs( (array) $configurations ) );
		$this->assertArraySubset( $expected_subarray_2, register_custom_configs( (array) $configurations ) );
		$this->assertArraySubset( $expected_subarray_3, register_custom_configs( (array) $configurations ) );
		$this->assertArraySubset( $expected_subarray_4, register_custom_configs( (array) $configurations ) );
	}
}

