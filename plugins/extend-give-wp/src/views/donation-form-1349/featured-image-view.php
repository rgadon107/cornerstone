<?php
/*
 * The donation form featured image view file.
 */
namespace spiralWebDB\ExtendGiveWP;

?>
<figure id="attachment_<?php echo esc_attr( $attachment_id ) ?>" class="donation-form-featured-image attachment_<?php echo esc_attr( $attachment_id ) ?>" aria-describedby="caption-attachment-<?php echo esc_attr( $attachment_id ) ?>">
	<?php echo wp_get_attachment_image( $attachment_id, $size, $icon, $attr = array( 'class' => 'featured-image' ) ); ?>
    <figcaption id="caption-attachment-<?php echo esc_attr( $attachment_id ) ?>" class="post-<?php echo esc_attr( $attachment_id ) ?>-caption"><em><?php echo esc_attr( $post->post_excerpt ); ?></em></figcaption>
</figure>