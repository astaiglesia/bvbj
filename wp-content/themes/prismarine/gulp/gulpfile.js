/**
 * Gulp compiler module for SCSS => PostCSS => ES6
 *
 * @author      Very - Engineer Esteban Rocha
 * @link        https://verypossible.com
 * @since       1.0.0
 */

/**
 * Load configuration
 */
const gp = require("./gulp-config.js");

/**
 * Modules Style Configurations
 */
// const modHero = gp.heroModule;

/**
 * Set Gulp Dependencies
 * @param string: plugin
 */
const gulp = require("gulp");

// CSS plugins
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const cssvariables = require("postcss-css-variables");
const mqpacker = require("css-mqpacker");
const pixrem = require("pixrem");
const postcss = require("gulp-postcss");
const postcsssorting = require("postcss-sorting");
const sass = require("gulp-sass");
const sassdoc = require("sassdoc");
const sortCSSmq = require("sort-css-media-queries");

// JavaScript plugins
const babel = require("gulp-babel");
const concat = require("gulp-concat");
const uglify = require("gulp-uglify");

// Image optimization plugins
const imagemin = require("gulp-imagemin");

// Misc plugins
const beep = require("beepbeep");
const browserSync = require("browser-sync").create();
const cache = require("gulp-cache");
const debug = require("gulp-debug");
const exec = require("gulp-exec");
const filter = require("gulp-filter");
const lineec = require("gulp-line-ending-corrector");
const log = require("fancy-log");
const notify = require("gulp-notify");
const plumber = require("gulp-plumber");
const prettier = require("gulp-prettier");
const rename = require("gulp-rename");
const sourcemaps = require("gulp-sourcemaps");

/**
 * Generate:
 *  - Gracefull null returning
 *
 * @function  const emptiness: (done: any) => any
 * @param     signal @callback async completion
 */
const emptiness = (done) => done();

/**
 * Generate:
 *  - Custom Error Handler.
 *
 * @function  const errorHandler: function(r: any) => void
 * @param     Mixed err.
 */
const errorHandler = (r) => {
	notify.onError("\n\n❌  ===> ERROR: <%= error.message %>\n")(r);
	beep();
	// this.emit('end');
};

/**
 * Generate:
 *  - exec => Docker container init
 *
 * @function (method) Undertaker.task(taskName: string, fn: Undertaker.TaskFunction): void (+2 overloads)
 * @param    taskName — Task name.
 * @param    fn — Undertaker Task function.
 */
gulp.task("dockerInit", () => {
	log(
		`\n\n${gp.log.color.red}${gp.log.divider}\n${gp.log.docker}\n${gp.log.divider}${gp.log.color.white}\n`
	);
	return gulp
		.src(gp.style.scssDir, { allowEmpty: true })
		.pipe(
			exec(
				gp.docker.autoStart
					? `cd ${gp.docker.path} || return && docker-compose start`
					: `cd ${gp.docker.path} || return && docker-compose stop`
			)
		);
});

/**
 * Generate:
 *  - browser-sync server init
 *
 * @function  const  browsersync: function(done: any) => void
 * @param     signal @callback async completion
 */
const browsersync = (done) => {
	log(
		`\n\n${gp.log.color.red}${gp.log.divider}\n${gp.log.browserScLog.up}\n${gp.log.divider}${gp.log.color.white}\n`
	);
	browserSync.init({
		ghostMode: gp.browserSync.ghostmode,
		injectChanges: gp.browserSync.inject,
		open: gp.browserSync.autoOpen,
		proxy: gp.browserSync.proxy,
		reloadDelay: gp.browserSync.reloadDelay,
		watchEvents: ["change", "add", "unlink", "addDir", "unlinkDir"],
	});
	done();
};

/**
 * Generate:
 *  - Helper for browserSync reload
 *
 * @function  const  reload: function(done: any) => void
 * @param     signal @callback async completion
 */
const reload = (done) => {
	log(
		`\n\n${gp.log.color.red}${gp.log.divider}\n${gp.log.browserScLog.reload}\n${gp.log.divider}${gp.log.color.white}\n`
	);
	browserSync.reload();
	done();
};

/**
 * Generate:
 *  - sassdoc
 *  - sourcemaps
 *  - sass build
 *  - postcss
 *  - lineec
 *  - rename
 *  - prettier
 *  - browsersync.stream
 *
 * @function (method) Undertaker.task(taskName: string, fn: Undertaker.TaskFunction): void (+2 overloads)
 * @param    taskName — Task name.
 * @param    fn — Undertaker Task function.
 */
