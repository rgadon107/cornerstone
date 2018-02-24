<div>
    <label for="event-date"><strong>Performance Date</strong></label>
    <p>
        <select>
            <optgroup label="Day of the week">
                <option>Sunday</option>
                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
            </optgroup>
        </select>
        <input id="event-date" type="date">
    </p>
    <span class="description">We'll use the date to allow visitors to search the event on the front end.</span>
</div>
<div class="event-time">
    <p>
        <label for="event-time"><strong>Performance Time</strong></label>
    </p>
    <p>
        <input id="event-time" type="time" name="" value="12:00">
    </p>
    <p>
        <span class="description">Time format (12 hours). Overwrite the default value, or navigate using the up/down arrows.</span>
    </p>
</div>
<!--Escape input with 'esc_attr()'-->
<hr>
<!--Event location (City, State); make these separate fields so that they may be searched-->
<!--<p>-->
<!--<label><strong>Event Location: </strong></label>-->
<!--<input type="text" placeholder="City"><input type="text" placeholder="State">-->
<!--</p>-->
<!--Escape input with 'esc_attr()'-->
<div>
    <p>
        <label><strong>Performance Venue</strong></label>
    </p>
        <label for="venue-name">Name</label>
    <p>
        <input id="venue-name" class="large-text" type="text" name="" placeholder="e.g. First Presbyterian Church of St. Louis">
    <p>
        <span class="description">The name of the performance venue.</span>
    </p>
    </p>
</div>
<!--Escape input with 'esc_attr()'-->
<div>
    <label for="venue-address">Address</label>
        <p>
            <input id="venue-address" class="large-text" type="text" name="" placeholder="Street Address">
        </p>
        <p>
            <input id="venue-city" type="regular-text" name="" placeholder="City" max>
            <select>
                <optgroup id="venue-state" label="Select a State">
                    <option>AL - Alabama</option>
                    <option>AK - Alaska</option>
                    <option>AR - Arkansas</option>
                    <option>AZ - Arizona</option>
                    <option>CA - California</option>
                    <option>CO - Colorado</option>
                    <option>CT - Connecticut</option>
                    <option>DE - Delaware</option>
                    <option>DC - District of Columbia</option>
                    <option>FL - Florida</option>
                    <option>GA - Georgia</option>
                    <option>HI - Hawaii</option>
                    <option>IA - Iowa</option>
                    <option>ID - Idaho</option>
                    <option>IL - Illinois</option>
                    <option>IN - Indiana</option>
                    <option>KS - Kansas</option>
                    <option>KY - Kentucky</option>
                    <option>LA - Louisiana</option>
                    <option>MA - Massachusetts</option>
                    <option>ME - Maine</option>
                    <option>MD - Maryland</option>
                    <option>MI - Michigan</option>
                    <option>MN - Minnesota</option>
                    <option>MO - Missouri</option>
                    <option>MS - Mississippi</option>
                    <option>MT - Montana</option>
                    <option>NC - North Carolina</option>
                    <option>ND - North Dakota</option>
                    <option>NE - Nebraska</option>
                    <option>NH - New Hampshire</option>
                    <option>NJ - New Jersey</option>
                    <option>NM - New Mexico</option>
                    <option>NV - Nevada</option>
                    <option>NY - New York</option>
                    <option>OH - Ohio</option>
                    <option>OK - Oklahoma</option>
                    <option>OR - Oregon</option>
                    <option>PA - Pennsylvania</option>
                    <option>PR - Puerto Rico</option>
                    <option>RI - Rhode Island</option>
                    <option>SC - South Carolina</option>
                    <option>SD - South Dakota</option>
                    <option>TN - Tennessee</option>
                    <option>TX - Texas</option>
                    <option>UT - Utah</option>
                    <option>VA - Virginia</option>
                    <option>VI - Virgin Islands</option>
                    <option>VT - Vermont</option>
                    <option>WA - Washington</option>
                    <option>WI - Wisconsin</option>
                    <option>WV - West Virginia</option>
                    <option>WY - Wyoming</option>
                </optgroup>
            </select>
        </p>
    <span class="description">We'll use the address City and State to allow visitors to search the event on the front end.</span>
</div>
<hr>
<!--Escape input with 'esc_attr()'-->
<div>
    <p>
        <label><strong>Admission</strong></label>
    </p>
    <p>
        <label for="regular-admission">Adult (USD): </label>
        <input id="regular-admission" type="number" name="" placeholder="20.00" step="0.50" min="0.00">
    </p>
</div>
<!--// We need a checkbox-->
<!--// Default value = unchecked-->
<!--// If the checkbox is 'checked' (value == 1), then render the label, input, and description for-->
<!--// for the children's admission-->
<div>
    <p>
        <label for="children-admission">Reduced admission for children?</label>
        <!--Check lab notes on how to pass this variable into the 'name' attribute.-->
        <input type="checkbox" name="<?php $children; ?>" value="1" <?php checked( $options['postlink'], 1 ); ?> >
    </p>

	    <?php
	    if ( $children == true ) {
		    ?>
            <p>
                <label for=“child-admission”>Children’s Admission (USD): </label>
            </p>
            <p>
                <input id=“child-admission” type=“number”>
            </p>
        <span class=“description”>Admission for children ages 0 - 10.</span>
		    <?php
	    }
	    ?>
    </p>
</div>
<hr>
<!--Escape input with 'esc_attr()'-->
<div>
    <p>
        <label><strong>Telephone Number for Event Sponsor</strong></label>
    </p>
    <p>
        <input type="tel" name="" placeholder="###-###-####">
    </p>
    <span class="description">Enter 10-digit telephone number, area code first.</span>
</div>
<hr>
<!--Escape input with 'esc_attr()'-->
<div>
    <p>
        <label for="maplink-to-event-venue"><strong>Map to Event Venue</strong></label>
    </p>
    <p>
        <input id="maplink-to-event-venue" class="regular-text" name="" type="url" placeholder="https://{url}">
    </p>
    <span class="description">Enter the URL for the event address. In Google Maps, select the 'Share' link to display the map URL, then select the 'short URL' option. Copy and paste the shortened URL to this form.</span>
</div>
<hr>
<!--Escape input with 'esc_url()'-->

<!--Image of event venue (image url pulled from Media Library; what to replace it with if there is no image?)-->
<div>
    <p>
        <label for="event-venue-image"><strong>Image of Event Venue</strong></label>
    </p>
    <p>
        <input id="event-venue-image" class="large-text" name="" type="url" placeholder="https://cornerstonechorale.org/wp-content/uploads/{yyyy}/{mm}/{filename}">
    </p>
    <span class="description">Upload the image of the event venue to the Media Library. Then copy the image URL from the Media Library and paste it here.</span>
</div>
<!--Escape input with 'esc_url()'-->