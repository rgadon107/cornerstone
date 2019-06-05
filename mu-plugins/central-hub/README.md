# Central Hub Plugin


## Plugin Features

This plugin is used as a 'must-use' plugin. Install it in the `/wp-content/mu-plugins` directory of your project.

Plugin features include:

- registers custom post types (CPTs), custom taxonomies, and shortcodes;
- manages label registration for custom post types and taxonomies;
- registers custom meta-boxes in each custom plugin's admin area;
- flushes the .htaccess re-write rules on plugin activation, deactivation, and uninstall;
- includes a data store to manage custom configurations, and a public API to interact with the store;
- includes a CPT and taxonomy template handler for custom plugins registered with `central-hub`.


## Installation

To install this plugin, clone the repository into the mu-plugins (must-use) directory of your project.

1. Navigate to the `/wp-content/mu-plugins` folder of your project in Terminal.

2. Clone the plugin repository by copying/pasting this line of code onto the command line: `https://github.com/rgadon107/cornerstone.git`.


## Continue Development

If you want to continue development of this plugin, you will need to have Composer, Gulp, Node.js, and `npm` installed on your machine. 

1. Navigate to the `/wp-content/mu-plugins/central-hub` folder. 

2. Type `npm install` to install all of the `node_modules` for Gulp.

3. If calling dependencies with Composer, type `composer install` to install the Composer PHP packages. By default, the baseline version of this plugin does not rely on dependancy packages. 