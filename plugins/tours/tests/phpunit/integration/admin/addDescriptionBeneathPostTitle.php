<?php
/**
 * Tests for add_description_beneath_post_title().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use Brain\Monkey;
use function spiralWebDb\CornerstoneTours\add_description_beneath_post_title;

/**
 * Class Tests_AddDescriptionBeneathPostTitle
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests_AddDescriptionBeneathPostTitle extends Test_Case {

	/**
	 * Instance of the post object for each test.
	 *
	 * @var WP_Post
	 */
	protected $post;

	/**
	 * Set up each test.
	 */
	public function setUp() {
		parent::setUp();
	}

	/**
	 * Clean up the test environment after each test.
	 */
	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * Test add_description_beneath_post_title() should return empty when post type is 'post'.
	 */
	public function test_should_return_empty_when_post_type_is_post() {
		// Create and get the post ID for the 'post' post_type via factory method.
		$post_id = self::factory()->post->create();
		get_post_type( $post_id );

		$this->assertEmpty( add_description_beneath_post_title() );
	}

	/**
	 * Test add_description_beneath_post_title() should return string when post type is 'tours'.
	 */
	public function test_should_contain_string_when_post_type_is_tours() {
		// Create and get the post ID and 'tours' post_type via the factory method.
		$post_id = $this->factory()->post->create( [ 'post_type' => 'tours' ] );
		get_post_type( $post_id );

		$expected_view_html = <<<VIEW
<span class="description">Enter the theme name above for this Cornerstone tour. In the editor below, add each of the venues and locations (city, state) where Cornerstone performed on this tour. Below the editor, enter additional tour information in the box labeled "Past Tour Custom Fields".</span>
VIEW;

		// Fire the function under test and grab the HTML out of the buffer.
		ob_start();
		Monkey\Functions\when( 'get_post_type' )->justReturn( 'tours' );
		add_description_beneath_post_title();
		$actual_html = ob_get_clean();

		// Test the HTML
		$this->assertContains( $expected_view_html, $actual_html );
	}
}

