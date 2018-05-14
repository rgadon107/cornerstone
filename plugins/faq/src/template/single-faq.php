<?php
/**
 * Single FAQ Template.
 *
 * @package     spiralWebDb\FAQ\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\FAQ\Template;

use spiralWebDb\FAQ\Asset;

ddd( 'Loaded the single-faq template.' );

Asset\enqueue_script_ondemand();

genesis();