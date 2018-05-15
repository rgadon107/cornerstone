<?php
/**
 *  The single review view.
 */

namespace spiralWebDb\Reviews;

?>
<aside class="pull_quote">
    <blockquote class="review review-<?php echo $review_id; ?>">
        <div class="review-content"><?php echo $content; ?></div>
        <?php include __DIR__ . '/review-footer.php'; ?>
    </blockquote>
</aside>