<?php
/*
 * The donation form featured image view file.
 */
namespace spiralWebDB\ExtendGiveWP;

?>
<figure id="donation-form-featured-image" class="donate-page-featured-image attachment-<?php echo esc_attr( $attachment_id ) ?>" aria-describedby="donation-form-featured-image">
	<?php echo wp_get_attachment_image( $attachment_id, $size, $icon = false, $attr = array( 'class' => 'featured-image' ) ); ?>
    <figcaption id="donation-form-image-caption" class="featured-image-caption"><em><?php echo esc_attr( $post->post_excerpt ); ?></em></figcaption>
</figure>