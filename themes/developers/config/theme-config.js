'use strict';

module.exports = {
	theme: {
		slug: 'cornerstone',
		name: 'Cornerstone Genesis powered child theme.',
		author: 'Robert Gadon'
	},
	dev: {
		browserSync: {
			live: true,
			proxyURL: 'cornerstone.test:8888',
			bypassPort: '8181'
		},
		browserslist: [ // See https://github.com/browserslist/browserslist
			'> 1%',
			'last 2 versions'
		],
		debug: {
			styles: false, // Render verbose CSS for debugging.
			scripts: false // Render verbose JS for debugging.
		}
	},
	export: {
		compress: true
	}
};
