<?php
/**
 * Tests for register_custom_configs().
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
use function spiralWebDb\CornerstoneTours\register_custom_configs;

/**
 * Class Tests_RegisterCustomConfigs
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Unit
 * @group   tours
 */
class Tests_RegisterCustomConfigs extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/config-loader.php';
	}

	/*
	 * Test register_custom_configs() should add a runtime post_type config to existing configs.
	 */
	public function test_should_add_runtime_post_type_config_to_existing_configs() {
		$configurations = [];
		Monkey\Functions\expect( '_get_plugin_directory' )
			->times(5)
			->with()
			->andReturn( TOURS_ROOT_DIR );
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

