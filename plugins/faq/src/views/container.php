<?php

use spiralWebDb\FAQ\Template as Template;
use spiralWebDb\FAQ\Shortcode as Shortcode;

if ( isset( $use_term_container ) && $use_term_container ) : ?>

    <div class="central-hub--term-container faq faq-topic--<?php esc_attr_e( $term_slug ); ?>">

<?php endif; ?>

<?php if ( isset( $show_term_name ) && $show_term_name ) : ?>
    <h2><?php esc_html_e( $record['term_name'] ); ?></h2>
<?php endif; ?>
    <dl class="central-hub--container faq">

		<?php

		if ( $is_calling_source === 'template' ) {

			Template\loop_and_render_faqs( $record['posts'] );

		} elseif ( $is_calling_source === 'shortcode-by-topic' ) {

			Shortcode\loop_and_render_faqs_by_topic( $query, $attributes, $config );

		} else {
			include( __DIR__ . '/faq.php' );
		}

		?>

    </dl>
<?php if ( isset( $use_term_container ) && $use_term_container ) : ?>
    </div>
<?php endif; ?>