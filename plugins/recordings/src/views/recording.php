<?php
/**
 *  The single recording view.
 */

namespace spiralWebDb\Recordings;

?>
<dt class="recording revealer--visible" itemscope itemtype="http://schema.org/suggestedQuestion">
    <span class="revealer--icon <?php echo $show_icon; ?>" aria-hidden="true"
          data-show-icon="<?php echo $show_icon; ?>"
          data-hide-icon="<?php echo $hide_icon; ?>"><span class="screen-reader-text">Click to reveal the recording content.</span></span> <?php esc_html_e( $post_title ); ?>
</dt>
<dd class="recording revealer--hidden" itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer" style="display: none;"><?php echo $content; ?></dd>