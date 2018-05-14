<?php
/**
 *  The single recording view.
 */

namespace spiralWebDb\Recordings;

?>
<div class="recording recording-<?php echo esc_attr( $recording_id ); ?>" itemscope itemtype="http://schema.org/MusicRecording">
    <div class="revealer--visible">
        <span class="revealer--icon <?php echo $show_icon; ?>" aria-hidden="true"
              data-show-icon="<?php echo $show_icon; ?>"
              data-hide-icon="<?php echo $hide_icon; ?>">
            <span class="screen-reader-text">Click to reveal the recording content.</span>
        </span> <span itemprop="name"><?php echo esc_html( $post_title ); ?></span>
    </div>
    <div class="revealer--hidden" itemprop="description" style="display: none;">
        <?php echo get_the_post_thumbnail( $recording_id, 'full', [ 'class' => 'alignleft recording-album-cover' ] ); ?>
        <?php echo wpautop( $content ); ?>
    </div>
</div>