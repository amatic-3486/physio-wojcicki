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

/**
 * Load environment variables from a local ".env" file (never committed to
 * version control, see .gitignore) into PHP's environment, so credentials
 * no longer need to be hard-coded in this file. See ".env.example" for the
 * list of supported variables.
 */
if ( ! function_exists( 'physio_wojcicki_load_dotenv' ) ) {
    function physio_wojcicki_load_dotenv( $path ) {
        if ( ! is_readable( $path ) ) {
            return;
        }

        foreach ( file( $path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ) as $line ) {
            $line = trim( $line );

            if ( '' === $line || '#' === $line[0] || false === strpos( $line, '=' ) ) {
                continue;
            }

            list( $name, $value ) = explode( '=', $line, 2 );
            $name  = trim( $name );
            $value = trim( $value );

            // Strip optional surrounding quotes.
            if ( strlen( $value ) > 1 && in_array( $value[0], array( '"', "'" ), true ) && substr( $value, -1 ) === $value[0] ) {
                $value = substr( $value, 1, -1 );
            }

            if ( false === getenv( $name ) ) {
                putenv( "$name=$value" );
                $_ENV[ $name ]    = $value;
                $_SERVER[ $name ] = $value;
            }
        }
    }
}

if ( ! function_exists( 'wp_env' ) ) {
    /**
     * Reads a value loaded from ".env", with an optional default and
     * automatic boolean/null casting for common string representations.
     */
    function wp_env( $key, $default = null ) {
        $value = getenv( $key );

        if ( false === $value || '' === $value ) {
            return $default;
        }

        switch ( strtolower( $value ) ) {
            case 'true':
                return true;
            case 'false':
                return false;
            case 'null':
                return null;
        }

        return $value;
    }
}

physio_wojcicki_load_dotenv( dirname( __FILE__ ) . '/.env' );

if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
    // If the local file exists, load it
    include( dirname( __FILE__ ) . '/local-config.php' );
} else {
    // Otherwise, use Production credentials (provided via .env)
    $physio_wojcicki_db_name     = wp_env( 'DB_NAME' );
    $physio_wojcicki_db_user     = wp_env( 'DB_USER' );
    $physio_wojcicki_db_password = wp_env( 'DB_PASSWORD' );
    $physio_wojcicki_db_host     = wp_env( 'DB_HOST' );

    // Fail fast with a clear, actionable message instead of WordPress's
    // generic "Error establishing a database connection" screen whenever the
    // required DB_* variables could not be read from ".env" (missing file,
    // wrong directory, wrong filename, etc.).
    if ( empty( $physio_wojcicki_db_name ) || empty( $physio_wojcicki_db_user ) || empty( $physio_wojcicki_db_host ) ) {
        if ( ! headers_sent() ) {
            header( 'Content-Type: text/plain; charset=utf-8' );
            http_response_code( 500 );
        }

        die(
            "Configuration error: Database credentials (DB_NAME/DB_USER/DB_HOST) are missing.\n\n" .
            "WordPress could not read them from a \".env\" file. Make sure a file named exactly\n" .
            "\".env\" (not \".env.txt\" or \"env\") exists in this exact directory:\n\n" .
            '    ' . dirname( __FILE__ ) . "\n\n" .
            "and contains at least DB_NAME, DB_USER, DB_PASSWORD and DB_HOST (see \".env.example\").\n"
        );
    }

    define( 'DB_NAME',     $physio_wojcicki_db_name );
    define( 'DB_USER',     $physio_wojcicki_db_user );
    define( 'DB_PASSWORD', $physio_wojcicki_db_password );
    define( 'DB_HOST',     $physio_wojcicki_db_host );

    define( 'WP_HOME', wp_env( 'WP_HOME', 'https://physiotherapie-wojcicki.de' ) );
    define( 'WP_SITEURL', wp_env( 'WP_SITEURL', 'https://physiotherapie-wojcicki.de' ) );

    define( 'WP_DEBUG', wp_env( 'WP_DEBUG', false ) );
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
define( 'AUTH_KEY',          wp_env( 'AUTH_KEY' ) );
define( 'SECURE_AUTH_KEY',   wp_env( 'SECURE_AUTH_KEY' ) );
define( 'LOGGED_IN_KEY',     wp_env( 'LOGGED_IN_KEY' ) );
define( 'NONCE_KEY',         wp_env( 'NONCE_KEY' ) );
define( 'AUTH_SALT',         wp_env( 'AUTH_SALT' ) );
define( 'SECURE_AUTH_SALT',  wp_env( 'SECURE_AUTH_SALT' ) );
define( 'LOGGED_IN_SALT',    wp_env( 'LOGGED_IN_SALT' ) );
define( 'NONCE_SALT',        wp_env( 'NONCE_SALT' ) );
define( 'WP_CACHE_KEY_SALT', wp_env( 'WP_CACHE_KEY_SALT' ) );

define( 'WPCF7_AUTOP', false );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = wp_env( 'DB_TABLE_PREFIX', 'wp_' );


/* Add any custom values between this line and the "stop editing" line. */



define( 'WP_ENVIRONMENT_TYPE', wp_env( 'WP_ENVIRONMENT_TYPE', 'local' ) );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';