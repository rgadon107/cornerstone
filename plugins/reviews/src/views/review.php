<?php
/**
 *  The single review view.
 */

namespace spiralWebDb\Reviews;

?>
<aside class="pull_quote">
    <blockquote class="review review-<?php echo $review_id; ?>">
        <div class="review-content"><?php echo $content; ?></div>
        <footer>
            <p><?php render_the_venue( $review_id ); ?></p>
            <p><?php render_the_reviewer( $review_id ); ?></p>
        </footer>
    </blockquote>
</aside>