gulp.task("styles", () => {
	log(
		`\n\n${gp.log.color.red}${gp.log.divider}\n${gp.log.sass.start}\n${gp.log.divider}${gp.log.color.white}\n`
	);
	const postPlugins = [
		pixrem(gp.postCSS.pixrem),
		autoprefixer(gp.postCSS.autoprefixer),
		cssvariables(gp.postCSS.cssvariables),
		postcsssorting(gp.postCSS.postcsssorting),
		mqpacker(gp.postCSS.mqpacker),
		cssnano(gp.postCSS.cssnano),
	];
	const filterCss = filter([gp.style.cssBundle], { restore: true });
	return gulp
		.src(gp.style.scssEntry, { allowEmpty: true })
		.pipe(plumber(errorHandler))
		.pipe(sourcemaps.init())
		.pipe(debug({ title: "Watching =>" }))
		.pipe(
			sass.sync({
				errLogToConsole: gp.style.scssLog,
				outputStyle: gp.style.scssOutput,
				precision: gp.style.scssPrecision,
			})
		)
		.on("error", sass.logError)
		.pipe(sourcemaps.write({ includeContent: false }))
		.pipe(sourcemaps.init({ loadMaps: true }))
		.pipe(postcss(postPlugins))
		.pipe(sourcemaps.write("./"))
		.pipe(lineec())
		.pipe(gulp.dest(gp.style.scssDir))
		.pipe(debug({ title: "Working =>" }))
		.pipe(filterCss)
		.pipe(rename({ suffix: ".min" }))
		.pipe(lineec())
		.pipe(gulp.dest(gp.style.scssDir))
		.pipe(browserSync.stream())
		.pipe(filterCss.restore)
		.pipe(gulp.dest(gp.style.scssDir))
		.pipe(filterCss)
		.pipe(prettier({ printWidth: 80 }))
		.pipe(lineec())
		.pipe(debug({ title: "Bundle Beautified into =>" }))
		.pipe(gulp.dest(gp.style.scssDir));
});

/**
 * Generate:
 *  - gifsicle
 *  - jpegtran
 *  - optipng
 *  - svgo
 *
 * @function (method) Undertaker.task(taskName: string, fn: Undertaker.TaskFunction): void (+2 overloads)
 * @param    taskName — Task name.
 * @param    fn — Undertaker Task function.
 */
gulp.task("images", () => {
	log(
		`\n\n${gp.log.color.red}${gp.log.divider}\n${gp.log.image.start}\n${gp.log.divider}${gp.log.color.white}\n`
	);
	return gulp
		.src(gp.imagemin.src)
		.pipe(plumber(errorHandler))
		.pipe(
			cache(
				imagemin(
					[
						imagemin.gifsicle({ interlaced: true }),
						imagemin.jpegtran({ progressive: true }),
						imagemin.optipng({ optimizationLevel: 7 }), // 0-7 low-high.
						imagemin.svgo({
							plugins: [{ removeViewBox: false }, { cleanupIDs: true }],
						}),
					],
					{
						verbose: true,
					}
				)
			)
		)
		.pipe(gulp.dest(gp.imagemin.dest))
		.pipe(notify({ message: "\n\n✅  ===> IMAGES — completed!\n", onLast: true }));
});

/**
 * Task: `clear-images-cache`.
 *
 * Deletes the images cache. By running the next "images" task,
 * each image will be regenerated.
 */
gulp.task("clearCache", function (done) {
	return cache.clearAll(done);
});

/**
 * Generate:
 *  - babel
 *  - concat
 *  - sourcemaps
 *  - rename
 *  - uglify
 *  - lineec
 *
 * @function (method) Undertaker.task(taskName: string, fn: Undertaker.TaskFunction): void (+2 overloads)
 * @param    taskName — Task name.
 * @param    fn — Task function.
 */
gulp.task("es6", () => {
	log(
		`\n\n${gp.log.color.red}${gp.log.divider}\n${gp.log.js.start}\n${gp.log.divider}${gp.log.color.white}\n`
	);
	const filterJS = filter([gp.js.bundle], { restore: true });
	return gulp
		.src(gp.js.src, { allowEmpty: true })
		.pipe(debug({ title: "Babel Watching =>" }))
		.pipe(sourcemaps.init())
		.pipe(
			babel({
				presets: ["@babel/env"],
			})
		)
		.pipe(lineec())
		.pipe(gulp.dest(gp.js.dest))
		.pipe(filterJS)
		.pipe(concat(gp.js.concat, { newLine: "\n\n/* @Concat Next -> */\n\n" }))
		.pipe(lineec())
		.pipe(gulp.dest(gp.js.dest))
		.pipe(filterJS)
		.pipe(debug({ title: "Working =>" }))
		.pipe(rename({ suffix: ".min" }))
		.pipe(uglify())
		.pipe(lineec())
		.pipe(debug({ title: "Babel transform written into =>" }))
		.pipe(gulp.dest(gp.js.dest))
		.pipe(sourcemaps.write("."))
		.pipe(
			exec(`cd ${gp.js.dest} || return && find . -type f ! -name \"*.min.js\" -exec rm -rf {} \\;`)
		);
});

/**
 * Generate:
 *  - default `gulp` task
 *  - Undertaker.series(...tasks: Undertaker.Task[])
 *  - FSWatcher
 *
 * @function watchFiles(done: any): void
 * @param    null
 * @method   (globs: GulpClient.Globs, fn?: Undertaker.TaskFunction) => FSWatcher (+1 overload)
 * @property GulpClient.Gulp.watch: GulpClient.WatchMethod
 */
gulp.task(
	"default",
	gulp.series(
		gp.docker.active ? "dockerInit" : emptiness,
		gp.style.active ? "styles" : emptiness,
		gp.js.active ? "es6" : emptiness,
		gp.browserSync.active ? browsersync : emptiness,
		() => {
			gp.style.active ? gulp.watch(gp.watch.scss, gulp.series("styles", reload)) : ""; // Inject CSS changes
			gp.watch.html.active ? gulp.watch(gp.watch.html.path, reload) : ""; // Reload on HTML changes
			gp.watch.php.active ? gulp.watch(gp.watch.php.path, reload) : ""; // Reload on PHP changes
			gp.js.active ? gulp.watch(gp.js.src, gulp.series("es6", reload)) : ""; // Reload on JS changes
			gp.imagemin.active ? gulp.watch(gp.imagemin.src, reload) : ""; // Optimize on Img changes
		}
	)
);
