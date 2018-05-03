<?php
/**
 *  Review shortcode template file.
 */
ddd( 'Loading the Review shortcode view file.');
?>
<aside class="pull_quote">
    <blockquote>
        <h3><!--$post_title--></h3>
        <p>
            <!--$post_content-->
        </p>
        <p>
            <!--event_venue (post_meta)-->
            <!--review_location_city (post_meta)-->
            <!--reviewer_name (post_meta)-->
            <!--reviewer_org (post_meta)-->
        </p>
    </blockquote>
</aside>