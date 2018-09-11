<?php
/**
 * Events shortcode view.
 *
 * @package    spiralWebDb\Events\Shortcode
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Events\Shortcode;

use function spiralWebDb\Events\render_the_performance_community;
use function spiralWebDb\Events\render_event_title;
use function spiralWebDb\Events\render_performance_date_and_time;

?>

<article class="<?php echo esc_attr( $article_classes ); ?>" itemscope itemtype="https://schema.org/MusicEvent">
    <header class="entry-header two-thirds">
		<?php
		render_the_performance_community( $event_id );
		render_event_title( $event_id );
		?>
        <div class="before-entry-content-meta">
        <?php render_performance_date_and_time( $event_id ); ?>
        </div>
    </header>
</article>
