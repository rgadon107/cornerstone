## 1.0.4 @16.Jan.2020

- Added theme root level `/dev/` directory.
- Moved `gulp` task runner, `gulpfile.js` file, `package.json` file, and `/assets/sass/*` directory into `/dev/` directory.
- Updated the dev-dependencies in the `package.json` file to run `gulp` version 4+.
- Changed `gulpfile.js` file to a directory, and broke up the tasks from the single file into 3 files: `config.js`, `index.js`, and `styles.js` files. 
- Updated the `gulp` taskrunner to run 3 separate tasks: styles, stylelint, and watch. 
- Added to `/dev/` directory: theme config files for browserlist, editorconfig, and stylelint, updated `.gitignore`, and `composer.json` file. 
- Added theme styles for the 'extend-give-wp' plugin at `/dev/assets/sass/plugins/_give.scss`.
- Added theme styles for the primary navigation menu at `/dev/assets/sass/components/navigation/_primary.scss`.
- Uptick theme `style.css` version from 1.0.3 to 1.0.4.

## 1.0.3 @17.Feb.2017

Changed the `setup_child_theme()` callback priority number to 15 to ensure that Genesis' setups run first before the child theme.

## 1.0.2 @17.Oct.2016

- Fixed path for enqueuing `/assets/js/responsive-menu.js`

## 1.0.1

Changed autoload.php to move Customizer loading into the nonadmin files.  Why?  The customizer action occurs before `admin_init`.  It wants to be loaded at the start independent of the admin area.

## 1.0.0

Initial release.