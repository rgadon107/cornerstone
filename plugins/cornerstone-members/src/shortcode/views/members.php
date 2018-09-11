<?php
/**
 * Members shortcode view.
 *
 * @package    spiralWebDb\Members\Shortcode
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Members\Shortcode;

use function spiralWebDb\Members\Template\render_post_thumbnail_before_title;
use function spiralWebDb\Members\Template\render_members_content;
use function spiralWebDb\Members\Template\render_member_role;
use function spiralWebDb\Members\Template\render_member_meta;
use function spiralWebDb\Members\Template\render_member_title;

?>

<article class="<?php echo esc_attr( $article_classes ); ?>" itemscope itemtype="https://schema.org/CreativeWork">
    <header class="entry-header">
		<?php
		render_post_thumbnail_before_title( $member_id );
		render_member_role( $member_id );
		render_member_title( $member_id );
		?>
    </header>
    <div class="entry-content two-thirds" itemprop="text">
		<?php

		render_members_content();
		render_member_meta( $member_id );
		?>
    </div>
</article>