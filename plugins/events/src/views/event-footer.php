<?php
/**
 *  The single-event footer view.
 */
namespace spiralWebDb\Events;

?>
<footer class="entry-footer">
    <div class="wrap--sponsor-tel-number"><?php render_event_tel_number( $event_id ); ?></div>
    <hr>
    <div class="web-site sponsor-web-site"><?php render_event_url( $event_id ); ?></div>
    <div class="social-links sponsor-social-links">
        <div><?php render_event_facebook_link( $event_id ); ?></div>
        <div><?php render_event_twitter_link( $event_id ); ?></div>
    </div>
</footer>