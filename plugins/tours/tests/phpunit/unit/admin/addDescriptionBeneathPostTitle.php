<?php
/**
 * Tests for add_description_beneath_post_title().
 *
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Unit
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Brain\Monkey\Functions;
use Mockery;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\add_description_beneath_post_title;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\add_description_beneath_post_title
 *
 * @group   tours
 * @group   admin
 */
class Tests_AddDescriptionBeneathPostTitle extends Test_Case {

	public static function setUpBeforeClass() {
		parent::setUpBeforeClass();

		require_once TOURS_ROOT_DIR . '/src/admin/edit-form-advanced.php';
	}

	/**
	 * @dataProvider addTestData
	 */
	public function testShouldRenderViewAsExpected( $post_type, $expected_html ) {
		$post = Mockery::mock( 'WP_Post' );
		Functions\expect( 'get_post_type' )
			->once()
			->with( $post )
			->andReturn( $post_type );

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		add_description_beneath_post_title( $post );
		$actual_html = ob_get_clean();

		// Test the HTML.
		$this->assertSame( $expected_html, $actual_html );
	}

	public function addTestData() {
		return [
			'test_should_contain_view_when_post_type_is_tours' => [
				'post_type' => 'post',
				'expected'  => '',
			],
			'test_should_contain_view_when_post_type_is_tours' => [
				'post_type' => 'tours',
				'expected'  => <<<VIEW
<span class="description">Enter the theme name above for this Cornerstone tour. In the editor below, add each of the venues and locations (city, state) where Cornerstone performed on this tour. Below the editor, enter additional tour information in the box labeled "Past Tour Custom Fields".</span>
VIEW
				,
			],
		];
	}
}
