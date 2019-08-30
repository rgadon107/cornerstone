<div class="event-date">
	<label for="event-date"><strong>Performance Date</strong></label>
	<p>
		<input id="event-date" type="date" name="<?php echo $meta_box_id; ?>[event-date]" value="<?php echo esc_attr( $custom_fields['event-date'] ); ?>">
	</p>
	<span class="description">Event date description.</span>
</div>
<div class="event-time">
	<p>
		<label for="event-time"><strong>Performance Time</strong></label>
	</p>
	<p>
		<input id="event-time" type="time" name="<?php echo $meta_box_id; ?>[event-time]" value="<?php echo esc_attr( $custom_fields['event-time'] ); ?>">
	</p>
	<p>
		<span class="description">Event time description.</span>
	</p>
</div>
<hr>
<div class="performance-venue">
	<p>
		<label for="performance-venue"><strong>Performance Venue</strong></label>
	</p>
	<label for="venue-name">Name</label>
	<p>
		<input id="venue-name" class="large-text" type="text" name="<?php echo $meta_box_id; ?>[venue-name]" value="<?php echo esc_attr( $custom_fields['venue-name'] ); ?>" placeholder="e.g. First Presbyterian Church of St. Louis">
	</p>
	<p>
		<span class="description">Performance venue description.</span>
	</p>
</div>
