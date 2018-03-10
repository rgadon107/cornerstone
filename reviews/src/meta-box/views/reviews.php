<p>
	<label for="location">Performance Location (City, State)</label>
	<input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[location]" value="<?php echo esc_attr( $custom_fields['location'] ); ?>">
	<span class="description">City and State where the performance was reviewed.</span>
</p>

<p>
	<label for="event_venue">Performance Venue</label>
	<input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[event_venue]" value="<?php echo esc_attr( $custom_fields['event_venue'] ); ?>">
	<span class="description">Name of the venue where the performance was reviewed.</span>
</p>

<p>
    <label for="audience_review">Audience Member Review?</label></br>
    <input type="checkbox" name="<?php echo $meta_box_id; ?>[audience_review]" value="<?php echo esc_attr( $custom_fields['audience_review'] ); ?>">
    <span class="description">Select checkbox if this review was from a member of the audience, attending in a non-critical role.</span>
</p>

<p>
    <label for="review_date">Date of Review</label></br>
    <input type="date" name="<?php echo $meta_box_id; ?>[review_date]" value="<?php echo esc_attr( $custom_fields['review_date'] ); ?>">
    <span class="description"></span>
</p>

<p>
    <label for="reviewer_name">Name of Reviewer</label>
    <input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[reviewer_name]" value="<?php echo esc_attr( $custom_fields['reviewer_name'] ); ?>">
    <span class="description">Enter the name of the reviewer.</span>
</p>

<p>
    <label for="reviewer_title">Title/Role of the Reviewer</label>
    <input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[reviewer_title]" value="<?php echo esc_attr( $custom_fields['reviewer_title'] ); ?>">
    <span class="description">Enter the reviewer\'s title or organizational role (e.g. Music Critic, Pastor, etc.).</span>
</p>

<p>
    <label for="reviewer_org">Name of Reviewer's Organization</label>
    <input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[reviewer_org]" value="<?php echo esc_attr( $custom_fields['reviewer_org'] ); ?>">
    <span class="description">Enter the name of the organization the reviewer is affiliated with (e.g. {name-of-news-organization}, {name-of-church}, etc.).</span>
</p>