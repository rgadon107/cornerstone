<dt class="revealer--visible" itemscope itemtype="http://schema.org/Question">
    <span class="revealer--icon <?php echo $attributes['show_icon']; ?>" aria-hidden="true"
          data-show-icon="<?php echo $attributes['show_icon']; ?>"
          data-hide-icon="<?php esc_attr_e( $attributes['hide_icon'] ); ?>"><span class="screen-reader-text">Click to reveal the answer</span></span> <?php esc_html_e( $post_title ); ?>
</dt>
<dd class="revealer--hidden" itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer" style="display: none;"><?php echo $content; ?></dd>