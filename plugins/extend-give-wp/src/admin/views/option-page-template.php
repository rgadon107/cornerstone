<?php
/*
 * View file for the options page template.
 */
?>
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form action="<?php esc_url( menu_page_url( 'extend-give-wp-options', true ) ); ?>" method="post">
		<?php settings_fields( 'extend-give-wp-options' ); ?>
		<?php do_settings_sections( 'extend-give-wp-options' ); ?>
		<?php submit_button( 'Save Settings', 'primary' ); ?>
    </form>
</div>