<?php
/** Integration checks against a running WordPress database; fixtures are removed. */
if ( PHP_SAPI !== 'cli' ) {
	http_response_code( 403 );
	exit;
}
require dirname( __DIR__ ) . '/wp-load.php';

function physio_team_check( $condition, $message ) {
	if ( ! $condition ) {
		throw new RuntimeException( $message );
	}
	echo 'PASS: ' . $message . PHP_EOL;
}

$fixtures = array();
$original_user = get_current_user_id();
$original_post = $_POST;
$failed = false;
try {
	$type = get_post_type_object( 'physio_team' );
	physio_team_check( $type && $type->show_ui && $type->show_in_rest && ! $type->publicly_queryable && ! $type->has_archive, 'Team management enabled, public singles disabled' );
	physio_team_check( post_type_supports( 'physio_team', 'thumbnail' ) && post_type_supports( 'physio_team', 'editor' ), 'Editable portraits and biographies' );
	$admins = get_users( array( 'role' => 'administrator', 'number' => 1 ) );
	physio_team_check( (bool) $admins, 'Administrator available for save checks' );
	wp_set_current_user( $admins[0]->ID );
	$id = wp_insert_post( array( 'post_type' => 'physio_team', 'post_status' => 'draft', 'post_title' => 'Team Test <em>Portrait</em>', 'menu_order' => 9002 ), true );
	physio_team_check( ! is_wp_error( $id ), 'Temporary employee created' );
	$fixtures[] = $id;
	$_POST = array(
		'physio_team_nonce'       => wp_create_nonce( 'physio_team_save_' . $id ),
		'_physio_team_role'       => "Manualtherapie\n<strong>Therapie</strong>",
		'_physio_team_featured'   => '1',
		'_physio_team_link'       => 'javascript:alert(1)',
		'_physio_team_link_label' => '<b>Mehr erfahren</b>',
	);
	physio_team_save_meta( $id );
	physio_team_check( "Manualtherapie\nTherapie" === get_post_meta( $id, '_physio_team_role', true ), 'Role sanitized, line breaks retained' );
	physio_team_check( (bool) get_post_meta( $id, '_physio_team_featured', true ), 'Featured selection saved' );
	physio_team_check( '' === get_post_meta( $id, '_physio_team_link', true ), 'Unsafe URL rejected' );
	physio_team_check( 'Mehr erfahren' === get_post_meta( $id, '_physio_team_link_label', true ), 'Link label sanitized' );
	$_POST['_physio_team_featured'] = '0';
	physio_team_save_meta( $id );
	physio_team_check( ! get_post_meta( $id, '_physio_team_featured', true ), 'Featured selection can be removed' );
	$_POST['physio_team_nonce'] = 'invalid';
	$_POST['_physio_team_role'] = 'Must not save';
	physio_team_save_meta( $id );
	physio_team_check( "Manualtherapie\nTherapie" === get_post_meta( $id, '_physio_team_role', true ), 'Invalid nonce cannot change employee' );
	$_POST = array();
	physio_team_save_meta( $id );
	physio_team_check( "Manualtherapie\nTherapie" === get_post_meta( $id, '_physio_team_role', true ), 'Requests without meta box preserve data' );
	$_POST = array( 'physio_team_nonce' => wp_create_nonce( 'physio_team_save_' . $id ), '_physio_team_role' => 'Unauthorized' );
	wp_set_current_user( 0 );
	physio_team_save_meta( $id );
	physio_team_check( "Manualtherapie\nTherapie" === get_post_meta( $id, '_physio_team_role', true ), 'Anonymous requests cannot change employee' );
	physio_team_check( ! physio_team_authorize_meta( true, '_physio_team_role', $id ), 'Anonymous metadata access denied' );
	$denied = rest_do_request( new WP_REST_Request( 'GET', '/wp/v2/physio_team' ) );
	physio_team_check( $denied->get_status() >= 400, 'Anonymous REST employee list denied' );
	wp_set_current_user( $admins[0]->ID );
	physio_team_check( physio_team_authorize_meta( false, '_physio_team_role', $id ), 'Authorized editor may edit metadata' );
	$request = new WP_REST_Request( 'POST', '/wp/v2/physio_team/' . $id );
	$request->set_param( 'meta', array( '_physio_team_role' => 'REST therapy', '_physio_team_featured' => true ) );
	$response = rest_do_request( $request );
	physio_team_check( 200 === $response->get_status() && 'REST therapy' === get_post_meta( $id, '_physio_team_role', true ), 'REST updates persist editable fields' );
	$_POST = array();
	$published = wp_insert_post( array( 'post_type' => 'physio_team', 'post_status' => 'publish', 'post_title' => 'Team Test Published', 'menu_order' => 9001 ) );
	$fixtures[] = $published;
	$results = get_posts( array( 'post_type' => 'physio_team', 'post_status' => 'publish', 'post__in' => $fixtures, 'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ) ) );
	physio_team_check( array( $published ) === wp_list_pluck( $results, 'ID' ), 'Unpublished employees excluded from frontend query' );
	wp_update_post( array( 'ID' => $id, 'post_status' => 'publish' ) );
	$results = get_posts( array( 'post_type' => 'physio_team', 'post_status' => 'publish', 'post__in' => $fixtures, 'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ) ) );
	physio_team_check( array( $published, $id ) === wp_list_pluck( $results, 'ID' ), 'Manual employee ordering respected' );
	ob_start();
	get_template_part( 'template-parts/team-card', null, array( 'member' => get_post( $id ) ) );
	$card = ob_get_clean();
	physio_team_check( str_contains( $card, 'Foto folgt' ) && str_contains( $card, '&lt;em&gt;Portrait&lt;/em&gt;' ), 'Missing portrait fallback and escaped employee name render' );
	$css = file_get_contents( get_template_directory() . '/assets/css/tailwind.css' );
	foreach ( array( '.md\\:grid-cols-2', '.md\\:grid-cols-3', '.bg-accent-dark', '.text-accent-dark', '.rounded-full' ) as $utility ) {
		physio_team_check( str_contains( $css, $utility ), 'Compiled Tailwind utility ' . $utility );
	}
} catch ( Throwable $error ) {
	fwrite( STDERR, 'FAIL: ' . $error->getMessage() . PHP_EOL );
	$failed = true;
} finally {
	$_POST = array();
	foreach ( $fixtures as $fixture ) {
		wp_delete_post( $fixture, true );
	}
	$_POST = $original_post;
	wp_set_current_user( $original_user );
}
exit( $failed ? 1 : 0 );