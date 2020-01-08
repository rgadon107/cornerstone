<?php
/**
 *  The option settings view file for the Extend GiveWP plugin.
 */
?>
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form action="<?php menu_page_url( 'extend-give-wp-options' ); ?>" method="post">
        <table class="form-table" role="presentation">
            <tbody>
            <tr>
                <th scope="row">
                    <label for="featured_image_id">Featured Image ID</label>
                </th>
                <td>
                    <input id="featured_image_id" class="normal-text" name="featured-image-id" type="number"
                           min="1" aria-describedby="featured-image-attachment-id" placeholder="1" value="" >
                    <p id="featured-image-input-label" class="description">Enter the image ID for the donation form featured image in the field above.</p>
                    <p id="featured-image-input-label" class="description">Get the ID by opening the Media Library, and select the featured image.</p>
                    <p id="featured-image-input-label" class="description">View the permalink on the ‘Attachment Details’ page. The ID is the value of the ‘?item=‘ parameter in the permalink.</p>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
