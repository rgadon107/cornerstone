<?php
/**
 * Tests for the function save_custom_fields().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\Metadata;

use Brain\Monkey;
use function spiralWebDB\Metadata\save_custom_fields;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_SaveCustomFields
 *
 * @package spiralWebDb\centralHub\Tests\Unit\Metadata
 * @group   meta-data
 */
class Tests_SaveCustomFields extends Test_Case {

	/**
	 * Prepare the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/meta-box.php';
	}

	/**
	 * Test save_custom_fields() should merge config defaults into $_POST when using wp_parse_args().
	 */
	public function test_should_merge_config_defaults_into_POST_array_when_using_wp_parse_args() {

	}

	/**
	 * Test save_custom_fields() should delete post meta key when it’s value equals the config delete state.
	 */
	public function test_should_delete_post_meta_key_when_value_equals_the_config_delete_state() {

	}

	/**
	 * Test save_custom_fields() should sanitize a post meta value when that value will be updated.
	 */
	public function test_should_sanitize_custom_field_value_when_the_value_will_be_updated() {

	}

	/**
	 * Test save_custom_fields() should update a post meta value when it does not equal the delete state value.
	 */
	public function test_should_update_post_meta_value_when_value_does_not_equal_delete_state() {

	}
}

