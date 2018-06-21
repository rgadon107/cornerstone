<?php

use KnowTheCode\ConfigStore;

?>
<div>
    <p>
        <span class="description"><?php echo 'Additional information about each tour member.'; ?></span>
    </p>
</div>
<p>
    <label for="role"><strong><?php echo 'Member Role: '; ?></strong></label>
    <select type="text" name="<?php echo $meta_box_id; ?>[role]"
            value="<?php echo esc_attr( $custom_fields['role'] ); ?>">
        <option>--Select a Role--</option>
		<?php foreach ( ConfigStore\getConfig( $config['roles'] ) as $roles => $role_name ) : ?>
            <option value="<?php echo esc_attr( $roles ); ?>"<?php selected( $custom_fields['role'], $roles ); ?>><?php echo esc_html( $role_name ); ?></option>
		<?php endforeach; ?>
    </select>
<div>
    <span class="description"><?php echo 'Select the member\'s primary role from the drop-down list of options.'; ?></span>
</div>
</p>
<hr>
<p>
    <label for="residence"><strong><?php echo 'Residence'; ?></strong></label>
</p>
<p>
    <input id="residence-city" type="regular-text" name="<?php echo $meta_box_id; ?>[residence_city]"
           value="<?php echo esc_attr( $custom_fields['residence_city'] ); ?>" placeholder="City">
    <select id="residence-state" name="<?php echo $meta_box_id; ?>[residence_state]"
            value="<?php echo esc_attr( $custom_fields['residence_state'] ); ?>">
        <option>--Select a State--</option>
		<?php foreach ( ConfigStore\getConfig( $config['states'] ) as $state_id => $state_name ) : ?>
            <option value="<?php echo esc_attr( $state_id ); ?>"<?php selected( $custom_fields['residence_state'], $state_id ); ?>><?php echo esc_html( $state_name ); ?></option>
		<?php endforeach; ?>
    </select>
</p>
<div><span class="description"><?php echo 'Enter the City and State where the member currently resides.'; ?></span>
</div>
</p>
<hr>
<p>
    <label for="tour_number"><strong><?php echo 'Number of Tours: '; ?></strong></label>
    <input type="number" min="1" max="40" name="<?php echo $meta_box_id; ?>[tour_number]"
           value="<?php echo abs( $custom_fields['tour_number'] ); ?>">
<div><span class="description"><?php echo 'Number of Cornerstone tours the member has participated in (including current tour).'; ?></span></div>
</p>