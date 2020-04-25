<?php
/**
 * Tests for add_description_beneath_post_title().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
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

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/admin/edit-form-advanced.php';
	}

	/**
	 * Test add_description_beneath_post_title() should npt contain view when the post type is 'post'.
	 */
	public function test_should_not_contain_view_when_post_type_is_post() {
		$post = Mockery::mock( 'WP_Post' );
		Functions\expect( 'get_post_type' )
			->once()
			->with( $post )
			->andReturn( 'post' );

		$view_html = <<<VIEW
<span class="description">Enter the theme name above for this Cornerstone tour. In the editor below, add each of the venues and locations (city, state) where Cornerstone performed on this tour. Below the editor, enter additional tour information in the box labeled "Past Tour Custom Fields".</span>
VIEW;

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		add_description_beneath_post_title( $post );
		$actual_html = ob_get_clean();

		$this->assertEmpty( $actual_html );
		$this->assertNotContains( $view_html, $actual_html );
	}

	/**
	 * Test add_description_beneath_post_title() should contain view when the post type is 'tours'.
	 */
	public function test_should_contain_view_when_post_type_is_tours() {
		$post = Mockery::mock( 'WP_Post' );
		Functions\expect( 'get_post_type' )
			->once()
			->with( $post )
			->andReturn( 'tours' );

		$view_html = <<<VIEW
<span class="description">Enter the theme name above for this Cornerstone tour. In the editor below, add each of the venues and locations (city, state) where Cornerstone performed on this tour. Below the editor, enter additional tour information in the box labeled "Past Tour Custom Fields".</span>
VIEW;

		// Fire the rendering function and grab the HTML out of the buffer.
		ob_start();
		add_description_beneath_post_title( $post );
		$actual_html = ob_get_clean();

		// Test the HTML.
		$this->assertSame( $view_html, $actual_html );
	}
}
