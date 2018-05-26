<?php
/**
 *  The single-event footer view.
 */
namespace spiralWebDb\Events;

?>
<ul>
    <li class="tel-number sponsor-tel-number"><?php render_event_tel_number( $event_id ); ?></li>
    <hr>
    <li class="web-site sponsor-web-site"><?php render_event_url( $event_id ); ?></li>

    <ul class="social-links sponsor-social-links">
        <li><?php render_event_facebook_link( $event_id ); ?></li>
        <li><?php render_event_twitter_link( $event_id ); ?></li>
    </ul>
</ul>
