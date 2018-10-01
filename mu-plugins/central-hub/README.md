# Collapsible Content Plugin

Collapsible Content is a WordPress plugin that shows and hides hidden content. Practical examples include Q&As, FAQs, hints, marketing teasers, and more. Click the icon to open and reveal the content. Click again to close and hide it.


## Features

This plugin includes the following features:

- QA Shortcode, [qa];
- Teaser Shortcode, [teaser];
- FAQ Shortcode [faq] module to display single or topic FAQs via HTML view files; 
- Font icon vidual indicator;
- jQuery sliding animation;


## Installation

To install this plugin, clone the repository into the plugins directory of your project.

1. Navigate to the `/wp-content/plugins` folder of your project in Terminal.

2. Clone the plugin repository by copying/pasting this line of code onto the command line: `git clone git@gitlab.com:Hamammelis/central-hub.git`.

3. Login to your WordPress website.

4. In the WP Admin, select 'Plugins>>Installed Plugins' and activate `Collapsible Content Plugin`.


## Continue Development

If you want to continue development of this plugin, you will need to have Composer, Gulp, Node.js, and `npm` installed on your machine. 

1. Navigate to the `/wp-content/plugins/central-hub` folder. 

2. Type `npm install` to install all of the `node_modules` for Gulp.

3. If calling dependencies with Composer, type `composer install` to install the Composer PHP packages. By default, the baseline version of this plugin does not rely on dependancy packages. 