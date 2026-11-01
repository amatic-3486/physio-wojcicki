<?php
/**
 * Diagnostic helper: verifies that ".env" can be found and parsed correctly,
 * WITHOUT ever printing secret values in full.
 *
 * Upload this file to the server (next to wp-config.php) and open it once in
 * the browser (or run via SSH: `php bin/check-env.php`), then DELETE it
 * again afterwards - it is meant for temporary troubleshooting only.
 *
 * Usage:
 *     php bin/check-env.php
 *
 * What it checks:
 *   - Whether ".env" exists and is readable in the expected directory.
 *   - Whether it looks like plain UTF-8 text (flags BOM / UTF-16 encoding,
 *     which silently corrupts values such as DB_PASSWORD and causes MySQL
 *     "Access denied ... (using password: YES)" errors).
 *   - For each required DB_* key: whether it was found, its length, and a
 *     short hash (so you can compare it against the value in your hosting
 *     panel without exposing the secret itself).
 */

$root    = dirname( __DIR__ );
$envFile = $root . '/.env';

echo "Checking: $envFile\n\n";

if ( ! file_exists( $envFile ) ) {
    echo "FAIL: \".env\" does not exist in this directory.\n";
    echo "      Make sure it was uploaded to exactly this folder (same folder as wp-config.php),\n";
    echo "      and that it is named exactly \".env\" (not \".env.txt\" or \"env\").\n";
    exit( 1 );
}

if ( ! is_readable( $envFile ) ) {
    echo "FAIL: \".env\" exists but is not readable (check file permissions).\n";
    exit( 1 );
}

$raw = file_get_contents( $envFile );

if ( false === $raw || '' === $raw ) {
    echo "FAIL: \".env\" is empty or could not be read.\n";
    exit( 1 );
}

echo "OK: \".env\" found (" . strlen( $raw ) . " bytes).\n";

if ( 0 === strncmp( $raw, "\xFF\xFE", 2 ) ) {
    echo "WARNING: file starts with a UTF-16LE BOM. If you are on an older\n";
    echo "         wp-config.php without encoding normalization, this WILL\n";
    echo "         corrupt every value (e.g. DB_PASSWORD) with NUL bytes.\n";
} elseif ( 0 === strncmp( $raw, "\xFE\xFF", 2 ) ) {
    echo "WARNING: file starts with a UTF-16BE BOM (same risk as above).\n";
} elseif ( 0 === strncmp( $raw, "\xEF\xBB\xBF", 3 ) ) {
    echo "NOTE: file starts with a UTF-8 BOM. This is handled, but it's\n";
    echo "      cleaner to re-save the file as \"UTF-8 without BOM\".\n";
} else {
    echo "OK: no byte-order-mark detected (plain UTF-8/ASCII).\n";
}

if ( false !== strpos( $raw, "\0" ) ) {
    echo "WARNING: NUL bytes found in the raw file content.\n";
}

// Parse exactly like wp-config.php does.
$contents = $raw;
if ( 0 === strncmp( $contents, "\xFF\xFE", 2 ) ) {
    $contents = mb_convert_encoding( substr( $contents, 2 ), 'UTF-8', 'UTF-16LE' );
} elseif ( 0 === strncmp( $contents, "\xFE\xFF", 2 ) ) {
    $contents = mb_convert_encoding( substr( $contents, 2 ), 'UTF-8', 'UTF-16BE' );
} elseif ( 0 === strncmp( $contents, "\xEF\xBB\xBF", 3 ) ) {
    $contents = substr( $contents, 3 );
}
$contents = str_replace( "\0", '', $contents );

$env = array();
foreach ( preg_split( "/\r\n|\n|\r/", $contents ) as $line ) {
    $line = trim( $line );
    if ( '' === $line || '#' === $line[0] || false === strpos( $line, '=' ) ) {
        continue;
    }
    list( $name, $value ) = explode( '=', $line, 2 );
    $name  = trim( $name );
    $value = trim( $value );
    if ( strlen( $value ) > 1 && in_array( $value[0], array( '"', "'" ), true ) && substr( $value, -1 ) === $value[0] ) {
        $value = substr( $value, 1, -1 );
    }
    $env[ $name ] = $value;
}

echo "\nParsed keys (" . count( $env ) . "):\n";

$required = array( 'DB_NAME', 'DB_USER', 'DB_PASSWORD', 'DB_HOST' );

foreach ( $required as $key ) {
    if ( ! array_key_exists( $key, $env ) || '' === $env[ $key ] ) {
        echo "  FAIL: $key is missing or empty.\n";
        continue;
    }

    $value = $env[ $key ];

    if ( 'DB_PASSWORD' === $key ) {
        echo "  OK: $key found, length=" . strlen( $value ) . ", sha1=" . substr( sha1( $value ), 0, 10 ) . "...\n";
        echo "      (compare this length/hash against the password you set in your hosting panel)\n";
    } else {
        echo "  OK: $key = \"$value\"\n";
    }
}

echo "\nDone. Delete this file from the server when you're finished troubleshooting.\n";
