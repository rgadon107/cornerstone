<?php
/**
 * Bootstraps all of the Unit Tests.
 *
 * @package     spiralWebDb\Cornerstone\Tests\Unit
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Cornerstone\Tests\Unit;

use function spiralWebDb\Cornerstone\Tests\init_test_suite;

require_once dirname( dirname( __FILE__ ) ) . '/functions.php';
init_test_suite( 'unit' );
require_once __DIR__ . '/class-test-case.php';

// Now load each of the Unit Test bootstrap files.
require_once CORNERSTONE_ROOT_DIR . '/mu-plugins/central-hub/tests/phpunit/unit/bootstrap.php';
