<?php
/**
 *  The single performance address & map-link view.
 */
namespace spiralWebDb\Events;

?>
<p class="fas fa-map-marker-alt <?php echo empty( $event_map_url ) ? 'event-address' : 'has-map'; ?>" itemprop="address"
   itemscope itemtype="http://schema.org/PostalAddress">
	<?php if ( $event_map_url ) : ?>
    <a href="<?php echo esc_url( $event_map_url ); ?>" class="event-address" target="_blank">
    <?php endif; ?>
		<?php render_performance_address( $event_id ); ?>
    <?php if ( $event_map_url ) : ?>
    </a>
    <?php endif; ?>
</p>
