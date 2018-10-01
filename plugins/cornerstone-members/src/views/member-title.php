<?php
/**
 * The single Cornerstone member title view.
 */

namespace spiralWebDb\Members;

?>

<h1 class="entry-title two-thirds" itemprop="headline">
    <a href="<?php echo esc_url( get_permalink( $member_id ) ); ?>">
		<?php echo esc_html( get_the_title( $member_id ) ); ?>
    </a>
</h1>