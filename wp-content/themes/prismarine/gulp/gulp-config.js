/**
 * Gulp Configuration File
 *
 * 1. Edit the variables as per your project requirements
 *
 * @author      Very - Engineer Esteban Rocha
 * @package     Gulp
 * @link        https://verypossible.com
 * @since       1.0.0
 */

const thisPath = __dirname;

// BrowserSync Multi Environment Switch
let browserSyncProxy;
switch (process.env.USER) {
	case "makarov":
		browserSyncProxy = "127.0.0.1:88/";
		break;
	case "jonathancaiaffa":
		browserSyncProxy = "127.0.0.1:88/";
		break;
	case "andres":
		browserSyncProxy = "127.0.0.1:88/";
		break;

	default:
		browserSyncProxy = undefined;
		break;
}

// Sass Style bundle switcher
const sassTemplate = {
	Style: {
		cssBundle: "**/!(*.min.*)*.css",
		scssDir: "../css/",
		scssEntry: "../sass/*.scss",
	},
};

// JavaScript bundle switcher
const jsTemplate = {
	babel: {
		bundle: "**/!(*.min.*)*.js",
		concat: "app.js",
		dest: "../js/",
		src: "src/**/*.js",
	},
};

module.exports = {
	// Docker Container auto init
	docker: {
		active: browserSyncProxy !== undefined ? true : false,
		autoStart: true,
	},

	// BrowserSync Server options
	browserSync: {
		active: true,
		autoOpen: false, // Auto load local env on start in browser
		inject: true, // Inject CSS changes without reloading
		ghostmode: {
			clicks: true,
			forms: false,
			scroll: false,
		},
		proxy: browserSyncProxy, // Local URL of running WordPress e.g. 127.0.0.1:80
		reloadDelay: 500, // Time, in milliseconds, to reload/inject after a file change event
	},
	productURL: "./", // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder

	// Style options
	style: {
		active: true,
		cssBundle: sassTemplate.Style.cssBundle, // Path to bundle
		scssDir: sassTemplate.Style.scssDir, // Path to place the compiled CSS file
		scssEntry: sassTemplate.Style.scssEntry, // Path to main .scss file
		scssLog: true, // Log errors
		scssOutput: "expanded", // Available options → 'compact','compressed','nested','expanded'
		scssPrecision: 10, // Floating number precision when compiling to CSS
	},
	// heroModule: {
	// 	active: true,
	// 	cssBundle: sassTemplate.heroModule.cssBundle, // Path to bundle
	// 	scssDir: sassTemplate.heroModule.scssDir, // Path to place the compiled CSS file
	// 	scssEntry: sassTemplate.heroModule.scssEntry, // Path to main .scss file
	// 	scssLog: true, // Log errors
	// 	scssOutput: "expanded", // Available options → 'compact','compressed','nested','expanded'
	// 	scssPrecision: 10, // Floating number precision when compiling to CSS
	// },
	// Style options

	// JavaScript ESNext Options
	js: {
		active: true, // ESNext watch JS
		bundle: jsTemplate.babel.bundle,
		concat: jsTemplate.babel.concat,
		dest: jsTemplate.babel.dest,
		// release: jsTemplate.babel.release,
		src: jsTemplate.babel.src,
	},

	// Images optimization options
	imagemin: {
		active: false, // Imagemin watch @CAVEAT: takes long times + 100% CPU on large projects
		dest: "../../../uploads/dist", // Dest folder of optimized images. Must be different from the src folder
		src: "../../../uploads/**/*", // Src folder of images which should be optimized and watched You can also specify types e.g. raw/**.{png,jpg,gif} in the glob
	},

	// Gulp watch paths
	watch: {
		html: {
			active: false, // Activate HTML watch
			path: "../**/*.html", // Path to all HTML files
		},
		php: {
			active: true, // Activate PHP watch
			path: "../**/*.php", // Path to all PHP files
		},
		scss: "../sass/**/*.scss", // Path to all SCSS files
	},

	// PostCSS Plugins -> Read docs for each plugin for more info
	postCSS: {
		autoprefixer: {
			overrideBrowserslist: ["last 2 versions", "> 0.5%", "IE 10", "IE 11"],
			cascade: true,
			flexbox: true,
			grid: "autoplace",
		},
		cssnano: {
			preset: "default",
		},
		cssvariables: {
			preserve: true,
			preserveInjectedVariables: true,
		},
		mqpacker: {
			sort: "sortCSSmq.desktopFirst",
		},
		pixrem: {
			rootValue: 16,
			replace: false,
			atrules: false,
			html: true,
			browsers: "ie >= 8",
			unitPrecision: 5,
		},
		postcsssorting: {
			"properties-order": "alphabetical",
		},
	},

	// Messages for fancy-log
	log: {
		browserScLog: {
			reload: "   🔨 Start BrowserSync Hot Reloading!!",
			up: "   🔨 BrowserSync Server up!!",
		},
		color: {
			green: "\u001b[32m",
			red: "\u001b[31m",
			yellow: "\u001b[35m",
			white: "\u001b[39m",
		},
		divider: "⚡ <==============================> ⚡",
		docker: "   🔨 Docker container Init!!",
		image: {
			start: "   🔨 Start Imagemin Optimization!",
		},
		js: {
			start: "   🔨 Start ES@Next compilation!",
		},
		sass: {
			start: "   🔨 Start Sass compilation!",
		},
	},
};
