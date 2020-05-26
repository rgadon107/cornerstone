<?php
/**
 *  The single past tour content view.
 */

namespace spiralWebDb\CornerstoneTours;

?>
<div class="past-tour past-tour-entry-content tour-<?php echo esc_attr( $tour_id ); ?>" itemprop="pastConcertTour" itemscope
     itemtype="http://schema.org/MusicEvent">
    <div class="revealer--visible">
        <span class="revealer--icon <?php echo $show_icon; ?>" aria-hidden="true"
              data-show-icon="<?php echo $show_icon; ?>"
              data-hide-icon="<?php echo $hide_icon; ?>">
            <span class="screen-reader-text">See performance locations and venues for this tour.</span>
        </span>
        <h3 class="revealer--tour-content-header" itemprop="text">See performance locations and venues for this tour.</h3>
    </div>
    <div class="revealer--hidden" itemprop="description" style="display: none;">
		<?php echo get_the_content(); ?>
    </div>
</div>
