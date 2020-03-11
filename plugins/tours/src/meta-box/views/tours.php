<?php
?>
<div class="tour-year">
    <label for="tour"><strong>Tour Year</strong></label>
    <p>
        <input id="tour-year" type="date" name="<?php echo $meta_box_id; ?>['tour-year']"
               value="<?php echo esc_attr( $custom_fields['tour-year'] ); ?>">
    </p>
    <span class="description">The year of this Cornerstone tour.</span>
</div>
<div class="tour-dates">
	<label class="description"><strong>Tour Dates</strong></label>
	<p>
		<input id="tour-dates" type="text" name="<?php echo $meta_box_id; ?>['tour-dates']"
		       value="<?php echo esc_attr( $custom_fields['tour-dates'] ); ?>">
	</p>
	<span class="description">The data range for the year of the Cornerstone tour.</span>
</div>
<div class="tour-region">
	<label class="description"><strong>Geographic Region</strong></label>
	<p>
		<input id="tour-region" type="text" name="<?php echo $meta_box_id; ?>['tour-region']"
		       value="<?php echo esc_attr( $custom_fields['tour-region'] ); ?>">
	</p>
	<span class="description">The region(s) visited during the tour (e.g. Midwest, Southeast, etc.)</span>
</div>
<div class="tour-comments">
	<label class="description"><strong>Comments About Tour</strong></label>
	<p>
		<input id="tour-comments" type="text" name="<?php echo $meta_box_id; ?>['tour-comments']"
		       value="<?php echo esc_attr( $custom_fields['tour-comments'] ); ?>">
	</p>
	<span class="description">Notable occurances during the tour (e.g. Performed at Carnegie Hall, NYC)</span>
</div>

