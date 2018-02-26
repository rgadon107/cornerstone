<div class="event-date">
    <label for="event-date"><strong><?php _e('Performance Date', METABOX_TEXT_DOMAIN ); ?></strong></label>
    <p>
        <select id="event-day" name="<?php echo $meta_box_id; ?>[event-day]"
                value="<?php esc_attr_e( $custom_fields['event-day'] ); ?>" >
                <option>--Select a Day--</option>
                <option value="Sunday">Sunday</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
        </select>
        <input id="event-date" type="date" name="<?php echo $meta_box_id; ?>[event-date]"
               value="<?php esc_attr_e( $custom_fields['event-date'] ); ?>">
    </p>
    <span class="description"><?php _e('We\'ll use the date to allow visitors to search the event on the front end.', METABOX_TEXT_DOMAIN ); ?></span>
</div>
<div class="event-time">
    <p>
        <label for="event-time"><strong><?php _e('Performance Time', METABOX_TEXT_DOMAIN ); ?></strong></label>
    </p>
    <p>
        <input id="event-time" type="time" name="<?php echo $meta_box_id; ?>[event-time]" value="<?php esc_attr_e( $custom_fields['event-time'] ); ?>" >
    </p>
    <p>
        <span class="description">
            <?php _e('Time format (12 hours). Enter the time in \'hr:mm AM/PM\', 
            or navigate using the up/down arrows on the right side of the field.',
                METABOX_TEXT_DOMAIN ); ?></span>
    </p>
</div>
<hr>
<div class="performance-venue">
    <p>
        <label for="performance-venue"><strong><?php _e('Performance Venue', METABOX_TEXT_DOMAIN ); ?></strong></label>
    </p>
        <label for="venue-name"><?php _e('Name', METABOX_TEXT_DOMAIN ); ?></label>
    <p>
        <input id="venue-name" class="large-text" type="text"
               name="<?php echo $meta_box_id; ?>[venue-name]"
               value="<?php esc_attr_e( $custom_fields['venue-name'] ); ?>"
               placeholder="e.g. First Presbyterian Church of St. Louis">
    </p>
    <p>
        <span class="description"><?php _e('The name of the performance venue.', METABOX_TEXT_DOMAIN ); ?></span>
    </p>
</div>
<div>
    <label for="venue-address"><?php _e('Address', METABOX_TEXT_DOMAIN ); ?></label>
        <p>
            <input id="venue-address" class="large-text" type="text" name="<?php echo $meta_box_id; ?>[venue-address]"
                   value="<?php esc_attr_e( $custom_fields['venue-address'] ); ?>" placeholder="Street Address">
        </p>
        <p>
            <input id="venue-city" type="regular-text" name="<?php echo $meta_box_id; ?>[venue-city]"
                   value="<?php esc_attr_e( $custom_fields['venue-city'] ); ?>" placeholder="City">
            <select id="venue-state" name="<?php echo $meta_box_id; ?>[venue-state]"
                    value="<?php esc_attr_e( $custom_fields['venue-state'] ); ?>" >
                    <option>--Select a State--</option>
                    <option value="AL">AL - Alabama</option>
                    <option value="AK">AK - Alaska</option>
                    <option value="AR">AR - Arkansas</option>
                    <option value="AZ">AZ - Arizona</option>
                    <option value="CA">CA - California</option>
                    <option value="CO">CO - Colorado</option>
                    <option value="CT">CT - Connecticut</option>
                    <option value="DE">DE - Delaware</option>
                    <option value="DC">DC - District of Columbia</option>
                    <option value="FL">FL - Florida</option>
                    <option value="GA">GA - Georgia</option>
                    <option value="HI">HI - Hawaii</option>
                    <option value="IA">IA - Iowa</option>
                    <option value="ID">ID - Idaho</option>
                    <option value="IL">IL - Illinois</option>
                    <option value="IN">IN - Indiana</option>
                    <option value="KS">KS - Kansas</option>
                    <option value="KY">KY - Kentucky</option>
                    <option value="LA">LA - Louisiana</option>
                    <option value="MA">MA - Massachusetts</option>
                    <option value="ME">ME - Maine</option>
                    <option value="MD">MD - Maryland</option>
                    <option value="MI">MI - Michigan</option>
                    <option value="MN">MN - Minnesota</option>
                    <option value="MO">MO - Missouri</option>
                    <option value="MS">MS - Mississippi</option>
                    <option value="MT">MT - Montana</option>
                    <option value="NC">NC - North Carolina</option>
                    <option value="ND">ND - North Dakota</option>
                    <option value="NE">NE - Nebraska</option>
                    <option value="NH">NH - New Hampshire</option>
                    <option value="NJ">NJ - New Jersey</option>
                    <option value="NM">NM - New Mexico</option>
                    <option value="NV">NV - Nevada</option>
                    <option value="NY">NY - New York</option>
                    <option value="OH">OH - Ohio</option>
                    <option value="OK">OK - Oklahoma</option>
                    <option value="OR">OR - Oregon</option>
                    <option value="PA">PA - Pennsylvania</option>
                    <option value="PR">PR - Puerto Rico</option>
                    <option value="RI">RI - Rhode Island</option>
                    <option value="SC">SC - South Carolina</option>
                    <option value="SD">SD - South Dakota</option>
                    <option value="TN">TN - Tennessee</option>
                    <option value="TX">TX - Texas</option>
                    <option value="UT">UT - Utah</option>
                    <option value="VA">VA - Virginia</option>
                    <option value="VI">VI - Virgin Islands</option>
                    <option value="VT">VT - Vermont</option>
                    <option value="WA">WA - Washington</option>
                    <option value="WI">WI - Wisconsin</option>
                    <option value="WV">WV - West Virginia</option>
                    <option value="WY">WY - Wyoming</option>
            </select>
        </p>
    <span class="description"><?php _e('We\'ll use the address City and State to allow visitors to search the event on the front end.', METABOX_TEXT_DOMAIN ); ?></span>
