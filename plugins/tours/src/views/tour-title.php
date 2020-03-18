<?php
/**
 * The single past Cornerstone tour year view.
 */

namespace spiralWebDb\CornerstoneTours;

?>
<h2 class="entry-title tour-title" itemprop="headline">
	<?php echo "Tour " . esc_html( $menu_order ) . " | " .
               esc_html( get_post_meta( $tour_id, 'tour_year', true ) ) .
               " | " . get_the_title();
	?>
</h2>
