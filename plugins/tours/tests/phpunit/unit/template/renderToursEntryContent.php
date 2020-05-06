<?php
/**
 *  Tests for render_tours_entry_content()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\CornerstoneTours\Tests\Unit
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\Template\render_tours_entry_content;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\Template\render_tours_entry_content
 *
 * @group   tours
 * @group   template
 */
class Tests_RenderToursEntryContent extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		Functions\expect( 'genesis' )->with()->andReturnNull();

		require_once TOURS_ROOT_DIR . '/src/template/single-tours.php';
	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_render_tour_entry_content_when_content_exists( $post_data, $expected ) {
		Functions\expect( 'get_the_content' )
			->with()
			->andReturn( $post_data['post_content'] );
		Functions\expect( 'get_post_type' )
			->with()
			->andReturn( $post_data['post_type'] );
		Functions\expect( 'get_the_ID' )
			->with()
			->andReturn( $post_data['tour_id'] );
		Functions\expect( 'spiralWebDb\FAQ\Asset\enqueue_script_ondemand' )
			->with()
			->andReturnNull();

		ob_start();
		render_tours_entry_content();
		$actual = ob_get_clean();

		$this->assertEquals( $expected, $actual );
	}

	public function addTestData() {
		return [
			'post content empty' => [
				'post_data'     => [
					'tour_id'      => 33,
					'post_type'    => 'tours',
					'post_content' => ''
				],
				'expected_view' => '',
			],
			'post has content'   => [
				'post_data'     => [
					'tour_id'      => 47,
					'post_type'    => 'tours',
					'post_content' => <<<POST_CONTENT_HTML
<!--Begin post content-->
<section id="table" class="past-tour">
    <header class="table-row">
        <div class="table-cell">Concert</div>
        <div class="table-cell">City</div>
        <div class="table-cell">State</div>
        <div class="table-cell">Venue</div>
    </header>
    <div class="table-row" itemprop="pastConcert" itemscope itemtype="https://schema.org/MusicEvent">
        <div class="table-cell">1</div>
        <div class="table-cell" itemprop="locationCity" itemscope itemtype="https://schema.org/MusicEvent">Topeka</div>
        <div class="table-cell" itemprop="locationState" itemscope itemtype="https://schema.org/MusicEvent">KS</div>
        <div class="table-cell" itemprop="organizer" itemscope itemtype="https://schema.org/MusicEvent">First Congregational United Church
            of Christ
        </div>
    </div>
</section>
<!--End post content-->
POST_CONTENT_HTML
					,
				],
				'expected_view' => <<<PAST_TOUR_VIEW
<div class="past-tour past-tour-entry-content tour-47" itemprop="pastConcertTour" itemscope
     itemtype="http://schema.org/MusicEvent">
    <div class="revealer--visible">
        <span class="revealer--icon dashicons dashicons-arrow-down" aria-hidden="true"
              data-show-icon="dashicons dashicons-arrow-down"
              data-hide-icon="dashicons dashicons-arrow-up">
            <span class="screen-reader-text">See performance locations and venues for this tour.</span>
        </span>
        <h3 class="revealer--tour-content-header" itemprop="text">See performance locations and venues for this tour.</h3>
    </div>
    <div class="revealer--hidden" itemprop="description" style="display: none;">
<!--Begin post content-->
<section id="table" class="past-tour">
    <header class="table-row">
        <div class="table-cell">Concert</div>
        <div class="table-cell">City</div>
        <div class="table-cell">State</div>
        <div class="table-cell">Venue</div>
    </header>
    <div class="table-row" itemprop="pastConcert" itemscope itemtype="https://schema.org/MusicEvent">
        <div class="table-cell">1</div>
        <div class="table-cell" itemprop="locationCity" itemscope itemtype="https://schema.org/MusicEvent">Topeka</div>
        <div class="table-cell" itemprop="locationState" itemscope itemtype="https://schema.org/MusicEvent">KS</div>
        <div class="table-cell" itemprop="organizer" itemscope itemtype="https://schema.org/MusicEvent">First Congregational United Church
            of Christ
        </div>
    </div>
</section>	
<!--End post content-->
	</div>
</div>
PAST_TOUR_VIEW
				,
			]
		];
	}
}

