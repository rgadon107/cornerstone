<?php
/**
 * Tests for change_title_placeholder_text().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\CornerstoneTours\change_title_placeholder_text;

/**
 * Class Tests_ChangeTitlePlaceholderText
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Integration
 * @group   tours
 * @group   admin
 */
class Tests_ChangeTitlePlaceholderText extends Test_Case {

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
	 * Test change_title_placeholder_text() should return the given text when post type is 'post'.
	 */
	public function test_should_return_given_text_when_post_type_is_not_tours() {
		// Create and get the post ID for the 'post' post_type via the factory method.
		$post_id = self::factory()->post->create();
		get_post_type( $post_id );
		$text = 'Add title.';

		$this->assertSame( $text, change_title_placeholder_text( $text ) );
	}

	/**
	 * Test change_title_placeholder_text() should return modified text when post type is 'tours'.
	 */
	public function test_should_return_modified_text_when_post_type_is_tours() {
		// Create and get the post ID and for the 'tours' post_type via the factory method.
		$post_id = $this->factory()->post->create( [ 'post_type' => 'tours' ] );
		get_post_type( $post_id );
		$text          = 'Add title.';
		$expected_html = <<<PLACEHOLDER
'<em>' . 'Theme of this Cornerstone tour.' . '</em>'
PLACEHOLDER;

		// Fire the function under test and grab the HTML out of the buffer.
		ob_start();
		echo change_title_placeholder_text( $text );
		$actual_html = ob_get_clean();

		// Test the HTML.
		$this->assertContains( $expected_html, $actual_html );
	}
}
