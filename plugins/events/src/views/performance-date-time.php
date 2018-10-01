<?php
/**
 *  The single performance date and time view.
 */
namespace spiralWebDb\Events;
?>
<p class="event event-date event-<?php echo esc_attr( $event_id ); ?>" itemprop="startDate startTime">
	<span class="far fa-calendar"></span><?php render_performance_date_and_time( $event_id ); ?></p>