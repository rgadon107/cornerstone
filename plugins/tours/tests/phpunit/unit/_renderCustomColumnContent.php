<?php
/**
 * Tests for _render_custom_column_content().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Mockery as m;
use Brain\Monkey;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\_render_custom_column_content;

/**
 * Class Tests_RenderCustomColumnContent
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Unit
 * @group   tours
 * @group   admin
 */
class Tests_RenderCustomColumnContent extends Test_Case {

	/**
	 * Instance of the post object for each test.
	 *
	 * @var Mockery
	 */
	protected $post;

	/**
	 * The post ID
	 *
	 * @var integer
	 */
	protected $ID;

	/**
	 * The post type
	 *
	 * @var string
	 */
	protected $post_type;

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/admin/wp-list-table.php';

		$this->post = m::mock( 'post' );
		$this->post->ID = (int) 99;
		$this->post->post_type = 'tours';
	}

	/**
	 *  Test _render_custom_column_content() should echo 'tour_id' when evaluating $column_name.
	 */
	public function test_should_echo_tour_id_when_evaluating_column_name() {
		Monkey\Functions\expect( '_render_custom_column_content' )
			->once()
			->with( 'column_name', 'tour_id' )
			->andReturn( 99 );
		$expected = $this->post->ID;

		$this->assertNotNull( _render_custom_column_content( $column_name, $this->post->ID ) );
	}
}

