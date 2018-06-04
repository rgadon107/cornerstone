<?php
/**
 *  The single-event footer view.
 */
namespace spiralWebDb\Events;

?>
<div class="entry-footer-wrap">
    <h3 class="after-entry-header" itemprop="text">Sponsor Contact Information</h3>
    <ul class="event-footer">
        <li class="first sponsor_tel-number" itemprop="telephone"
            itemtype="http://schema.org/ContactPoint"><?php render_event_tel_number( $event_id ); ?></li>
        <li class="web-site sponsor-web-site"><?php render_event_url( $event_id ); ?></li>
        <li class="sponsor-facebook"><?php render_event_facebook_link( $event_id ); ?></li>
        <li class="sponsor-twitter"><?php render_event_twitter_link( $event_id ); ?></li>
    </ul>
</div>