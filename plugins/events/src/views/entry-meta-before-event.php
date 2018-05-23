<?php
/**
 *  The single entry-meta-before-event view.
 */
namespace spiralWebDb\Events;

?>
<div class="entry-meta-before-content" itemprop="text" itemtype="performance-date-">
    <p class="event event-date event-<?php echo $event_id; ?>" itemprop="startDate">
		<?php render_the_event_meta( $event_id ); ?></p>
<!--        <p></p>--><!--Performance City & State-->
<!--        <p></p>--><!--Link to Google Map to venue. Use FA fa-map-marker icon with link.-->
<!--    </p>-->