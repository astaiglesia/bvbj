<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

/**
 * ƒ pantheonConfig => Pantheon wp-config
 *
 * pantheon.io WordPress specific configurations
 *
 * @param       null
 * @return      null
 */
function pantheonConfig() {
	// ƒ Guard => Only run on Pantheon
	if ( !isset($_ENV['PANTHEON_ENVIRONMENT']) ) { return; }

	// Limit revisions number
	define( 'WP_POST_REVISIONS', 10 );

	/* Auto Save Posts Configuration */
	define('AUTOSAVE_INTERVAL', 120);

	/* Purge Trash */
	define('EMPTY_TRASH_DAYS', 15 );

	// ** MySQL settings - included in the Pantheon Environment ** //
	/** The name of the database for WordPress */
	define('DB_NAME', $_ENV['DB_NAME']);

	/** MySQL database username */
	define('DB_USER', $_ENV['DB_USER']);

	/** MySQL database password */
	define('DB_PASSWORD', $_ENV['DB_PASSWORD']);

	/** MySQL hostname; on Pantheon this includes a specific port number. */
	define('DB_HOST', $_ENV['DB_HOST'] . ':' . $_ENV['DB_PORT']);

	/** Database Charset to use in creating database tables. */
	define('DB_CHARSET', 'utf8');

	/** The Database Collate type. Don't change this if in doubt. */
	define('DB_COLLATE', '');

	/**#@+
	 * Authentication Unique Keys and Salts.
	 *
	 * Change these to different unique phrases!
	 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
	 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
	 *
	 * Pantheon sets these values for you also. If you want to shuffle them you
	 * must contact support: https://pantheon.io/docs/getting-support
	 *
	 * @since 2.6.0
	 */
	define('AUTH_KEY',         $_ENV['AUTH_KEY']);
	define('SECURE_AUTH_KEY',  $_ENV['SECURE_AUTH_KEY']);
	define('LOGGED_IN_KEY',    $_ENV['LOGGED_IN_KEY']);
	define('NONCE_KEY',        $_ENV['NONCE_KEY']);
	define('AUTH_SALT',        $_ENV['AUTH_SALT']);
	define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT']);
	define('LOGGED_IN_SALT',   $_ENV['LOGGED_IN_SALT']);
	define('NONCE_SALT',       $_ENV['NONCE_SALT']);
	/**#@-*/

	/** A couple extra tweaks to help things run well on Pantheon. **/
	if (isset($_SERVER['HTTP_HOST'])) {
			// HTTP is still the default scheme for now.
			$scheme = 'http';
			// If we have detected that the end use is HTTPS, make sure we pass that
			// through here, so <img> tags and the like don't generate mixed-mode
			// content warnings.
			if (isset($_SERVER['HTTP_USER_AGENT_HTTPS']) && $_SERVER['HTTP_USER_AGENT_HTTPS'] == 'ON') {
					$scheme = 'https';
			}
			define('WP_HOME', $scheme . '://' . $_SERVER['HTTP_HOST']);
			define('WP_SITEURL', $scheme . '://' . $_SERVER['HTTP_HOST']);
	}
	// Don't show deprecations; useful under PHP 5.5
	error_reporting(E_ALL ^ E_DEPRECATED);
	// Force the use of a safe temp directory when in a container
	if ( defined( 'PANTHEON_BINDING' ) ){
		define( 'WP_TEMP_DIR', sprintf( '/srv/bindings/%s/tmp', PANTHEON_BINDING ) );
	}

	// FS writes aren't permitted in test or live, so we should let WordPress know to disable relevant UI
	if ( in_array( $_ENV['PANTHEON_ENVIRONMENT'], array( 'test', 'live' ) ) && ! defined( 'DISALLOW_FILE_MODS' ) ) {
		define( 'DISALLOW_FILE_MODS', true );
	}

	// Pantheon - all (web and CLI) operations.
	if (defined('PANTHEON_ENVIRONMENT')) {
		// Only on dev environment.
		if (PANTHEON_ENVIRONMENT == 'dev') {
			/*================================================
			/* Developer Environment
			/*==============================================*/
			// Turn debugging on
			define('WP_DEBUG', true);

			// Tell WordPress to log everything to /wp-content/debug.log
			define('WP_DEBUG_LOG', true);

			// Turn off the display of error messages on your site
			define('WP_DEBUG_DISPLAY', false);

			// For good measure, you can also add the follow code, which will hide errors from being displayed on-screen
			@ini_set('display_errors', 0);
		} else {
			define('WP_DEBUG', false);
			define('WP_DEBUG_LOG', true);
			define('WP_DEBUG_DISPLAY', false);
			@ini_set('display_errors', 0);
		}
	}

	//================================================
	// Pantheon Redirect to HTTPS and the primary domain
	//================================================
	if (isset($_SERVER['PANTHEON_ENVIRONMENT']) && php_sapi_name() != 'cli') {
		// Redirect to https://$primary_domain in the Live environment
		if ($_ENV['PANTHEON_ENVIRONMENT'] === 'live') {
			/** Replace www.example.com with your registered domain name */
			$primary_domain = 'REPLACEME';
		}
		else {
			// Redirect to HTTPS on every Pantheon environment.
			$primary_domain = $_SERVER['HTTP_HOST'];
		}

		if ($_SERVER['HTTP_HOST'] != $primary_domain
				|| !isset($_SERVER['HTTP_X_SSL'])
				|| $_SERVER['HTTP_X_SSL'] != 'ON' ) {

			# Name transaction "redirect" in New Relic for improved reporting (optional)
			if (extension_loaded('newrelic')) {
				newrelic_name_transaction("redirect");
			}

			header('HTTP/1.0 301 Moved Permanently');
			header('Location: https://'. $primary_domain . $_SERVER['REQUEST_URI']);
			exit();
		}
	}
} // END pantheonConfig()

