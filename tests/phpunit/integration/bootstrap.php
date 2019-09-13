<?php
/**
 * Bootstraps the Integration Tests.
 *
 * @package     spiralWebDb\Cornerstone\Tests\Integration
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Cornerstone\Tests\Integration;

use function spiralWebDb\Cornerstone\Tests\init_test_suite;

require_once dirname( dirname( __FILE__ ) ) . '/functions.php';
init_test_suite( 'integration' );

define( 'WP_CONTENT_DIR', dirname( dirname( dirname( getcwd() ) ) ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound -- Our tests need to define this constant.

if ( ! defined( 'WP_PLUGIN_DIR' ) ) {
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . 'plugins/' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound -- When this constant is not already defined, we define it here. It's a valid use case for our testing suite.
}

if ( ! defined( 'GENESIS_THEME_DIR' ) ) {
	define( 'GENESIS_THEME_DIR', WP_CONTENT_DIR . '/themes/genesis' );
}

/**
 * Get the WordPress' tests suite directory.
 *
 * @since 1.3.0
 *
 * @return string
 */
function get_wp_tests_dir() {
	$tests_dir = getenv( 'WP_TESTS_DIR' );

	// Travis CI & Vagrant SSH tests directory.
	if ( empty( $tests_dir ) ) {
		$tests_dir = '/tmp/wordpress-tests';
	}

	// If the tests' includes directory does not exist, try a relative path to the Core tests directory.
	if ( ! file_exists( $tests_dir . '/includes/' ) ) {
		$tests_dir = '../../../../tests/phpunit';
	}

	// Check it again. If it doesn't exist, stop here and post a message as to why we stopped.
	if ( ! file_exists( $tests_dir . '/includes/' ) ) {
		trigger_error( 'Unable to run the integration tests, because the WordPress test suite could not be located.', E_USER_ERROR ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error -- Valid use case for our testing suite.
	}

	// Strip off the trailing directory separator, if it exists.
	return rtrim( $tests_dir, DIRECTORY_SEPARATOR );
}

/**
 * Bootstrap the WordPress testing environment with Genesis as the active theme and loading the Central Hub plugin.
 *
 * @since 1.3.0
 *
 * @param string $wp_tests_dir The directory path to the WordPress testing environment.
 */
function boostrap_integration_suite( $wp_tests_dir ) {
	// Give access to tests_add_filter() function.
	require_once $wp_tests_dir . '/includes/functions.php';

	tests_add_filter(
		'setup_theme',
		function() {
			register_theme_directory( dirname( GENESIS_THEME_DIR ) );
			switch_theme( basename( GENESIS_THEME_DIR ) );
		}
	);

	// Load and bootstrap all of the integration testing suites.
	bootstrap_all_integration_suites();

	// Start up the WP testing environment.
	require_once $wp_tests_dir . '/includes/bootstrap.php';

	// Load the Integration Test Case.
	require_once __DIR__ . '/class-test-case.php';
}

/**
 * Load and bootstrap all of the integration test suites.
 *
 * @since 1.3.0
 */
function bootstrap_all_integration_suites() {
	require_once CORNERSTONE_ROOT_DIR . '/mu-plugins/central-hub/tests/phpunit/integration/bootstrap.php';
	require_once CORNERSTONE_ROOT_DIR . '/plugins/cornerstone-members/tests/phpunit/integration/bootstrap.php';
	require_once CORNERSTONE_ROOT_DIR . '/plugins/events/tests/phpunit/integration/bootstrap.php';
	require_once CORNERSTONE_ROOT_DIR . '/plugins/faq/tests/phpunit/integration/bootstrap.php';
	require_once CORNERSTONE_ROOT_DIR . '/plugins/recordings/tests/phpunit/integration/bootstrap.php';
	require_once CORNERSTONE_ROOT_DIR . '/plugins/reviews/tests/phpunit/integration/bootstrap.php';
}

boostrap_integration_suite( get_wp_tests_dir() );
