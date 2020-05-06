<?php
/**
 *  Tests for render_tours_entry_content()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\CornerstoneTours\Tests\Integration
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\FAQ\Asset\enqueue_script_ondemand;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\Template\render_tours_entry_content
 *
 * @group tours
 * @group template
 */
class Test_RenderToursEntryContent extends Test_Case {

//	public function test_should_return_priority_when_action_event_fires() {
//		$this->assertTrue( 10, has_action( 'genesis_entry_content', 'spiralWebDb\CornerstoneTours\Template\render_tours_entry_content' ) );
//	}

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_render_tour_entry_content_when_content_exists( $post_data, $expected ) {
		$this->tour_id = $this->factory->post->create( $post_data );

		get_the_ID();
		enqueue_script_ondemand();
		$this->go_to( '?tours=to-see-the-earth-as-it-truly-is');

		ob_start();
		do_action( 'genesis_entry_content' );
		$actual = ob_get_clean();

		$this->assertSame( $expected, $actual );
	}

	public function addTestData() {
		return [
			'content empty'     => [
				'post_data'     => [
					'post_type'    => 'tours',
					'post_title'   => 'I Make All Things New',
					'post_content' => '',
				],
				'expected_view' => '',
			],
			'past tour content' => [
				'post_data'     => [
					'post_type'    => 'tours',
					'post_title'   => 'To See The Earth As It Truly Is',
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
<div class="past-tour past-tour-entry-content tour-<?php echo esc_attr( $this->tour_id ); ?>" itemprop="pastConcertTour" itemscope
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
			],
		];
	}
}

