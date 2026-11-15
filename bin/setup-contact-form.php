<?php
/** Repeatable initial setup: php bin/setup-contact-form.php. Existing forms are preserved. */
if ( PHP_SAPI !== 'cli' ) {
	http_response_code( 403 );
	exit;
}
require dirname( __DIR__ ) . '/wp-load.php';

try {
	if ( ! class_exists( 'WPCF7_ContactForm' ) || ! function_exists( 'physio_wojcicki_contact_form' ) ) {
		throw new RuntimeException( 'Activate Contact Form 7 and the Physio Wojcicki theme first.' );
	}
	$post = get_page_by_path( 'physio-kontakt', OBJECT, 'wpcf7_contact_form' );
	if ( $post ) {
		echo 'Existing contact form preserved: ' . $post->ID . PHP_EOL;
		exit( 0 );
	}
	$form = WPCF7_ContactForm::get_template( array( 'locale' => 'de_DE', 'title' => 'Kontakt – Physiotherapie Wojcicki' ) );
	$mail = $form->prop( 'mail' );
	$mail['recipient'] = physio_wojcicki_contact( 'email' );
	$mail['sender'] = 'Physiotherapie Wojcicki <' . physio_wojcicki_contact( 'email' ) . '>';
	$mail['subject'] = 'Kontaktanfrage von [your-name]';
	$mail['body'] = "Name: [your-name]\nE-Mail: [your-email]\n\n[your-message]\n\nGesendet über das Kontaktformular auf [_site_title] ([_site_url]).";
	$mail['additional_headers'] = 'Reply-To: [your-email]';
	$privacy_url = get_privacy_policy_url() ?: home_url( '/datenschutz/' );
	$form->set_properties(
		array(
			'form' => sprintf( physio_wojcicki_contact_form_template(), esc_url( $privacy_url ) ),
			'mail' => $mail,
		)
	);
	$id = $form->save();
	if ( ! $id ) {
		throw new RuntimeException( 'Could not save contact form.' );
	}
	$result = wp_update_post( array( 'ID' => $id, 'post_name' => 'physio-kontakt' ), true );
	if ( is_wp_error( $result ) ) {
		throw new RuntimeException( $result->get_error_message() );
	}
	echo 'Contact form ready: ' . $id . PHP_EOL;
} catch ( Throwable $error ) {
	fwrite( STDERR, $error->getMessage() . PHP_EOL );
	exit( 1 );
}