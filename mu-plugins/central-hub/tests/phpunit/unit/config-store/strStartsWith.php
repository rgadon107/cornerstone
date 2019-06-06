<?php
/**
 *  Tests for str_starts_with()
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
	 *  Test should return true when substring starts with and matches haystack.
	 */
	public function test_should_return_true_when_substring_starts_with() {
		$this->assertTrue( str_starts_with( 'Hello World!', 'Hello' ) );
		$this->assertTrue( str_starts_with( 'Hello World!', 'H' ) );
		$this->assertTrue( str_starts_with( 'Cornerstone', 'Corner' ) );
	}

	/**
	 * Test should return false when substring does not start with & match haystack.
	 */
	public function test_should_return_false_when_substring_does_not_start() {
		$this->assertFalse( str_starts_with( 'Hello World', 'World' ) );
		$this->assertFalse( str_starts_with( 'Hello World', 'hey!' ) );
		$this->assertFalse( str_starts_with( 'Cornerstone', 'cor' ) );
		$this->assertFalse( str_starts_with( 'Cornerstone', 'stone' ) );
	}

	/**
	 * Test should throw exception when string length ($haystack or $needle) is empty.
	 */
	public function test_should_throw_exception_when_string_is_empty() {
		$this->expectException( \InvalidArgumentException::class );
		$this->expectExceptionMessage(
			'The haystack and needle cannot be empty. Given: haystack [Cornerstone] and needle of [].'
		);

		str_starts_with( 'Cornerstone', '' );

		$this->expectException( \InvalidArgumentException::class );
		$this->expectExceptionMessage(
			'The haystack and needle cannot be empty. Given: haystack [] and needle of [WordPress].'
		);

		str_starts_with( '', 'WordPress' );

		$this->expectException( \InvalidArgumentException::class );
		$this->expectExceptionMessage(
			'The haystack and needle cannot be empty. Given: haystack [] and needle of [].'
		);

		str_starts_with( '', '' );
	}
}

