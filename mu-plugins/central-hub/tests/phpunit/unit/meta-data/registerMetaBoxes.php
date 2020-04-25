<?php
/**
 * Tests for the function register_meta_boxes().
 *
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\Metadata;

use Brain\Monkey\Functions;
use function spiralWebDB\Metadata\register_meta_boxes;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * @covers ::\spiralWebDB\Metadata\register_meta_boxes
 * @uses    ::\spiralWebDB\Metadata\get_meta_box_keys
 * @uses    ::\spiralWebDB\Metadata\get_meta_box_id
 * @uses    ::\KnowTheCode\ConfigStore\getConfigParameter
 *
 * @group   meta-data
 */
class Tests_RegisterMetaBoxes extends Test_Case {

	public static function setUpBeforeClass() {
		parent::setUpBeforeClass();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/meta-box.php';
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_register_metaboxes( $store_keys, $data ) {
		Functions\expect( 'spiralWebDB\Metadata\get_meta_box_keys' )
			->once()
			->withNoArgs()
			->andReturn( $store_keys );

		if ( empty( $store_keys ) ) {
			Functions\expect( 'KnowTheCode\ConfigStore\getConfigParameter' )->never();
			Functions\expect( 'add_meta_box' )->never();
			Functions\expect( 'spiralWebDB\Metadata\get_meta_box_id' )->never();
		}

		foreach ( $store_keys as $store_key ) {
			$config      = $data[ $store_key ]['config'];
			$meta_box_id = $data[ $store_key ]['meta_box_id'];

			Functions\expect( '\KnowTheCode\ConfigStore\getConfigParameter' )
				->once()
				->with( $store_key, 'add_meta_box' )
				->andReturn( $config );
			Functions\expect( 'spiralWebDB\Metadata\get_meta_box_id' )
				->once()
				->with( $store_key )
				->andReturn( $meta_box_id );
			Functions\expect( 'spiralWebDB\Metadata\add_meta_box' )
				->once()
				->with(
					$meta_box_id,
					$config['title'],
					'spiralWebDB\Metadata\render_meta_box',
					$config['screen'],
					$config['context'],
					$config['priority'],
					$config['callback_args']
				)
				->andReturnNull();
		}

		register_meta_boxes();
	}

	public function addTestData() {
		return [
			[
				'store_keys' => [],
				'data'       => [],
			],
			[
				'store_keys' => [
					'meta_box.events',
				],
				'data'       => [
					'meta_box.events' => [
						'config'      => [
							'title'         => 'Events',
							'screen'        => [ 'events' ],
							'context'       => 'advanced',
							'priority'      => 'default',
							'callback_args' => null,
						],
						'meta_box_id' => 'events',
					],
				],
			],
			[
				'store_keys' => [
					'meta_box.events',
					'meta_box.tours',
				],
				'data'       => [
					'meta_box.events' => [
						'config'      => [
							'title'         => 'Events',
							'screen'        => [ 'events' ],
							'context'       => 'advanced',
							'priority'      => 'default',
							'callback_args' => null,
						],
						'meta_box_id' => 'events',
					],
					'meta_box.tours'  => [
						'config'      => [
							'title'         => 'Tours',
							'screen'        => [ 'tours' ],
							'context'       => 'advanced',
							'priority'      => 'default',
							'callback_args' => null,
						],
						'meta_box_id' => 'tours',
					],
				],
			],
		];
	}
}
