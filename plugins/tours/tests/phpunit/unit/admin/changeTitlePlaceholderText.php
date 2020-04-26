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
 * @covers ::spiralWebDb\CornerstoneTours\change_title_placeholder_text
 *
 * @group   tours
 * @group   admin
 */
class Tests_ChangeTitlePlaceholderText extends Test_Case {

	/**
	 * Instance of the post object for each test.
	 *
	 * @var Mockery
	 */
	protected $post;

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/admin/edit-form-advanced.php';
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_render_placeholder_text_depending_on_post_type( $post_type, $view ) {
		$post = Mockery::mock( 'WP_Post' );
		Functions\expect( 'get_post_type' )
			->once()
			->with( $post )
			->andReturn( $post_type );

		ob_start();
		change_title_placeholder_text( $text, $post );
		$actual_html = ob_get_clean();

		$this->assertEquals( $expected, $actual_html );
	}

	public function addTestData() {
		return [
			'test_should_contain_default_placeholder_text_when_post_type_is_post' => [
				'post_type' => 'post',
				'expected'  => 'Add title.',
			],
			'test_should_contain_custom_placeholder_text_when_post_type_is_tours' => [
				'post_type' => 'tours',
				'expected'  => '<em>Theme of this Cornerstone tour.</em>',
			],
		];
	}
}

