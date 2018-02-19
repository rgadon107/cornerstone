<div>
    <label for="member_name"><strong><?php _e( 'Name', METABOX_TEXT_DOMAIN ); ?></strong></label>
    <p>
        <span class="description"><?php _e( 'First', METABOX_TEXT_DOMAIN ); ?></span>
        <input class="regular-text" type="text" name="<?php echo $meta_box_id; ?>[first_name]" value="<?php esc_attr_e( $custom_fields['first_name'] ); ?>">
        <span class="description"><?php _e( 'Last', METABOX_TEXT_DOMAIN ); ?></span>
        <input class="regular-text" type="text" name="<?php echo $meta_box_id; ?>[last_name]" value="<?php esc_attr_e( $custom_fields['last_name'] ); ?>">
    </p>
</div>
<!--<p>-->
<!--    <span class="description">--><?php //_e( 'Last', METABOX_TEXT_DOMAIN ); ?><!--</span>-->
<!--    <input class="regular-text" type="text" name="--><?php //echo $meta_box_id; ?><!--[last_name]" value="--><?php //esc_attr_e( $custom_fields['last_name'] ); ?><!--">-->
<!--</p>-->
<hr>
<p>
    <label for="member_image"><strong><?php _e( 'Image File', METABOX_TEXT_DOMAIN ); ?></strong></label>
    <input class="large-text"type="url" name="<?php echo $meta_box_id; ?>[image]" value="<?php echo esc_url( $custom_fields['image']); ?>">
    <div><span class="description"><?php _e( 'Enter the URL of the image file (e.g. file from site Media Library, or Gravatar.)', METABOX_TEXT_DOMAIN ); ?></span></div>
</p>
<hr>
<p>
    <label for="residence"><strong><?php _e( 'Residence', METABOX_TEXT_DOMAIN ); ?></strong></label>
    <input class="large-text" type="text" placeholder="City, State" name="<?php echo $meta_box_id; ?>[residence]" value="<?php echo esc_attr_e( $custom_fields['residence']); ?>">
    <div><span class="description"><?php _e( 'Enter the City and State where the member currently resides.', METABOX_TEXT_DOMAIN ); ?></span></div>
</p>
<hr>
<p>
    <label for="role"><strong><?php _e( 'Member Role: ', METABOX_TEXT_DOMAIN ); ?></strong></label>
    <select type="text" name="<?php echo $meta_box_id; ?>[role]" value="<?php echo esc_attr_e( $custom_fields['role']); ?>">
        <option value="placeholder">Select a role.</option>
        <optgroup label="Vocalist">
            <option value="soprano">Soprano</option>
            <option value="alto">Alto</option>
            <option value="tenor">Tenor</option>
            <option value="baritone_bass">Baritone/Bass</option>
        </optgroup>
        <optgroup label="Instumentalist">
            <option value="trumpet">Trumpet</option>
            <option value="trombone">Trombone</option>
            <option value="french_horn">French Horn</option>
            <option value="bass">Bass</option>
            <option value="drums">Drums</option>
        </optgroup>
        <optgroup label="Narration">
            <option value="narrator">Narrator</option>
        </optgroup>
        <optgroup label="Leadership">
            <option value="directory">Artistic Director</option>
        </optgroup>
        <optgroup label="Tour Support">
            <option value="support_staff">Support Staff</option>
        </optgroup>
    </select>
    <div><span class="description"><?php _e( 'Select the member\'s primary role from the drop-down list of options.', METABOX_TEXT_DOMAIN ); ?></span></div>
</p>
<hr>
<p>
    <label for="tour_number"><strong><?php _e( 'Number of Tours: ', METABOX_TEXT_DOMAIN ); ?></strong></label>
    <input type="number" min="1" max="40" name="<?php echo $meta_box_id; ?>[tour_number]" value="<?php echo abs( $custom_fields['tour_number']); ?>">
    <div><span class="description"><?php _e( 'Number of Cornerstone tours (including current tour).', METABOX_TEXT_DOMAIN ); ?></span></div>
</p>