</div>
<hr>
<div>
    <!--//START FORM BUILDING-->
    <p>
        <label for="admission"><strong><?php _e('Admission', METABOX_TEXT_DOMAIN ); ?></strong></label>
    </p>
    <p>
        <input id="admission" type="checkbox" value="1" name="<?php echo $meta_box_id; ?>[admission]" <?php checked( $custom_fields['admission'], 1 ); ?>>
        <span class="description"><?php __( 'If checked, admission will be charged for this event.', METABOX_TEXT_DOMAIN ); ?></span>
    </p>
<!--//END FORM BUILDING-->
    <p>
        <label for="regular-admission">Adult (USD): </label>
        <input id="regular-admission" type="number" name="<?php echo $meta_box_id; ?>[]" value="" placeholder="20.00" step="0.50" min="0.00">
    </p>
</div>
<hr>
<div>
    <p>
        <label for="telephone-number"><strong><?php _e('Telephone Number for Event Sponsor',
			        METABOX_TEXT_DOMAIN ); ?></strong></label>
    </p>
    <p>
        <input id="telephone-number" type="tel" name="<?php echo $meta_box_id; ?>[sponsor-tel-number]" value="<?php esc_attr_e( $custom_fields['sponsor-tel-number'] ); ?>" placeholder="###-###-####">
    </p>
    <span class="description"><?php _e('Enter 10-digit telephone number, area code first.',
		    METABOX_TEXT_DOMAIN ); ?></span>
</div>
<hr>
<div>
    <p>
        <label for="maplink-to-event-venue"><strong><?php _e('Map to Event Venue', METABOX_TEXT_DOMAIN ); ?></strong></label>
    </p>
    <p>
        <input id="maplink-to-event-venue" class="regular-text" type="url" name="<?php echo $meta_box_id; ?>[event-map-url]"
               value="<?php echo esc_url( $custom_fields['event-map-url'] ); ?>" placeholder="https://{url}">
    </p>
    <span class="description"><?php _e('Enter the URL for the event address. 
    In Google Maps, select the \'Share\' link to display the map URL, then select the \'short URL\' option. 
    Copy and paste the shortened URL to this form.',
            METABOX_TEXT_DOMAIN ); ?></span>
</div>
<hr>
<div>
    <p>
        <label for="event-venue-image"><strong><?php _e('Image of Event Venue', METABOX_TEXT_DOMAIN ); ?></strong></label>
    </p>
    <p>
        <input id="event-venue-image" class="large-text" type="url" name="<?php echo $meta_box_id; ?>[event-venue-image]"
               value="<?php echo esc_url( $custom_fields['event-venue-image'] ); ?>" placeholder="https://cornerstonechorale.org/wp-content/uploads/{yyyy}/{mm}/{filename}">
    </p>
    <span class="description"><?php _e('Upload the image of the event venue to the Media Library. 
    Then copy the image URL from the Media Library and paste it here.', METABOX_TEXT_DOMAIN ); ?></span>
</div>