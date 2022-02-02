// webpack.mix.js
const mix = require('laravel-mix');
const path = require('path');
require('mix-tailwindcss');

mix.js('src/js/app.js', '/js/app.js')
	.css('src/css/app.css', '/css/app.css')
	.options({
		// Allows us to use relative paths (e.g. background-img: url()) in scss files.
		processCssUrls: false
		// purifyCss: true
	})
	.tailwind('./tailwindcss.config.js')
	// Where mix-manifest.json is saved.
	.setPublicPath('/') //copy resources from here...
	.setResourceRoot('/') //to here.
	// Extra debug info for compiled files.
	.sourceMaps()
	.copy('src/css/fonts', './css/fonts')
	.vue()

// Check package.json for more autoprefixer settings.
// @docs: https://github.com/browserslist/browserslist
mix.webpackConfig({
	resolve: {
		alias: {
			'js': path.resolve(__dirname, 'src/js'),
			'lib': path.resolve(__dirname, 'src/js/lib'),
			'modules-root': path.resolve(__dirname, 'src/js/components'),
		}
	}
})