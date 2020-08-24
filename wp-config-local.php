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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'black' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/** Set local URL */
define( 'WP_HOME', 'http://localhost/black' );
define( 'WP_SITEURL', 'http://localhost/black' );


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'v;mD<45xi::)bt5;a{!W{MgtR`fLjSBG4xR|4F($P-c^`bN0q[2E;t|W/vf2OuAQ');
define('SECURE_AUTH_KEY',  'R#oMVW(pm1tp+x&9cIY5Jy4+&~r+NOZYe.Q1?f!azPNj[}8.NEdrQ++Gjy7ksf1W');
define('LOGGED_IN_KEY',    'z`3dl-0tly5IYX#sX  T13^p;q(KiI`E3hZ?b,nZWMo_wta>]h7bHU6k:^uM9<<G');
define('NONCE_KEY',        '!hTwAqE+<Id#X-*o}qTCaMTs[?BJ?c._^wQ:63W-UV$lMs-KRgCh$L7E(uQI{r0)');
define('AUTH_SALT',        'AewRr|6!D(uz/$Z|bv47@cbul/I?mfH}bXiOdY/2U|U)r^NuS:dTDfm(^R,e:74z');
define('SECURE_AUTH_SALT', 'f+5$zzd+yQWb=w@|~eb]VF]BKL<|xIs9f](`LK,GOJ!N/~8/4mZ<`Vwds;tM|hsf');
define('LOGGED_IN_SALT',   '*FP+*}Jp2Bq0h<;A`MF@V6%+3anzNijV}j&JyY|Q%NMsn/OS0r5APO+<GL>a!6~$');
define('NONCE_SALT',       '0%9ls@*Z5+EO0vVNn^&b)HPYJP](LU-Ai>8Iokc!7Q0kl--gN7 [fqG&#%F>}C,:');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
