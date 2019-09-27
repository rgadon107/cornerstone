<?php
/**
 * Tests for the function is_okay_to_save_meta_box().
 *
 * @package     spiralWebDb\centralHub\Tests\Integration\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use function spiralWebDB\Metadata\is_okay_to_save_meta_box;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_IsOkayToSaveMetaBox
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_IsOkayToSaveMetaBox extends Test_Case {

	/**
	 * Clean up the test environment after each test.
	 */
	public function tearDown() {
		$_POST = [];
	}

	/**
	 * Test is_okay_to_save_meta_box() should check the meta box key exists in the $_POST array.
	 */
	public function test_should_return_false_when_meta_box_key_is_not_in_POST() {
		$_POST = [
			'post_ID'           => '1322',
			'post_status'       => 'publish',
			'events'            => [
				'event-date' => '09-24-2019',
				'event-time' => '17:30',
				'venue-name' => 'Ladue Chapel',
			],
			'events_nonce_name' => wp_create_nonce( 'events_nonce_action' ),
		];

		$this->assertArrayNotHasKey( 'members', $_POST );
		$this->assertFalse( is_okay_to_save_meta_box( 'members' ) );
	}

	/*
    * Test should return false when meta box nonce name key is not set in $_POST.
    */
	public function test_should_return_false_when_meta_box_nonce_name_key_is_not_set_in_POST() {
		$_POST = [
			'post_ID'     => '1322',
			'post_status' => 'publish',
			'_wp_nonce'   => '04c923a55d',
		];

		$this->assertArrayNotHasKey( 'events_nonce_name', $_POST );
		$this->assertFalse( is_okay_to_save_meta_box( 'events' ) );
	}

	/*
    * Test is_okay_to_save_meta_box() should return true when wp_verify_nonce() returns boolean ( 1 or 2 ).
    */
	public function test_should_return_true_when_wp_verify_nonce_returns_boolean() {
		$_POST = [
			'post_ID'           => '1322',
			'post_status'       => 'publish',
			'events'            => [
				'event-date' => '09-24-2019',
				'event-time' => '17:30',
				'venue-name' => 'Ladue Chapel',
			],
			'events_nonce_name' => wp_create_nonce( 'events_nonce_action' ),
		];
		
		$this->assertSame( 1, wp_verify_nonce( $_POST['events_nonce_name'], 'events_nonce_action' ) );
		$this->assertTrue( is_okay_to_save_meta_box( 'events' ) );
		$this->assertEquals( 0, did_action( 'wp_verify_nonce_failed' ) );
	}
}
