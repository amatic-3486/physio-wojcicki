<?php
/** Contact Form 7 integration checks. No email is sent. */
if ( PHP_SAPI !== 'cli' ) {
	http_response_code( 403 );
	exit;
}
require dirname( __DIR__ ) . '/wp-load.php';

function physio_contact_check( $condition, $message ) {
	if ( ! $condition ) {
		throw new RuntimeException( $message );
	}
	echo 'PASS: ' . $message . PHP_EOL;
}

try {
	physio_contact_check( class_exists( 'WPCF7_ContactForm' ), 'Contact Form 7 is active' );
	foreach ( WPCF7_ContactForm::find() as $existing ) {
		echo 'Available form: ' . $existing->title() . PHP_EOL;
	}
	physio_contact_check( function_exists( 'physio_wojcicki_contact_form' ), 'Theme integrates Contact Form 7' );
	$form = physio_wojcicki_contact_form();
	physio_contact_check( $form instanceof WPCF7_ContactForm, 'Contact form exists' );
	foreach ( physio_wojcicki_contact_form_messages() as $key => $message ) {
		physio_contact_check( isset( wpcf7_messages()[ $key ] ) && '' !== $message, 'Supported response message: ' . $key );
	}
	$html = do_shortcode( '[contact-form-7 id="' . $form->id() . '"]' );
	physio_contact_check( str_contains( $html, 'wpcf7-form' ) && ! str_contains( $html, '[text*' ), 'Plugin renders the form' );
	foreach ( array( 'your-name' => 'text*', 'your-email' => 'email*', 'your-message' => 'textarea*' ) as $name => $type ) {
		$tags = $form->scan_form_tags( array( 'name' => $name ) );
		physio_contact_check( count( $tags ) === 1 && $type === $tags[0]->type, 'Required field: ' . $name );
		physio_contact_check( str_contains( $html, 'name="' . $name . '"' ) && str_contains( $html, 'aria-required="true"' ), 'Accessible rendered field: ' . $name );
	}
	$mail = $form->prop( 'mail' );
	physio_contact_check( physio_wojcicki_contact( 'email' ) === $mail['recipient'], 'Messages addressed to the practice' );
	physio_contact_check( str_contains( $mail['additional_headers'], 'Reply-To: [your-email]' ), 'Replies addressed to the visitor' );
	physio_contact_check( ! has_action( 'admin_post_nopriv_physio_contact' ) && ! has_action( 'admin_post_physio_contact' ), 'Legacy mail handlers removed' );
	$validator = new WPCF7_ConfigValidator( $form );
	$validator->validate();
	physio_contact_check( ! $validator->collect_error_messages(), 'Contact Form 7 configuration is valid' );
	$css = file_get_contents( get_template_directory() . '/assets/css/tailwind.css' );
	foreach ( array( '.md\\:grid-cols-2', '.w-full', '.rounded-xl', '.bg-accent-dark', '.px-7', '.py-3' ) as $utility ) {
		physio_contact_check( str_contains( $css, $utility ), 'Compiled utility: ' . $utility );
	}
	physio_contact_check( 3 === substr_count( $html, 'physio-contact-field w-full rounded-xl border bg-white px-4 py-3' ), 'Field styling survives plugin class sanitization' );
	if ( isset( $argv[1] ) ) {
		$mode = $argv[1];
		physio_contact_check( in_array( $mode, array( 'empty', 'invalid-email', 'valid' ), true ), 'Known submission test case' );
		$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
		$_SERVER['HTTP_USER_AGENT'] = 'Physio integration test';
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST = array(
			'_wpcf7_unit_tag' => 'wpcf7-f' . $form->id() . '-o1',
			'your-name'       => 'empty' === $mode ? '' : 'Integration Test',
			'your-email'      => 'valid' === $mode ? 'test@example.org' : 'invalid',
			'your-message'    => 'empty' === $mode ? '' : 'Testnachricht – nicht versenden.',
		);
		// Stop before spam/mail processing; test input validation without sending mail.
		$validated = false;
		add_filter( 'wpcf7_validate', static function ( $result ) use ( &$validated ) {
			$validated = $result->is_valid();
			return $result;
		}, 999 );
		add_filter( 'wpcf7_spam', '__return_true', 999 );
		add_filter( 'pre_wp_mail', static function () {
			throw new RuntimeException( 'Tests must never send email.' );
		} );
		$result = $form->submit();
		$response_key = 'valid' === $mode ? 'spam' : 'validation_error';
		physio_contact_check( $result['message'] === $form->message( $response_key ), 'Submission uses the backend-editable response message' );
		if ( 'valid' === $mode ) {
			physio_contact_check( $validated && 'spam' === $result['status'], 'Valid input passes validation and is stopped before email delivery' );
		} else {
			physio_contact_check( ! $validated && 'validation_failed' === $result['status'], 'Invalid input rejected: ' . $mode );
			$fields = array_keys( $result['invalid_fields'] );
			$expected = 'empty' === $mode ? array( 'your-name', 'your-email', 'your-message' ) : array( 'your-email' );
			physio_contact_check( ! array_diff( $expected, $fields ), 'Expected field errors returned' );
		}
	}
} catch ( Throwable $error ) {
	fwrite( STDERR, 'FAIL: ' . $error->getMessage() . PHP_EOL );
	exit( 1 );
}