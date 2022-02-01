// webpack.mix.js
const mix = require('laravel-mix');
const path = require('path');
require('mix-tailwindcss');

// const getArgs = function() {
//   var data = {}
// 	// console.log('env', process.env.NODE_ENV)
//   data.NODE_ENV = process.env.NODE_ENV
//   process.argv.forEach(function (val) {
//     if(val.includes('=')) {
//       if(val.startsWith('--')) val = val.slice(2)
//       var arg = val.split('=')
//       data[arg[0]] = arg[1]
//     } else if(val.startsWith('--') && val != '--'){
//       val = val.slice(2)
//       data[val] = true
//     }
//   });

//   //purge
//   data.purge = data.NODE_ENV === 'production';
//   if(data.purge && data.local && data.local === 'true') data.purge = false

//   return data
// }

// process.args = getArgs();

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

mix.css('src/css/admin-blocks.css', '/css/admin-blocks.css')
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