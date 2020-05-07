<?php
/**
 *  Tests for _autoload_files()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\CornerstoneTours\Tests\Integration
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\_get_plugin_directory;
use function spiralWebDb\CornerstoneTours\autoload_files;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\autoload_files
 *
 * @group   tours
 */
class Tests_AutoloadFiles extends Test_Case {

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_load_a_path_to_a_plugin_file_given_array_of_file_names( $plugin_files, $expected ) {
		$files = $plugin_files;

		foreach ( $files as $file ) {
			require _get_plugin_directory() . '/src/' . $file;
		}

		autoload_files();

		$this->assertSame( $expected, autoload_files() );
	}

	public function addTestData() {
		return [
			'plugin files and paths' => [
				'plugin_files_to_autoload' => [
					'config-loader.php',
					'meta.php',
					'plugin.php',
					'admin/edit-form-advanced.php',
					'admin/wp-list-table.php',
				],
				'expected_file_paths_to_load' => [
					require _get_plugin_directory() . '/src/' . 'config-loader.php',
					require _get_plugin_directory() . '/src/' . 'meta.php',
					require _get_plugin_directory() . '/src/' . 'plugin.php',
					require _get_plugin_directory() . '/src/' . 'admin/edit-form-advanced.php',
					require _get_plugin_directory() . '/src/' . 'admin/wp-list-table.php',
				]
			]
		];
	}
}
 