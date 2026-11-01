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

if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
    // If the local file exists, load it
    include( dirname( __FILE__ ) . '/local-config.php' );
} else {
    // Otherwise, use Production credentials
    define( 'DB_NAME',     'db_prod' );
    define( 'DB_USER',     'db_prod_user' );
    define( 'DB_PASSWORD', 'jNe6fZ2M?$wxjny3' );
    define( 'DB_HOST',     'strato' );

    define( 'WP_HOME', 'https://physiotherapie-wojcicki.de' );
    define( 'WP_SITEURL', 'https://physiotherapie-wojcicki.de' );

    define( 'WP_DEBUG', false );
}




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
define( 'AUTH_KEY',          '!6onc9:smq!=l0Z.2Q2^lf<ARABWvQ4Ir$?A4uw=0IjqtMgswIMlPOgWR5!(9qFD' );
define( 'SECURE_AUTH_KEY',   'i)FfaoV#Y3m){n<e~+YS(F{a&+FF$OQUl*#.`KyN.Za6}nLwmm%0Rk5+ABuFSv`l' );
define( 'LOGGED_IN_KEY',     '+Jz7u2z+f*  +ex8hbD_C0oM{~8YF42[gj90M>j LKXwtD!)Px,~hy8+-v+Jf%vV' );
define( 'NONCE_KEY',         '9y/s582M<Juiu6]lsJ5xrl[dQCe2Qvo+nB;TtLuCIMR?O1mO;LXB5j.cEzy_mw|N' );
define( 'AUTH_SALT',         'z]+G`S.3&pOzbIr2qBSgsALKXS)7C)TZP/trI:fd+(y_z`1~(,cJW+_HF|rFCh2W' );
define( 'SECURE_AUTH_SALT',  '@([rgCX;6/TWV&ohB=rL>8_#t@Qap4{<IfL$[)iJ]kX)`f6CV)gYVj}2+S{LLQ.(' );
define( 'LOGGED_IN_SALT',    'Y0yX|USZ%@+^CFAq|24yf@YY~.J7rLY~Z4D&Gh}U;6Oq/`Rm(f`gqh10UVTfn{S5' );
define( 'NONCE_SALT',        '?LCM)VM^sqR48?q9ve,SxM/zxE|u2-+tP r$HI6om&uFGbQy$1G,4q}P3Z5LZ9;Y' );
define( 'WP_CACHE_KEY_SALT', 'bA.}J0xdb%6YRfHb.{ 1R9q]k}jV7E:HQxjpev&0U[.)w#I[:n^=_h^WN5w6sTkE' );

define( 'WPCF7_AUTOP', false );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';