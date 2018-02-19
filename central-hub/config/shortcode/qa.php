<?php
/**
 *  Runtime configuration parameters (defaults) for the 'qa' shortcode.
 *
 * @package    spiralWebDb\centralHub\Shortcode
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Shortcode;

return array(

	/**=================================================
	 *
	 * Shortcode name [qa]
	 *
	 *==================================================*/
	'shortcode_name'                => 'qa',

	/**=================================================
	 *
	 * Paths to the view files.
	 *
	 *==================================================*/
	'view'     => CENTRAL_HUB_DIR . 'src/shortcodes/views/qa.php',

	/**=================================================
	 *
	 *  Defined shortcode default attributes. Each is
	 *  overridable by the author.
	 *
	 *==================================================*/
	'defaults'  => array(
		'show_icon'     => 'dashicons dashicons-arrow-down-alt2',
		'hide_icon'     => 'dashicons dashicons-arrow-up-alt2',
		'question'      =>  '',
	)
);


//if ( $shortcode_name == 'qa' )  {
//	$config['defaults']['question'] =  '';
//}  elseif ( $shortcode_name == 'teaser' )   {
//	$config['defaults']['visible_message'] =  '';
//}