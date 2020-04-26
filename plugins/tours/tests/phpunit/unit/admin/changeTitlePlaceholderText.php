<?php
/**
 * Tests for change_title_placeholder_text().
 *
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Unit
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Mockery;
use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\change_title_placeholder_text;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\change_title_placeholder_text
 *
 * @group   tours
 * @group   admin
 */
class Tests_ChangeTitlePlaceholderText extends Test_Case {

	public function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/admin/edit-form-advanced.php';
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_return_expected_html( $text, $post_data, $expected_html ) {
		$post = Mockery::mock( 'WP_Post' );
		Functions\expect( 'get_post_type' )
			->once()
			->with( $post )
			->andReturn( $post_data['post_type'] );

		$this->assertSame( $expected_html, change_title_placeholder_text( $text, $post ) );
	}

	public function addTestData() {
		return [
			[
				'text'          => 'Lorem ipsum',
				'post_data'     => [
					'post_type' => 'post',
				],
				'expected_html' => 'Lorem ipsum',
			],
			[
				'text'          => 'Lorem ipsum',
				'post_data'     => [
					'post_type' => 'events',
				],
				'expected_html' => 'Lorem ipsum',
			],
			[
				'text'          => 'Lorem ipsum',
				'post_data'     => [
					'post_type' => 'tours',
				],
				'expected_html' => <<<PLACEHOLDER
<em>Theme of this Cornerstone tour.</em>
PLACEHOLDER
				,
			],
		];
	}
}

