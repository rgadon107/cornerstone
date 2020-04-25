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

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/meta-box.php';
	}

	/*
	 * Test register_meta_boxes() will add a meta box for each store key that starts with 'metabox.'.
	 */
	function test_function_will_add_a_meta_box_for_each_store_key_that_starts_with_metabox() {
		$config = [
			'title'         => 'Events',
			'screen'        => [ 'events' ],
			'context'       => 'advanced',
			'priority'      => 'default',
			'callback_args' => null,
		];

		Functions\expect( 'spiralWebDB\Metadata\get_meta_box_keys' )
			->once()
			->withNoArgs()
			->andReturn( [ 'meta_box.events' ] );
		Functions\expect( 'KnowTheCode\ConfigStore\getConfigParameter' )
			->once()
			->with( 'meta_box.events', 'add_meta_box' )
			->andReturn( $config );
		Functions\expect( 'spiralWebDB\Metadata\get_meta_box_id' )
			->once()
			->with( 'meta_box.events' )
			->andReturn( 'events' );
		Functions\expect( 'spiralWebDB\Metadata\add_meta_box' )
			->once()
			->with(
				'events',
				$config['title'],
				'spiralWebDB\Metadata\render_meta_box',
				$config['screen'],
				$config['context'],
				$config['priority'],
				$config['callback_args']
			)
			->andReturnNull();

		register_meta_boxes();
	}

	/*
	 * Test register_meta_boxes() returns null when no store key starts with 'metabox.'.
	 */
	public function test_function_should_return_null_when_no_store_key_starts_with_metabox() {
		Functions\expect( 'spiralWebDB\Metadata\get_meta_box_keys' )
			->once()
			->withNoArgs()
			->andReturn( [] );

		Functions\expect( 'KnowTheCode\ConfigStore\getConfigParameter' )->never();
		Functions\expect( 'add_meta_box' )->never();
		Functions\expect( 'spiralWebDB\Metadata\get_meta_box_id' )->never();

		register_meta_boxes();
	}
}
