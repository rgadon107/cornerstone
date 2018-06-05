<?php
/**
 *  The single-event footer view.
 */
namespace spiralWebDb\Events;

?>
<div class="event event-<?php echo esc_attr( $event_id ); ?>" itemprop="organizer" itemscope
     itemtype="http://schema.org/MusicEvent">
    <div class="revealer--visible">
        <div class="revealer--icon <?php echo $show_icon; ?>" aria-hidden="true"
             data-show-icon="<?php echo $show_icon; ?>"
             data-hide-icon="<?php echo $hide_icon; ?>">
            <span class="screen-reader-text">Click to reveal the event sponsor contact information.</span>
        </div>
        <h3 class="event-footer-header" itemprop="text">Sponsor Contact Information</h3>
    </div>
    <div class="revealer--hidden" itemprop="description" style="display: none;">
        <ul class="event-footer-content">
            <li class="first sponsor-tel-number" itemprop="telephone"
                itemtype="http://schema.org/ContactPoint"><?php render_event_tel_number( $event_id ); ?></li>
            <li class="web-site sponsor-web-site"><?php render_event_url( $event_id ); ?></li>
            <li class="sponsor-facebook"><?php render_event_facebook_link( $event_id ); ?></li>
            <li class="sponsor-twitter"><?php render_event_twitter_link( $event_id ); ?></li>
        </ul>
    </div>
</div>