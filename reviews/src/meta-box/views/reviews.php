<p>
	<label for="location"><?php _e( 'Performance Location (City, State)', METABOX_TEXT_DOMAIN ); ?></label>
	<input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[location]" value="<?php esc_attr_e( $custom_fields['location'] ); ?>">
	<span class="description"><?php _e( 'City and State where the performance was reviewed.', METABOX_TEXT_DOMAIN ); ?></span>
</p>

<p>
	<label for="event_venue"><?php _e( 'Performance Venue', METABOX_TEXT_DOMAIN ); ?></label>
	<input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[event_venue]" value="<?php echo esc_attr_e( $custom_fields['event_venue'] ); ?>">
	<span class="description"><?php _e( 'Name of the venue where the performance was reviewed.', METABOX_TEXT_DOMAIN ); ?></span>
</p>

<p>
    <label for="audience_review"><?php _e( 'Audience Member Review?', METABOX_TEXT_DOMAIN ); ?></label></br>
    <input type="checkbox" name="<?php echo $meta_box_id; ?>[audience_review]" value="<?php echo esc_attr_e( $custom_fields['audience_review'] ); ?>">
    <span class="description"><?php _e( 'Select checkbox if this review was from a member of the audience, attending in a non-critical role.', METABOX_TEXT_DOMAIN ); ?></span>
</p>

<p>
    <label for="review_date"><?php _e( 'Date of Review', METABOX_TEXT_DOMAIN ); ?></label></br>
    <input type="date" name="<?php echo $meta_box_id; ?>[review_date]" value="<?php echo esc_attr_e( $custom_fields['review_date'] ); ?>">
    <span class="description"><?php _e( '', METABOX_TEXT_DOMAIN ); ?></span>
</p>

<p>
    <label for="reviewer_name"><?php _e( 'Name of Reviewer', METABOX_TEXT_DOMAIN ); ?></label>
    <input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[reviewer_name]" value="<?php esc_attr_e( $custom_fields['reviewer_name'] ); ?>">
    <span class="description"><?php _e( 'Enter the name of the reviewer.', METABOX_TEXT_DOMAIN ); ?></span>
</p>

<p>
    <label for="reviewer_title"><?php _e( 'Title/Role of the Reviewer', METABOX_TEXT_DOMAIN ); ?></label>
    <input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[reviewer_title]" value="<?php esc_attr_e( $custom_fields['reviewer_title'] ); ?>">
    <span class="description"><?php _e( 'Enter the reviewer\'s title or organizational role (e.g. Music Critic, Pastor, etc.).', METABOX_TEXT_DOMAIN ); ?></span>
</p>

<p>
    <label for="reviewer_org"><?php _e( 'Name of Reviewer\'s Organization', METABOX_TEXT_DOMAIN ); ?></label>
    <input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[reviewer_org]" value="<?php esc_attr_e( $custom_fields['reviewer_org'] ); ?>">
    <span class="description"><?php _e( 'Enter the name of the organization the reviewer is affiliated with (e.g. {name-of-news-organization}, {name-of-church}, etc.).', METABOX_TEXT_DOMAIN ); ?></span>
</p>