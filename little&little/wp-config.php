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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_demowordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '2Afb7{%tcQ_-eRja(zVCxwV9{L-irBSCfW imdLNH D1V:>8i:Y:i51(pw>y!n)1' );
define( 'SECURE_AUTH_KEY',  'L2P^4/rijINk(H:>7:]H:?&HE]vE}(u<4-W3AJ&r*|h,ktv>xwO:GmTM#.kvNvn:' );
define( 'LOGGED_IN_KEY',    'Sh(Qd$Z2!d0phPolg$8kK&u#7oY*h?3OH5aB{#G7@{0[lj}l/K[9VV@:jMf;19SY' );
define( 'NONCE_KEY',        'go7A9q3^Uw%GI-9OwAF1dC[ydobn6EcS}.}u@{GZNMUxjP#XsESJuQy:Onc#1]%+' );
define( 'AUTH_SALT',        ',3MhD+e2@=KD,G4:{Fbw3J9_Ixw;Nq?4pp[$-af{diP[X~=o7<elANp+k5;[l,cw' );
define( 'SECURE_AUTH_SALT', 'pvQ!6{+kOFmwhLE0J1I}y_r^OD!TlqP2Qao1PtB<%WZ{N9JYSV;eqv,i!jO5WKRi' );
define( 'LOGGED_IN_SALT',   'k|]X)P3W?qef(C_fPwn^r*<ak=21;B)AD&N>c)$t2]qG$agtS-vH<oa:Q{/VBpc?' );
define( 'NONCE_SALT',       'Lg7_!Ffc$#aqtcDuaS$g8aO`K-qz[8!y0NdxU$Dk6.&kV0xj!85fIx}H.uQ8r^Nx' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
