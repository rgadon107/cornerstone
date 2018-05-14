<dt class="revealer--visible" itemscope itemtype="http://schema.org/Question">
    <span class="revealer--icon <?php echo $show_icon; ?>" aria-hidden="true"
          data-show-icon="<?php echo $show_icon; ?>"
          data-hide-icon="<?php echo $hide_icon; ?>"><span class="screen-reader-text">Click to reveal the answer</span></span> <?php esc_html_e( $post_title ); ?>
</dt>
<dd class="revealer--hidden" itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer" style="display: none;"><?php echo $content; ?></dd>