<?php
/**
 *  Shortcode processing for single FAQ or topic FAQs.
 *
 * @package    spiralWebDb\Module\FAQ\Shortcode
 *
 * @since      1.3.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\Module\FAQ\Shortcode;

use spiralWebDb\Module\Custom as CustomModule;

CustomModule\register_shortcode( FAQ_MODULE_DIR . 'config/shortcode.php' );

/**
 *  Process the FAQ Shortcode to build a list of FAQs
 *
 * @since 1.3.0
 *
 * @param array         $config  Array of runtime configuration parameters
 * @param array         $attributes    Attributes for this shortcode instance.
 * @param string|null   $content     Content between the opening and closing shortcode elements.
 * @param string        $shortcode_name     Name of the shortcode.
 *
 * @return string
 */
function process_the_faq_shortcode( array $config, array $attributes, $content, $shortcode_name ) {

	$attributes['post_id'] = (int) $attributes['post_id'];

	if ( $attributes['post_id'] < 1 && ! $attributes['topic'] )  {
		return '';
	}

	$attributes['show_icon'] = esc_attr( $attributes['show_icon'] );

	// Call the view file, capture it into the output buffer, and then return it.
	ob_start();

	if ( $attributes['post_id'] > 0 )   {

		render_single_faq( $attributes, $config );

	} else  {

		render_topic_faqs( $attributes, $config );

	}

	return ob_get_clean();
}

/**
 * Process a single FAQ by post_id
 *
 *  @since 1.3.0
 *
 *  @param array $attributes Default configuration attributes for the single FAQ shortcode
 *  @param array $config  Runtime configuration attributes for the single FAQ view file.
 *
 *  @return void
 */
function render_single_faq( array $attributes, array $config ) {

	 $faq = get_post( $attributes['post_id'] );

	 // Render error message in event there is no FAQ.
	 if ( ! $faq )    {
		 return render_none_found_message( $attributes );
	 }

	$use_term_container = false;
	$is_calling_source = 'shortcode-single-faq';

	$post_title = $faq->post_title;

	$content = do_shortcode( $faq->post_content );

	include( $config['view']['container_single']);

}


/**
 *  Process the topic FAQs by topic attribute
 *
 *  @since 1.3.0
 *
 *  @param array $attributes Default configuration attributes for the topic FAQ shortcode
 *  @param array $config Runtime configuration attributes for the topic FAQ view file.
 *
 *  @return void
 */
function render_topic_faqs( array $attributes, array $config ) {

	$config_args = array(
		'number_of_faqs' => (int) $attributes['number_of_faqs'],
		'nopaging'       => true,
		'post_type'      => 'faq',
		'tax_query'      => array(
			array(
				'taxonomy' => 'topic',
				'field'    => 'slug',
				'terms'    => $attributes['topic'],
			),
		),
		'order'         => 'ASC',
		'orderby'       => 'menu_order',
);


	$query = new \WP_Query( $config_args );

	if ( ! $query->have_posts() )   {
		return render_none_found_message( $attributes, false );
	}

	$use_term_container = true;
	$is_calling_source = 'shortcode-by-topic';
	$term_slug = $attributes['topic'];

	include( $config['view']['container_topic']);

	wp_reset_postdata();

}

/**
 *  Loop through the query and render out the FAQs by topic.
 *
 *  @since 1.3.0
 *
 *  @param \WP_Query    $query
 *  @param array        $attributes
 *  @param array        $config
 *
 *  @return void
 */
function loop_and_render_faqs_by_topic( \WP_Query $query, array $attributes, array $config )    {

	while ( $query->have_posts() )  {
		$query->the_post();

		$post_title = get_the_title();

		$content = do_shortcode( get_the_content() );

		include( $config['view']['faq']);
	}
}

/**
 *  Render the 'none found message' handler.
 *
 * @since 1.3.0
 *
 * @param array $attributes
 * @param bool $is_single_faq
 *
 * @return void
 *
 */
function render_none_found_message( array $attributes, $is_single_faq = true ) {

	if ( ! $attributes['show_none_found_message'] )   {
		return;
	}

	$message = $is_single_faq
		? $attributes['none_found_single_faq']
		: $attributes['none_found_by_topic'];

	echo "<em>{$message}</em>";

}