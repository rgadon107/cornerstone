<?php
ddd( 'Loading the Recording shortcode view file.' ); ?>
<dt class="recording--visible" itemscope itemtype="http://schema.org/suggestedQuestion">
    <span class="recording--icon <?php echo $attributes['show_icon']; ?>" aria-hidden="true"
          data-show-icon="<?php echo $attributes['show_icon']; ?>"
          data-hide-icon="<?php esc_attr_e( $attributes['hide_icon'] ); ?>"><span class="screen-reader-text">Click to reveal the recording content.</span></span> <?php esc_html_e( $post_title ); ?>
</dt>
<dd class="recording--hidden" itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer"
    style="display: none;"><?php echo $content; ?></dd>