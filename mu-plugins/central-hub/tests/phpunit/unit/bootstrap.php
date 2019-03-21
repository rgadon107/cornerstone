<?php
/**
 * Bootstraps the Unit Tests.
 *
 * @package     spiralWebDb\centralHub\Tests\Unit
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit;

use function spiralWebDb\centralHub\Tests\init_test_suite;

require_once dirname( dirname( __FILE__ ) ) . '/functions.php';
init_test_suite( 'unit' );

require_once CENTRAL_HUB_TESTS_DIR . '/class-test-case.php';
