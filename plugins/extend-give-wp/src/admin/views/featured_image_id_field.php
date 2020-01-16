<?php
/**
 *  View file for the featured image ID input/output field.
 */
?>
<label>
    <input id="featured-image-id" class="normal-text" name="extend-give-wp[featured-image-id]" type="number"
           min="1" aria-describedby="featured-image-attachment-id"
           value="<?php echo esc_attr( $attachment_id ); ?>">
    <p id="featured-image-input-label" class="description">Enter the image ID for the donation form featured image in
        the field above.</p>
    <p id="featured-image-input-label" class="description">Get the ID by opening the Media Library, and select the
        featured image.</p>
    <p id="featured-image-input-label" class="description">View the permalink on the ‘Attachment Details’ page. The ID
        is the value of the ‘?item=‘ parameter in the permalink.</p>
</label>
