<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'lesto' );

/** Database username */
define( 'DB_USER', 'lesto' );

/** Database password */
define( 'DB_PASSWORD', 'sFl1jsl3edDEsjj' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'W=jpx!1d _}xQ5lUE}32b7wR[?~koMcsmNY$fG R,,S/bpeC5c={1#G-cX`82XJ-' );
define( 'SECURE_AUTH_KEY',   'ud1~+H} j <bkUWYAnM#:EO:ncaSY|5yNC(r-~?i/,w,kt6+b9I9Y g$i=kD9#D8' );
define( 'LOGGED_IN_KEY',     'ze6_4/(9(c~7(p 8P=hKQ#$c$X`W_,(sk&*9{8oqc&e:.nyUUuL)(RdHh5br1$ =' );
define( 'NONCE_KEY',         ';TfAcD*sCthu|h.6}%`}+n@aXQ{6GehrLN6q#,U5$@{*4MtA4)ae,& 60Gbo>^cc' );
define( 'AUTH_SALT',         'XkX?mrzF5XbSXnl-28{X]CA>9nPZ.ypN.nD/-K#l*8{Qfy)a,<gLmL M$%_zI5~f' );
define( 'SECURE_AUTH_SALT',  '$Ay.Gm1FDx}cp5,hZh6l*~V ux&WVm<,&Zlojo@%M0UJCzWH40{gl9G5N-Rtp1KY' );
define( 'LOGGED_IN_SALT',    '=ypG+sxm^x~9uuiUR8mG%)/&[=|H#I{tc.*uc|VNK/ekX`+,2bB,1v79>V|$3K|C' );
define( 'NONCE_SALT',        'by_cJQ*Dsr1IuNPPc82Leu@RNd_8Z*!Hp-H)kJa%P*v*{<Y+[/|Q)x>}5KaZ #wr' );
define( 'WP_CACHE_KEY_SALT', 'FNE<wZ_ovXK5-Cw=(~QH+$]TVsJ6*m`9o#M=yw$8Gj?~vzNpe9`r?Gzg-1fLpbwO' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', true );
}

define( 'WPLANG', 'it_IT' );
define( 'WP_MAIL_INTERVAL', '9999999' );
define( 'FS_METHOD', 'direct' );
define( 'FS_CHMOD_DIR', 0775 );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
