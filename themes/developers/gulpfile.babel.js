/* eslint-env es6 */
'use strict';

/**
 * To start theme building process, define the theme name below,
 * then run "gulp" in command line.
 */

import gulp from 'gulp';
import browserSync from 'browser-sync';
import cssnano from 'cssnano';
import babel from 'gulp-babel';
import eslint from 'gulp-eslint';
import log from 'fancy-log';
import gulpif from 'gulp-if';
import image from 'gulp-image';
import newer from 'gulp-newer';
import postcssPresetEnv from 'postcss-preset-env';
import postcss from 'gulp-postcss';
import print from 'gulp-print';
import requireUncached from 'require-uncached';
const rename = require("gulp-rename");
import sass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';
import uglify from 'gulp-uglify';

// Import theme-specific configurations.
const themeConfig = require('./config/theme-config.js');

// Project paths
const paths = {
	config: {
		themeConfig: './config/theme-config.js'
	},
	mainStyle: {
		sass: './assets/sass/style.scss',
		src: './style.css',
		dest: './',
		sassMaps: './assets/css/maps'
	},
	scripts: {
		src: ['assets/js/**/*.js'],
		min: 'assets/js/*.min.js',
		dest: './assets/js/'
	},
	images: {
		src: ['assets/images/**/*.{jpg,JPG,png,svg,gif,GIF}'],
		dest: 'assets/images/'
	}
};

/**
 * Conditionally set up BrowserSync.
 * Only run BrowserSync if config.browserSync.live = true.
 */

// Create a BrowserSync instance:
const server = browserSync.create();

// Initialize the BrowserSync server conditionally:
function serve(done) {
	if (themeConfig.dev.browserSync.live) {
		server.init({
			proxy: themeConfig.dev.browserSync.proxyURL,
			port: themeConfig.dev.browserSync.bypassPort,
			liveReload: true
		});
	}
	done();
}

// Reload the live site:
function reload(done) {
	const themeConfig = requireUncached('./config/theme-config.js');
	if (themeConfig.dev.browserSync.live) {
		if (server.paused) {
			server.resume();
		}
		server.reload();
	} else {
		server.pause();
	}
	done();
}

/**
 * Convert Sass into CSS.
 */
export function runSass(config) {
	return gulp.src(config.sass)
		.pipe(sourcemaps.init())
		.pipe(sass({
			sourcemaps: true
		}).on('error', sass.logError))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(config.dest))
		.on('end', function(){ log("Ran 'runSass'"); });
}

/**
 * Run PostCSS (includes Autoprefixer by default) and then optimize.
 */
export function runStyles(config) {
	return gulp.src(config.src)
		.pipe(print())
		.pipe(postcss([
			postcssPresetEnv({
				stage: 3,
				browsers: themeConfig.dev.browserslist
			}),
			cssnano()
		]))
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest(config.dest))
		.on('end', function(){ log("Ran 'runStyles'"); });
}


/**
 * JavaScript via Babel, ESlint, and uglify.
 */
export function scripts() {
	return gulp.src(paths.scripts.src)
		.pipe(newer(paths.scripts.dest))
		.pipe(eslint())
		.pipe(eslint.format())
		.pipe(babel())
		.pipe(gulpif(!themeConfig.dev.debug.scripts, uglify()))
		.pipe(gulp.dest(paths.scripts.dest));
}


/**
 * Copy minified JS files without touching them.
 */
export function jsMin() {
	return gulp.src(paths.scripts.min)
		.pipe(newer(paths.scripts.dest))
		.pipe(gulp.dest(paths.scripts.dest));
}

/**
 * Optimize images.
 */
export function images() {
	return gulp.src(paths.images.src)
		.pipe(newer(paths.images.dest))
		.pipe(image())
		.pipe(gulp.dest(paths.images.dest));
}

/**
 * Let's watch everything by running: `gulp watch`.
 */
export function watch() {
	// The main stylesheet's Sass.
	gulp.watch(paths.mainStyle.sass, gulp.series(
		() => {
			return runSass(paths.mainStyle);
		},
		() => {
			return runStyles(paths.mainStyle)
		},
		reload
	));
	gulp.watch(paths.scripts.src, gulp.series(scripts, reload));
	gulp.watch(paths.scripts.min, gulp.series(jsMin, reload));
	gulp.watch(paths.images.src, gulp.series(images, reload));
}

/**
 * Run the style tasks once by typing: `gulp styles`.
 */
exports.styles = gulp.series(
	() => {
		return runSass(paths.mainStyle);
	},
	() => {
		return runStyles(paths.mainStyle)
	},
	reload
);

/**
 * Run the script tasks once by typing: `gulp scripts`.
 */
exports.scripts = gulp.series(scripts, reload);

/**
 * Copy minified JS files without touching them by typing: `gulp jsMin`.
 */
exports.jsMin = gulp.series(jsMin, reload);

/**
 * Optimize images once by typing: `gulp images`.
 */
exports.images = gulp.series(images, reload);
