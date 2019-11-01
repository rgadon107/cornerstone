<?php
/**
 * Tests for the function autoload_configurations().
 *
 * @package     spiralWebDb\centralHub\Tests\Integration\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\Metadata;

use function KnowTheCode\ConfigStore\getConfig;
use function spiralWebDB\Metadata\autoload_configurations;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_AutoloadConfigurations
 *
 * @package spiralWebDb\centralHub\Tests\Integration\Metadata
 * @group   meta-data
 */
class Tests_AutoloadConfigurations extends Test_Case {

	/**
	 * Test autoload configurations() should load a metabox config from the filesystem into Config Store.
	 */
	public function test_should_load_config_from_filesystem_into_config_store() {
		autoload_configurations( [ CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-members-runtime-config.php' ] );

		$actual_config = getConfig( 'meta_box.members' );
		$this->assertArrayHasKey( 'add_meta_box', $actual_config );
		$this->assertArrayHasKey( 'custom_fields', $actual_config );
		$this->assertArrayHasKey( 'view', $actual_config );

		// Clean up.
		self::remove_from_store( 'meta_box.members' );
	}

	/**
	 * Test autoload configurations() should load the initialized custom fields configuration, i.e. missing custom
	 * field's configuration parameters are populated by the default config.
	 */
	public function test_should_load_initialized_the_custom_fields_config() {
		// Run the autoload function.
		autoload_configurations( [ CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-members-runtime-config.php' ] );

		// Get the resultant configuration from the Config Store.
		$actual_config   = getConfig( 'meta_box.members' );
		$expected_config = $this->get_expected_members_config();

		// Check that each custom fields' configuration has all of the required parameters.
		foreach ( $expected_config['custom_fields'] as $meta_key => $custom_field_config ) {
			$this->assertSame( $custom_field_config, $actual_config['custom_fields'][ $meta_key ] );
		}

		// Just to make sure, check the entire config array.
		$this->assertSame( $expected_config, $actual_config );

		// Clean up.
		self::remove_from_store( 'meta_box.members' );
	}

	/**
	 * Test autoload configurations() should load multiple config files from the filesystem into Config Store.
	 */
	public function test_should_load_multiple_config_files_from_filesystem_into_config_store() {
		autoload_configurations( [
			CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-events-runtime-config.php',
			CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-members-runtime-config.php',
		] );

		$actual_config = getConfig( 'meta_box.members' );
		$this->assertArrayHasKey( 'add_meta_box', $actual_config );
		$this->assertArrayHasKey( 'custom_fields', $actual_config );
		$this->assertArrayHasKey( 'view', $actual_config );
		$actual_config = getConfig( 'meta_box.events' );
		$this->assertArrayHasKey( 'add_meta_box', $actual_config );
		$this->assertArrayHasKey( 'custom_fields', $actual_config );
		$this->assertArrayHasKey( 'view', $actual_config );

		// Clean up.
		self::empty_the_store_by_keys( [ 'meta_box.members', 'meta_box.events' ] );
	}

	/**
	 * Test autoload configurations() should load multiple initialized custom fields configurations, i.e. missing custom
	 * field's configuration parameters are populated by the default config.
	 */
	public function test_should_load_multiple_initialized_the_custom_fields_configs() {
		autoload_configurations( [
			CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-events-runtime-config.php',
			CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/meta-box-members-runtime-config.php',
		] );

		/** Test Members Expected vs. Actual Config. **/

		// Get the resultant configuration from the Config Store.
		$actual_config   = getConfig( 'meta_box.members' );
		$expected_config = $this->get_expected_members_config();

		// Check that each custom fields' configuration has all of the required parameters.
		foreach ( $expected_config['custom_fields'] as $meta_key => $custom_field_config ) {
			$this->assertSame( $custom_field_config, $actual_config['custom_fields'][ $meta_key ] );
		}

		// Just to make sure, check the entire config array.
		$this->assertSame( $expected_config, $actual_config );

		/** Test Events Expected vs. Actual Config. **/

		// Get the resultant configuration from the Config Store.
		$actual_config   = getConfig( 'meta_box.events' );
		$expected_config = $this->get_expected_events_config();

		// Check that each custom fields' configuration has all of the required parameters.
		foreach ( $expected_config['custom_fields'] as $meta_key => $custom_field_config ) {
			$this->assertSame( $custom_field_config, $actual_config['custom_fields'][ $meta_key ] );
		}

		// Just to make sure, check the entire config array.
		$this->assertSame( $expected_config, $actual_config );

		// Clean up.
		self::empty_the_store_by_keys( [ 'meta_box.members', 'meta_box.events' ] );
	}

	/**
	 * Returns the expected members configuration array.
	 *
	 * @return array
	 */
	private function get_expected_members_config() {
		return [
			'add_meta_box'  => [
				'title'         => 'Tour Member Profile Information',
				'screen'        => [ 'members' ],
				'context'       => 'normal',
				'priority'      => 'default',
				'callback_args' => null,
			],
			'custom_fields' => [
				'residence_city'  => [
					'is_single'    => true,
					'default'      => '',
					'delete_state' => '',
					'sanitize'     => 'sanitize_text_field',
				],
				'residence_state' => [
					'is_single'    => true,
					'default'      => '',
					'delete_state' => '',
					'sanitize'     => 'sanitize_text_field',
				],
				'role'            => [
					'is_single'    => true,
					'default'      => '',
					'delete_state' => '',
					'sanitize'     => 'sanitize_text_field',
				],
				'is_active'       => [
					'is_single'    => true,
					'default'      => 0,
					'delete_state' => 0,
					'sanitize'     => 'int_val',
				],
			],
			'view'          => '',
		];
	}

	/**
	 * Returns the expected events configuration array.
	 *
	 * @return array
	 */
	private function get_expected_events_config() {
		return [
			'add_meta_box'  => [
				'title'         => 'Event Information',
				'screen'        => [ 'events' ],
				'context'       => 'advanced',
				'priority'      => 'default',
				'callback_args' => null,
			],
			'custom_fields' => [
				'event-date' => [
					'is_single'    => true,
					'default'      => '',
					'delete_state' => '',
					'sanitize'     => 'strip_tags',
				],
				'event-time' => [
					'is_single'    => true,
					'default'      => '',
					'delete_state' => '',
					'sanitize'     => 'strip_tags',
				],
				'venue-name' => [
					'is_single'    => true,
					'default'      => '',
					'delete_state' => '',
					'sanitize'     => 'sanitize_text_field',
				],
			],
			'view'          => '',
		];
	}
}
