<?php
/**
 * The postmeta for the single tour view.
 */

namespace spiralWebDb\CornerstoneTours;
?>
<h3 class="tour-post-meta">
    <p><em class="tour-region">Region: <?php render_the_tour_regions( $tour_id ); ?></em></p>
	<?php if ( empty( get_post_meta( $tour_id, 'tour_comments', true ) ) ):
		return;
	else: ?>
        <p class="tour-comments"><em>Note: <?php render_tour_comments( $tour_id ); ?></em></p>
	<?php endif ?>
</h3>