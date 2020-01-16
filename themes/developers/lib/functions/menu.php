<?php
/**
 *  Nav menu customizations.
 *
 * @package     spiralWebDB\Developers
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        https://knowthecode.io
 * @license     GNU General Public License 2.0+
 */

namespace spiralWebDB\Developers;

use function spiralWebDB\Developers\get_theme_dir;

add_filter( 'genesis_do_nav', __NAMESPACE__ . '\add_class_attribute_to_nav_menu_item' );
/*
 * Add a class attribute to the first menu list item of the primary navigation.
 *
 * @since 1.0.0.
 * @param string $nav_output    Opening container markup, nav, closing container markup.
 *
 * @return string $nav_output   The filtered navigation HTML.
 */
function add_class_attribute_to_nav_menu_item( $nav_output ) {
	return  <<<PRIMARY_NAV_MENU
<nav class="nav-primary" aria-label="Main" itemscope itemtype="https://schema.org/SiteNavigationElement" id="genesis-nav-primary">
	<div class="wrap">
		<ul id="menu-primary" class="menu genesis-nav-menu menu-primary js-superfish">
			<li id="menu-item-1357" class="donate menu-item menu-item-type-post_type menu-item-object-page menu-item-1357">
				<a href="http://cornerstonephp56.local/donate/" itemprop="url"><span itemprop="name">Donate</span></a></li>
			<li id="menu-item-30" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-2 current_page_item menu-item-30">
				<a href="http://cornerstonephp56.local/" aria-current="page" itemprop="url"><span itemprop="name">Home</span></a></li>
			<li id="menu-item-994" class="menu-item menu-item-type-post_type_archive menu-item-object-members menu-item-994">
				<a href="http://cornerstonephp56.local/members/" itemprop="url"><span itemprop="name">Ensemble Members</span></a></li>
			<li id="menu-item-555" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-555">
				<a href="http://cornerstonephp56.local/reviews" itemprop="url"><span itemprop="name">Reviews</span></a></li>
			<li id="menu-item-596" class="menu-item menu-item-type-post_type_archive menu-item-object-recordings menu-item-596">
				<a href="http://cornerstonephp56.local/recordings/" itemprop="url"><span itemprop="name">Recordings</span></a></li>
			<li id="menu-item-313" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-313">
				<a href="http://cornerstonephp56.local/newsletters/" itemprop="url"><span itemprop="name">Newsletters</span></a></li>
			<li id="menu-item-558" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-558">
				<a href="http://cornerstonephp56.local/why-cornerstone/" itemprop="url"><span itemprop="name">About</span></a>
				<ul class="sub-menu">
					<li id="menu-item-1429" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1429"><a href="http://cornerstonephp56.local/why-cornerstone/media/" itemprop="url"><span itemprop="name">Media</span></a></li>
					<li id="menu-item-1360" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1360"><a href="http://cornerstonephp56.local/why-cornerstone/past-tours/" itemprop="url"><span itemprop="name">Past Tours</span></a></li>
					<li id="menu-item-699" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-699"><a href="http://cornerstonephp56.local/why-cornerstone/gallery/" itemprop="url"><span itemprop="name">Image Gallery</span></a></li>
					<li id="menu-item-384" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-384"><a href="https://www.facebook.com/Bruce-Vantines-Cornerstone-Chorale-and-Brass-121807044549105/" itemprop="url"><span itemprop="name"><i class="fab fa-facebook-square fa-lg"></i> Facebook</span></a></li>
				</ul>
			</li>
			<li id="menu-item-388" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-388">
				<a href="http://cornerstonephp56.local/contact-cornerstone/" itemprop="url"><span itemprop="name">Contact Us</span></a></li>
		</ul>
	</div>
</nav>\n
PRIMARY_NAV_MENU;
}

