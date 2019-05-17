<?php
/**
 *  Tests for _string_starts_with
 *
 * @package    spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\ConfigStore;

use function KnowTheCode\ConfigStore\str_starts_with;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_StringStartsWith
 *
 * @package spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @group   config-store
 */
class Tests_StringStartsWith extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/internals.php';
	}

	/*
	 *  Test that a string starts with a character or substring.
	 */
	public function test_that_string_starts_with_a_character_or_substring() {
		$needle   = 'Hello';
		$haystack = 'Hello_world!';
		$actual   = str_starts_with( $haystack, $needle, $encoding = 'UTF-8' );

		$this->assertTrue( $actual );
		$this->assertSame( true, $actual );
	}
}

