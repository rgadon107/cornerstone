<?php
/**
 *  The single-event footer view.
 */
namespace spiralWebDb\Events;

?>
<div class="entry-footer-wrap">
    <h3 class="after-entry-header" itemprop="text">Sponsor Contact Information</h3>
    <ul class="event-footer">
		<?php render_event_tel_number( $event_id ); ?>
        <li class="web-site sponsor-web-site"><?php render_event_url( $event_id ); ?></li>
        <ul class="social-links sponsor-social-links">
            <li><?php render_event_facebook_link( $event_id ); ?></li>
            <li><?php render_event_twitter_link( $event_id ); ?></li>
        </ul>
    </ul>
</div>
