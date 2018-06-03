<?php
/**
 *  The single performance address & map-link view.
 */
namespace spiralWebDb\Events;
?>
<p class="fas fa-map-marker"><a href="<?php render_event_map( $event_id ); ?>" class="event-address" target="_blank" itemprop="address hasMap" itemscope itemtype="http://schema.org/PostalAddress">
		<?php render_performance_address( $event_id ); ?></a></p>