/**
 * ƒ fallbackConfig => Additional config if not on local and not on pantheon
 *
 * Fallback WordPress configurations
 *
 * @param       null
 * @return      null
 */
function fallbackConfig() {
	// ƒ Guard => Only run on NON pantheon hosts
	if ( isset($_ENV['PANTHEON_ENVIRONMENT']) ) { return; }

	/**
	 * This block will be executed if you have NO wp-config-local.php and you
	 * are NOT running on Pantheon. Insert alternate config here if necessary.
	 *
	 * If you are only running on Pantheon, you can ignore this block.
	 */

	define('WP_HOME','https://example.com/');
	define('WP_SITEURL','https://example.com/');

	define('WP_MEMORY_LIMIT', '256M');

	define('DB_NAME','DATABASE-NAME');

	/** MySQL database username */
	define('DB_USER', 'DATABASE-USER-NAME');

	/** MySQL database password */
	define('DB_PASSWORD','DATABASE-PWD');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');

	/** Database Charset to use in creating database tables. */
	define('DB_CHARSET', 'utf8');

	/** The Database Collate type. Don't change this if in doubt. */
	define('DB_COLLATE', '');


	/**#@+
	 * Authentication Unique Keys and Salts.
	 *
	 * Change these to different unique phrases!
	 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
	 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
	 *
	 * @since 2.6.0
	 */
	define('AUTH_KEY',         'put your unique phrase here');
	define('SECURE_AUTH_KEY',  'put your unique phrase here');
	define('LOGGED_IN_KEY',    'put your unique phrase here');
	define('NONCE_KEY',        'put your unique phrase here');
	define('AUTH_SALT',        'put your unique phrase here');
	define('SECURE_AUTH_SALT', 'put your unique phrase here');
	define('LOGGED_IN_SALT',   'put your unique phrase here');
	define('NONCE_SALT',       'put your unique phrase here');

	/**#@-*/

	/**
	 * For developers: WordPress debugging mode.
	 *
	 * Change this to true to enable the display of notices during development.
	 * It is strongly recommended that plugin and theme developers use WP_DEBUG
	 * in their development environments.
	 *
	 * For information on other constants that can be used for debugging,
	 * visit the Codex.
	 *
	 * @link https://codex.wordpress.org/Debugging_in_WordPress
	 */

	// Turn debugging on
	define('WP_DEBUG', false);

	// Tell WordPress to log everything to /wp-content/debug.log
	define('WP_DEBUG_LOG', false);

	// Turn off the display of error messages on your site
	define('WP_DEBUG_DISPLAY', false);

} // END fallbackConfig()

/**
 * Load wp-config
 */
if (file_exists(dirname(__FILE__) . '/wp-config-local.php')) {
	include(dirname(__FILE__) . '/wp-config-local.php');
} else {
	// Are we in pantheon?
	$isPantheon = isset($_ENV['PANTHEON_ENVIRONMENT']);

	/**
	 * Load in Pantheon Config || Fallback Config
	 */
	$isPantheon ? pantheonConfig() : fallbackConfig();

	/**
	 * WordPress Database Table prefix.
	 *
	 * You can have multiple installations in one database if you give each a unique
	 * prefix. Only numbers, letters, and underscores please!
	 */
	$table_prefix = 'wp_';

	/**
	 * WordPress Localized Language, defaults to English.
	 *
	 * Change this to localize WordPress. A corresponding MO file for the chosen
	 * language must be installed to wp-content/languages. For example, install
	 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
	 * language support.
	 */
	define('WPLANG', '');
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
