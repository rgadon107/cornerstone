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
    <hr>
    <div>
        <p>
            <label for="telephone-number"><strong>Event Sponsor Telephone Number</strong></label>
        </p>
        <input id="telephone-number" type="tel" name="<?php echo $meta_box_id; ?>[sponsor-tel-number]"
               value="<?php echo esc_attr( $custom_fields['sponsor-tel-number'] ); ?>" placeholder="###-###-####">
        </p>
        <span class="description">Enter 10-digit telephone number, area code first.</span>
    </div>
    <div>
        <p>
            <label for="maplink-to-event-venue"><strong>Google Maps web address (URI) for Event
                    location</strong></label>
        </p>
        <p>
            <input id="maplink-to-event-venue" class="regular-text" type="url"
                   name="<?php echo $meta_box_id; ?>[event-map-url]"
                   value="<?php echo esc_url( $custom_fields['event-map-url'] ); ?>"
                   placeholder="https://goo.gl/maps/{remaining-uri}">
        </p>
        <span class="description">Open Google Maps and enter the address for the performance location. Select the 'Share' button. A box will display a 'Link to Share'. Select the 'Copy Link' button to copy the short URI to your clipboard. Paste the short URI into this custom field.</span>
    </div>
</div>
<hr>
<div>
    <p>
        <label for="admission"><strong>Admission</strong></label>
    </p>
    <p>
        <label for="regular-admission">Adult General Admission (USD): </label>
    </p>
    <p>
        <input id="regular-admission" type="number" name="<?php echo $meta_box_id; ?>[regular-admission]"
               value="<?php echo esc_attr( $custom_fields['regular-admission'] ); ?>" placeholder="20.00" step="0.50"
               min="0.00">
    </p>
    </p>
        <span class="description">Enter the amount to display for general admission. The default value is $15.00. Can be set to '0' for free events.</span>
    </p>
    <p>
        <label for="admission-text-field">Admission Text Field (optional)</label>
    </p>
    <p>
        <input id="admission-text-field" class="large-text" type="text"
               name="<?php echo $meta_box_id; ?>[admission-text-field]"
               value="<?php echo esc_attr( $custom_fields['admission-text-field'] ); ?>">
    </p>
    <span class="description">Add any comments about the event admission here. Examples include:</br></br> (1) whether tickets are available for advanced purchase or only at the door;<br> (2) special admission rates that apply for youth, teens, or college students;</br>
        (3) whether event proceeds will benefit a specific charity; or</br>(4) free admission offered by a sponsoring organization.</span>

</div>
<hr>
<div>
    <p>
        <label for="sponsor-domain-name"><strong>Web address (URI) for the Event sponsor</strong></label>
    </p>
    <p>
        <input id="sponsor-domain-name" class="regular-text" type="url"
               name="<?php echo $meta_box_id; ?>[sponsor-domain-name]"
               value="<?php echo esc_attr( $custom_fields['sponsor-domain-name'] ); ?>"
               placeholder="http:// or https://{event-uri-here}">
    </p>
    <span class="description">Open the event sponsor's website on their front page. Copy the web address (URI) from the browser address bar. Paste the entire web address into this custom field. If the event sponsor has a website, it will display and icon and a link on the front end.</span>
    <p>
    <p>
        <label for="sponsor-facebook"><strong>Facebook web address (URI) for the Event sponsor</strong></label>
    </p>
    <p>
        <input id="sponsor-facebook" class="large-text" type="url"
               name="<?php echo $meta_box_id; ?>[sponsor-facebook]"
               value="<?php echo esc_attr( $custom_fields['sponsor-facebook'] ); ?>"
               placeholder="https://facebook.com/{event-sponsor-facebook-page}">
    </p>
    <span class="description">Open the event sponsor's Facebook page. If the site has an 'Events' option tab, you want to open that. Copy the web address (URI) from the browser address bar. Paste the entire web address into this custom field. If the event sponsor has a Facebook account, it will display an icon and a link on the front end.</span>
    </p>
    <p>
        <label for="sponsor-twitter"><strong>Twitter web address (URI) for the Event Sponsor</strong></label>
    </p>
    <p>
        <input id="sponsor-twitter" class="large-text" type="url" name="<?php echo $meta_box_id; ?>[sponsor-twitter]"
               value="<?php echo esc_attr( $custom_fields['sponsor-twitter'] ); ?>"
               placeholder="https://twitter.com/{event-sponsor-account-name}?lang=en">
    </p>
    <span class="description">Open the event sponsor's Twitter page. Copy the web address (URI) from the browser address bar. Paste the entire web address into this custom field. If the event sponsor has a Twitter account, it will display an icon and a link on the front end.</span>
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
    <span class="description">(1) Upload an image of the event venue to the site Media Library at 'Media' -> 'Add New'.</br>
        (2) Open 'Media' -> 'Library' and select the image you intend to use for this Event.</br>
        (3) Double click on the selected image to view 'Attachment Details'.</br>
        (4) On the right side of the 'Attachment Details' box, highlight the URL for the image. Copy the URL to your clipboard.</br>
        (5) Paste the attachment URL to the custom field above.</br>
        </br>
        If an image is not available, a music icon will be displayed instead.</br>
    </span>
</div>