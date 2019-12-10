<?php
/*
 * The donation form featured image view file.
 */
namespace spiralWebDB\ExtendGiveWP;

?>
<figure id="attachment_<?php echo esc_attr( $postID ) ?>" class="donation-form-featured-image attachment_<?php echo esc_attr( $postID ) ?>" aria-describedby="caption-attachment-<?php echo esc_attr( $postID ) ?>">
	<?php echo wp_get_attachment_image( 1411, $size = 'large', $icon = false, $attr = array( 'class' => 'featured-image attachment_1411 ID-1411' ) ); ?>
    <figcaption id="caption-attachment-<?php echo esc_attr( $postID ) ?>" class="post-<?php echo esc_attr( $postID ) ?>-caption"><em><?php echo esc_attr( $post->post_excerpt ); ?></em></figcaption>
</figure>