<?php
$show_icon = esc_attr( $attributes['show_icon'] );
?>

<div class="central-hub--container teaser" itemscope itemtype="http://schema.org/BlogPosting">
    <div class="central-hub--visible" itemprop="headline">
        <span class="central-hub--icon <?php echo $show_icon; ?>" aria-hidden="true" data-show-icon="<?php echo $show_icon; ?>" data-hide-icon="<?php esc_attr_e( $attributes['hide_icon'] ); ?>"><span class="screen-reader-text">Click to reveal the answer</span></span> <?php esc_html_e( $attributes['visible_message'] ); ?>
    </div>
    <div class="central-hub--hidden" itemprop="description" style="display: none;"><?php echo $content; ?></div>
</div>