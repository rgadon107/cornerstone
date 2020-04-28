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

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\register_custom_configs;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\register_custom_configs
 *
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

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_add_runtime_post_type_config_to_existing_configs( array $configurations, array $tours ) {
		Functions\expect( '_get_plugin_directory' )
			->times( 1 )
			->with()
			->andReturn( TOURS_ROOT_DIR );

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

