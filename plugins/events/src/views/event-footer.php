<?php
/**
 *  The single-event footer view.
 */
namespace spiralWebDb\Events;

?>
<footer class="entry-footer">
    <div class="sponsor_tel-number">
        <span class="fas fa-mobile-alt" itemprop="telephone"
              itemtype="http://schema.org/ContactPoint"></span><?php render_event_tel_number( $event_id ); ?>
    </div>
    <div class="social-links sponsor-social-links">
        <div><span class="fas fa-globe" itemprop="url" itemtype="http://schema.org/WebSite"></span>
            <a href="<?php render_event_website( $event_id ); ?>" target="_blank">Web</a>
        </div>
        <div><span class="fab fa-facebook-square" itemprop="sharedContent"
                   itemtype="http://schema.org/SocialMediaPosting"></span>
            <a href="<?php render_event_facebook_link( $event_id ); ?>" target="_blank">Facebook</a>
        </div>
        <div><span class="fab fa-twitter-square" itemprop="sharedContent"
                   itemtype="http://schema.org/SocialMediaPosting"></span>
            <a href="<?php render_event_twitter_link( $event_id ); ?>" target="_blank">Twitter</a>
        </div>
    </div>
</footer>