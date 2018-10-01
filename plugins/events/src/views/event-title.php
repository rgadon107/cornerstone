<?php
/**
 * The single Cornerstone event title view.
 */

namespace spiralWebDb\Events;

?>
<h1 class="entry-title event-title" itemprop="headline">
    <a href="<?php echo esc_url( get_permalink( $event_id ) ); ?>">
		<?php echo esc_html( get_the_title( $event_id ) ); ?>
    </a>
</h1>