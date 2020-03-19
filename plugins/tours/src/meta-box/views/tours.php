<?php
?>
<p class="tour-year">
    <label for="tour"><strong>Tour Year</strong></label>
    <p>
        <input id="tour_year" type="number" min="1988" name="<?php echo $meta_box_id; ?>[tour_year]"
               value="<?php echo esc_attr( $custom_fields['tour_year'] ); ?>">
    </p>
    <span class="description">The year of this Cornerstone tour.</span>
</p>
<p class="tour-region">
    <label class="description"><strong>Geographic Region</strong></label>
    <p>
        <input id="tour_region" type="text" name="<?php echo $meta_box_id; ?>[tour_region]"
               value="<?php echo esc_attr( $custom_fields['tour_region'] ); ?>">
    </p>
    <span class="description">The region(s) visited during this tour (e.g. Midwest, Southeast, etc.)</span>
</p>
<p class="tour-comments">
    <label class="description"><strong>Comments About Tour</strong></label>
    <p>
        <input id="tour_comments" class="large-text" type="text" name="<?php echo $meta_box_id; ?>[tour_comments]"
               value="<?php echo esc_attr( $custom_fields['tour_comments'] ); ?>">
    </p>
    <span class="description">Notable events ( e.g. Performance at Carnegie Hall, NYC )</span>
</p>

