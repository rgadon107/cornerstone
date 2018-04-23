<?php

use spiralWebDb\Module\Shortcode as Shortcode;

if ( isset( $use_term_container ) && $use_term_container ) : ?>

    <div class="reviews--term-container reviews reviews-topic--<?php esc_attr_e( $term_slug ); ?>">

<?php endif; ?>

<?php if ( isset( $show_term_name ) && $show_term_name ) : ?>
    <h2><?php esc_html_e( $record['term_name'] ); ?></h2>
<?php endif; ?>
    <dl class="reviews--container reviews">

		<?php

		if ( $is_calling_source === 'template' ) {

			loop_and_render_reviews( $record['posts'] );

		} elseif ( $is_calling_source === 'reviews-by-topic' ) {

			Shortcode\loop_and_render_reviews_by_topic( $query, $attributes, $config );

		} else {
			include( __DIR__ . '/review.php' );
		}

		?>

    </dl>
<?php if ( isset( $use_term_container ) && $use_term_container ) : ?>
    </div>
<?php endif; ?>