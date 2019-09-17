<?php
/**
 * Tests for the function save_meta_boxes().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use function KnowTheCode\ConfigStore\loadConfig;
use function spiralWebDB\Metadata\get_meta_box_keys;
use function spiralWebDB\Metadata\get_meta_box_id;
use function KnowTheCode\ConfigStore\getConfigParameter;
use function spiralWebDB\Metadata\save_meta_boxes;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_SaveMetaBoxes
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_SaveMetaBoxes extends Test_Case {

	/**
	 * Instance of the post for each test.
	 *
	 * @var WP_Post
	 */
	protected $post;

	/**
	 * Empty the store before starting these tests.
	 */
	public static function setUpBeforeClass() {
		self::empty_the_store();
	}

	/**
	 * Set up each test.
	 */
	public function setUp() {
		parent::setUp();

		// Create and get the post object via the factory method.
		$this->post     = self::factory()->post->create_and_get();
		$this->post->ID = 19;
	}

	/**
	 * Test save_meta_boxes() should check whether okay to save meta box and custom fields.
	 */
	public function test_function_should_check_whether_okay_to_save_meta_box_and_custom_fields() {

		$configs = [
			'meta_box.members' => [
				'custom_fields' => [
					'role'            => 'Soprano',
					'residence_city'  => 'Chicago',
					'residence_state' => 'IL',
					'tour_number'     => '3',
				],
			],
		];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}
		$expected             = [ 0 => 'meta_box.members' ];
		$meta_box_key         = 'members';
		$custom_fields_config = $configs['meta_box.members']['custom_fields'];

		$this->assertSame( $expected, get_meta_box_keys() );
		$this->assertSame( $meta_box_key, get_meta_box_id( 'meta_box.members' ) );
		$this->assertSame( $custom_fields_config, getConfigParameter( 'meta_box.members', 'custom_fields' ) );
		$this->assertNull( save_meta_boxes( 19 ) );

		// Clean up.
		self::empty_the_store( $configs );
	}

	/**
	 * Test save_meta_boxes() should return null when store key does not start with `meta_box.`.
	 */
	public function test_function_returns_null_when_store_key_does_not_start_with_meta_box() {

		$configs = [
			'taxonomy.roles'         => [
				'Soprano' => 'Soprano (vocalist)',
			],
			'shortcode.qa'           => [
				'Question 1' => 'How many angels can dance on the head of a pin?',
			],
			'custom_post_type.books' => [
				'Title' => 'To Kill a Mockingbird',
			],
			'metabox.notametabox'    => [
				'add_meta_box' => [
					'id'     => 'notametabox',
					'title'  => 'Does not start with the right meta_box. structure',
					'screen' => [ 'notametabox' ],
				],
			],
		];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}
		$expected = [];

		$this->assertSame( $expected, get_meta_box_keys() );
		$this->assertNull( save_meta_boxes( 192 ) );

		// Clean up.
		self::empty_the_store( $configs );
	}

	/**
	 * Test save_meta_boxes() should return null when meta box config is empty.
	 */
	public function test_function_should_return_null_when_meta_box_config_is_empty() {

		$configs = [];
		foreach ( $configs as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}
		$expected = [];

		$this->assertSame( $expected, get_meta_box_keys() );
		$this->assertNull( save_meta_boxes( 373 ) );

		// Clean up.
		self::empty_the_store( $configs );
	}
}
