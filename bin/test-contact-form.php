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
} catch ( Throwable $error ) {
	fwrite( STDERR, 'FAIL: ' . $error->getMessage() . PHP_EOL );
	exit( 1 );
}