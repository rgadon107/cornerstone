<?php
/**
 *  The single-event sponsor view.
 */
namespace spiralWebDb\Events;

?>
<div class="event-sponsor event-<?php echo esc_attr( $event_id ); ?>" itemprop="organizer" itemscope
     itemtype="http://schema.org/MusicEvent">
    <div class="revealer--visible">
        <span class="revealer--icon <?php echo $show_icon; ?>" aria-hidden="true"
             data-show-icon="<?php echo $show_icon; ?>"
             data-hide-icon="<?php echo $hide_icon; ?>">
            <span class="screen-reader-text">Click to reveal the event sponsor contact information.</span>
        </span>
        <h3 class="sponsor-contact-info" itemprop="text">Sponsor Contact Information</h3>
    </div>
    <div class="revealer--hidden" itemprop="description" style="display: none;">
        <ul class="sponsor-contact-items">
            <?php render_event_tel_number( $event_id ); ?>
            <?php render_event_url( $event_id ); ?>
            <?php render_event_facebook_link( $event_id ); ?>
            <?php render_event_twitter_link( $event_id ); ?>
        </ul>
    </div>
</div>