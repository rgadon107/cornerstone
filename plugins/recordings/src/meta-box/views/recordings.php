<div class="audio-file">
    <label for="audio-file"><strong>Audio Sample Files</strong></label>
    <p>
        <input id="cd-cover-image" class="large-text" type="url" name="<?php echo $meta_box_id; ?>[audio-file-1]"
               value="<?php echo esc_attr( $custom_fields['audio-file-1'] ); ?>"
               placeholder="https://cornerstonechorale.org/wp-content/uploads/{yyyy}/{mm}/{filename}">
    </p>
    <span class="description">Upload the audio file to the Media Library. Then copy the file URL from the Media Library and paste it into the custom field above.</span>
</div>