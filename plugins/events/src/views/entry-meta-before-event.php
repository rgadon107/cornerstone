<?php
/**
 *  The single entry-meta-before-event view.
 */
namespace spiralWebDb\Events;

?>
<div class="entry-meta-before-content" itemprop="text" itemtype="performance-information">
    <p class="event event-date event-<?php echo $event_id; ?>" itemprop="startDate">
		<span class="far fa-calendar"></span><?php render_performance_date_and_time( $event_id ); ?></p>
    <p class="event-address" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress"><?php render_performance_address( $event_id ); ?></p>
    <p class="event-map" itemprop="hasMap"><span class="fas fa-map-marker"></span><a itemprop="map" itemtype="https://schema.org/Map" href="<?php render_event_map( $event_id ); ?>" target="_blank">Google Map</a></p>
</div>