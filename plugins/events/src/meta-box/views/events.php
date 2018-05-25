<?php

use KnowTheCode\ConfigStore;

?>
<div class="event-date">
    <label for="event-date"><strong>Performance Date</strong></label>
    <p>
        <input id="event-date" type="date" name="<?php echo $meta_box_id; ?>[event-date]"
               value="<?php echo esc_attr( $custom_fields['event-date'] ); ?>">
    </p>
    <span class="description">We'll use the date to allow visitors to search the event on the front end.</span>
</div>
<div class="event-time">
    <p>
        <label for="event-time"><strong>Performance Time</strong></label>
    </p>
    <p>
        <input id="event-time" type="time" name="<?php echo $meta_box_id; ?>[event-time]"
               value="<?php echo esc_attr( $custom_fields['event-time'] ); ?>">
    </p>
    <p>
        <span class="description">Time format (12 hours). Enter the time in "hr:mm AM/PM",  or navigate using the up/down arrows on the right side of the field.</span>
    </p>
</div>
<hr>
<div class="performance-venue">
    <p>
        <label for="performance-venue"><strong>Performance Venue</strong></label>
    </p>
    <label for="venue-name">Name</label>
    <p>
        <input id="venue-name" class="large-text" type="text" name="<?php echo $meta_box_id; ?>[venue-name]"
               value="<?php echo esc_attr( $custom_fields['venue-name'] ); ?>"
               placeholder="e.g. First Presbyterian Church of St. Louis">
    </p>
    <p>
        <span class="description">The name of the performance venue.</span>
    </p>
</div>
<div>
    <label for="venue-address">Address</label>
    <p>
        <input id="venue-address" class="large-text" type="text" name="<?php echo $meta_box_id; ?>[venue-address]"
               value="<?php echo esc_attr( $custom_fields['venue-address'] ); ?>" placeholder="Street Address">
    </p>
    <p>
        <input id="venue-city" class="regular-text" type="text" placeholder="City"
               name="<?php echo $meta_box_id; ?>[venue-city]"
               value="<?php echo esc_attr( $custom_fields['venue-city'] ); ?>">
        <select id="venue-state" name="<?php echo $meta_box_id; ?>[venue-state]"
                value="<?php echo esc_attr( $custom_fields['venue-state'] ); ?>">
            <option>--Select a State--</option>
			<?php foreach ( ConfigStore\getConfig( $config['states'] ) as $state_id => $state_name ) : ?>
                <option value="<?php echo esc_attr( $state_id ); ?>"<?php selected( $custom_fields['venue-state'], $state_id ); ?>><?php echo esc_html( $state_name ); ?></option>
			<?php endforeach; ?>
        </select>
    </p>
    <span class="description">We'll use the address City and State to allow visitors to search the event on the front end.</span>
</div>
<hr>
<div>
    <p>
        <label for="admission"><strong>Admission</strong></label>
    </p>
    <p>
        <input id="admission" type="checkbox" value="1"
               name="<?php echo $meta_box_id; ?>[admission]" <?php checked( $custom_fields['admission'], 1 ); ?>>
        <span class="description">If checked, admission will be charged for this event.</span>
    </p>
    <p>
        <label for="regular-admission">Adult (USD): </label>
        <input id="regular-admission" type="number" name="<?php echo $meta_box_id; ?>[regular-admission]"
               value="<?php echo esc_attr( $custom_fields['regular-admission'] ); ?>" placeholder="20.00" step="0.50"
               min="0.00">
    </p>
</div>
<hr>
<div>
    <p>
        <label for="sponsor-website"><strong>Web Address (URL) for Event Sponsor</strong></label>
    </p>
    <p>
        <input id="sponsor-website" class="regular-text" type="url" name="<?php echo $meta_box_id; ?>[sponsor-website]"
               value="<?php echo esc_attr( $custom_fields['sponsor-website'] ); ?>" placeholder="https://{url}">
    </p>
    <span class="description">Enter the web address (URL) for the sponsoring organization in the field above.</span>
    <p>
    <p>
        <label for="sponsor-facebook"><strong>Facebook web address (URL) for the Event Sponsor</strong></label>
    </p>
    <p>
        <input id="sponsor-facebook" class="regular-text" type="url"
               name="<?php echo $meta_box_id; ?>[sponsor-facebook]"
               value="<?php echo esc_attr( $custom_fields['sponsor-facebook'] ); ?>"
               placeholder="https://www.facebook.com/{name-of-organization}">
    </p>
    <span class="description">Enter the sponsoring organization's Facebook URL in the field above.</span>
    </p>
    <p>
        <label for="sponsor-twitter"><strong>Twitter handle for the Event Sponsor</strong></label>
    </p>
    <p>
        <input id="sponsor-twitter" class="regular-text" type="text" name="<?php echo $meta_box_id; ?>[sponsor-twitter]"
               value="<?php echo esc_attr( $custom_fields['sponsor-twitter'] ); ?>" placeholder="@{twitter-handle}">
    </p>
    <span class="description">If the sponsor has a Twitter account, add their 'handle' in the field above. The account name is preceded by an '@' symbol.</span>
    <hr>
    <label for="telephone-number"><strong>Telephone Number for Event Sponsor</strong></label>
    </p>
    <input id="telephone-number" type="tel" name="<?php echo $meta_box_id; ?>[sponsor-tel-number]"
           value="<?php echo esc_attr( $custom_fields['sponsor-tel-number'] ); ?>" placeholder="###-###-####">
    </p>
    <span class="description">Enter 10-digit telephone number, area code first.</span>
</div>
<hr>
<div>
    <p>
        <label for="maplink-to-event-venue"><strong>Map to Event Venue</strong></label>
    </p>
    <p>
        <input id="maplink-to-event-venue" class="regular-text" type="url"
               name="<?php echo $meta_box_id; ?>[event-map-url]"
               value="<?php echo esc_url( $custom_fields['event-map-url'] ); ?>" placeholder="https://{url}">
    </p>
    <span class="description">Enter the URL for the event address. In Google Maps, select the "Share" link to display the map URL, then select the "short URL" option.  Copy and paste the shortened URL to this form.</span>
</div>
<hr>
<div>
    <p>
        <label for="venue-image"><strong>Image of Event Venue</strong></label>
    </p>
    <p>
        <input id="venue-image" class="large-text" type="url"
               name="<?php echo $meta_box_id; ?>[venue-image]"
               value="<?php echo esc_url( $custom_fields['venue-image'] ); ?>"
               placeholder="https://cornerstonechorale.org/wp-content/uploads/{yyyy}/{mm}/{filename}">
    </p>
    <span class="description">Upload the image of the event venue to the Media Library. Then copy the image URL from the Media Library and paste it here.</span>
</div>