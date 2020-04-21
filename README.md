# Cornerstone Chorale &amp; Brass web redevelopment project

Working under the mentorship of software engineer and educator Tony Mork ( https://www.linkedin.com/in/hellofromtonya/ ), I worked with a local client to migrate their static website to WordPress. This was a ‘capstone’ project that integrated and applied the labs on custom plugin and theme development presented on KnowTheCode.io ( https://knowthecode.io ).

## Project highlights included:

### 1) Development of written project requirements and defined work scope based on client meetings.

### 2) Developed the following project assets:

  a) a refactored Genesis child theme based on StudioPress’ Genesis Sample theme ( https://github.com/studiopress/genesis-sample ).
  
  b) the breakup and refactoring of the source theme’s stylesheet into SASS/SCSS partial files.
  
  c) reuse of a custom plugin module as a mission-critical, must-use plugin. Plugin features include:

    i) registration of custom post types, taxonomies, post meta boxes, and shortcodes with WordPress;
    ii) creation of custom labels for registered custom post types and taxonomies; and
    iii) handling of plugin and theme page requests for single, archive, and taxonomy templates.

  d) a set of 4 custom plugins that pass the values of a modular configuration to the `‘central-hub’` plugin for processing.
  
  e) custom templates and view files built for each of the 4 custom plugins to render archive and single pages, taxonomy archives, and shortcodes.
  
  f) configuration of a `gulp` task runner ( https://gulpjs.com/ ) that automates development and build tasks.

### 3) Regular code reviews with Ms. Mork to review and discuss the building of plugin features, leveraging the Genesis Framework and WordPress, and creating an efficient Git workflow.

_Project GitHub repo:_ https://github.com/rgadon107/cornerstone // See ‘master’ branch

_Former site:_ https://web.archive.org/web/20180416133420/http://www.cornerstonechorale.org/
