<?php

use KnowTheCode\ConfigStore;

?>
<div>
    <label for="review_location"><strong>Performance Location</strong></label>
    <div>
        <input class="regular-text" type="text" placeholder="City" name="<?php echo $meta_box_id; ?>[review_location_city]" value="<?php echo esc_attr( $custom_fields['review_location_city'] ); ?>">
        <select name="<?php echo $meta_box_id; ?>[review_location_state]" value="<?php echo esc_attr( $custom_fields['review_location_state'] ); ?>" >
            <option>--Select a State--</option>
            <?php foreach( ConfigStore\getConfig( $config['states'] ) as $state_id => $state_name ) : ?>
                <option value="<?php echo esc_attr( $state_id ); ?>"<?php selected( $custom_fields['review_location_state'], $state_id ); ?>><?php echo esc_html( $state_name ); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
        <span class="description">City and State where the performance was reviewed.</span>
</div>
<div>
    <p>
        <label for="event_venue"><strong>Performance Venue</strong></label>
        <input class="large-text" type="text" placeholder="e.g. St. Mark's Episcopal Church" name="<?php echo $meta_box_id; ?>[event_venue]" value="<?php echo esc_attr( $custom_fields['event_venue'] ); ?>">
        <span class="description">Name of the venue where the performance was reviewed.</span>
    </p>
</div>
<div>
<p>
    <label for="audience_review"><strong>Audience Member Review?</strong></label></br>
    <input type="checkbox" name="<?php echo $meta_box_id; ?>[audience_review]" value="<?php echo esc_attr( $custom_fields['audience_review'] ); ?>">
    <span class="description">Select checkbox if this review was from an audience member (not a music critic affiliated with a news or arts organization).</span>
</p>
</div>
<div>
    <p>
        <label for="review_date"><strong>Date of Review</strong></label></br>
        <input type="date" name="<?php echo $meta_box_id; ?>[review_date]" value="<?php echo esc_attr( $custom_fields['review_date'] ); ?>">
        <span class="description"></span>
    </p>
</div>
<div>
    <p>
        <label for="reviewer_name"><strong>Name of Reviewer</strong></label>
        <input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[reviewer_name]" value="<?php echo esc_attr( $custom_fields['reviewer_name'] ); ?>">
        <span class="description">Enter the name of the reviewer.</span>
    </p>
</div>
<div>
    <p>
        <label for="reviewer_title"><strong>Title/Role of the Reviewer</strong></label>
        <input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[reviewer_title]" value="<?php echo esc_attr( $custom_fields['reviewer_title'] ); ?>">
        <span class="description">Enter the reviewer's title or organizational role (e.g. Music Critic, Pastor, etc.).</span>
    </p>
</div>
<div>
    <p>
        <label for="reviewer_org"><strong>Name of Reviewer's Organization</strong></label>
        <input class="large-text" type="text" name="<?php echo $meta_box_id; ?>[reviewer_org]" value="<?php echo esc_attr( $custom_fields['reviewer_org'] ); ?>">
        <span class="description">Enter the name of the organization the reviewer is affiliated with (e.g. {name-of-news-organization}, {name-of-church}, etc.).</span>
    </p>
</div>