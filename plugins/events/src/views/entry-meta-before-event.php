<?php
/**
 *  The single entry-meta-before-event view.
 */
namespace spiralWebDb\Events;

?>
<div class="entry-meta-before-content" itemprop="text" itemtype="performance-information">
    <p class="event event-date event-<?php echo esc_attr( $event_id ); ?>" itemprop="startDate startTime">
        <span class="far fa-calendar"></span><?php render_performance_date_and_time( $event_id ); ?></p>
    <p class="fas fa-map-marker"><a href="<?php render_event_map( $event_id ); ?>" class="event-address" target="_blank" itemprop="address hasMap" itemscope itemtype="http://schema.org/PostalAddress">
        <?php render_performance_address( $event_id ); ?></a></p>
    <p class="event-admission" itemprop="price" itemtype="http://schema.org/Ticket"><span class="fas fa-ticket-alt"></span><?php render_addmission_information( $event_id ); ?></p>
</div>
