<?php
/**
 * Tests for the function get_meta_box_id().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use function KnowTheCode\ConfigStore\loadConfig;
use function spiralWebDB\Metadata\get_meta_box_id;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_GetMetaBoxID
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_GetMetaBoxID extends Test_Case {

	/**
	 * Empty the store before starting these tests.
	 */
	public static function setUpBeforeClass() {
		self::empty_the_store();
	}

	// Test get_meta_box_id() should return an InvalidArgumentException when store key is empty.

	// Test get_meta_box_id() should return store key when key does not start with 'meta_box.'.

	// Test get_meta_box_id() should return the meta box id when the store key starts with 'meta_box.'.
}

