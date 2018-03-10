<?php
$show_icon = esc_attr( $attributes['show_icon'] );
?>

<dl class="central-hub--container qa">
    <dt class="central-hub--visible" itemscope itemtype="http://schema.org/Question">
        <span class="central-hub--icon <?php echo $show_icon; ?>" aria-hidden="true" data-show-icon="<?php echo $show_icon; ?>" data-hide-icon="<?php esc_attr_e( $attributes['hide_icon'] ); ?>"><span class="screen-reader-text">Click to reveal the answer</span></span> <?php esc_html_e( $attributes['question'] ); ?>
    </dt>
    <dd class="central-hub--hidden" itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer" style="display: none;"><?php echo $content; ?></dd>
</dl>