<?php
/** Contact Form 7 integration for the contact page. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Resolve by stable slug instead of an installation-specific post ID. */
function physio_wojcicki_contact_form() {
	if ( ! function_exists( 'wpcf7_contact_form' ) ) {
		return null;
	}
	$post = get_page_by_path( 'physio-kontakt', OBJECT, 'wpcf7_contact_form' );
	return $post && 'publish' === $post->post_status ? wpcf7_contact_form( $post->ID ) : null;
}

/** Initial messages only; subsequent edits are managed in Contact Form 7. */
function physio_wojcicki_contact_form_messages() {
	return array(
		'mail_sent_ok'     => 'Vielen Dank für Ihre Nachricht! Ihre Anfrage wurde gesendet. Unser Praxisteam meldet sich bei Ihnen.',
		'mail_sent_ng'     => 'Ihre Nachricht konnte leider nicht gesendet werden. Bitte versuchen Sie es später erneut oder kontaktieren Sie uns telefonisch.',
		'validation_error' => 'Ihre Nachricht wurde noch nicht gesendet. Bitte prüfen Sie die markierten Felder und senden Sie das Formular erneut ab.',
		'spam'             => 'Ihre Nachricht konnte nicht übermittelt werden. Bitte versuchen Sie es später erneut oder kontaktieren Sie uns telefonisch.',
		'accept_terms'     => 'Ihre Nachricht wurde noch nicht gesendet. Bitte bestätigen Sie die erforderliche Zustimmung und senden Sie das Formular erneut ab.',
		'invalid_required' => 'Bitte füllen Sie dieses Pflichtfeld aus.',
		'invalid_email'    => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
	);
}

/** Initial template only; subsequent edits are managed in Contact Form 7. */
function physio_wojcicki_contact_form_template() {
	return <<<'FORM'
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="min-w-0">
<label for="kontakt-name" class="sr-only">Ihr Name</label>
[text* your-name id:kontakt-name autocomplete:name class:physio-contact-field class:w-full class:rounded-xl class:border class:bg-white class:px-4 class:py-3 placeholder "Ihr Name *"]
</div>
<div class="min-w-0">
<label for="kontakt-email" class="sr-only">Ihre E-Mail-Adresse</label>
[email* your-email id:kontakt-email autocomplete:email class:physio-contact-field class:w-full class:rounded-xl class:border class:bg-white class:px-4 class:py-3 placeholder "Ihre E-Mail-Adresse *"]
</div>
<div class="physio-contact-wide min-w-0">
<label for="kontakt-message" class="sr-only">Ihre Nachricht</label>
[textarea* your-message id:kontakt-message 40x5 class:physio-contact-field class:w-full class:rounded-xl class:border class:bg-white class:px-4 class:py-3 placeholder "Ihre Nachricht *"]
</div>
<p class="physio-contact-wide text-xs text-[#555555]">Mit dem Absenden stimmen Sie der Verarbeitung Ihrer Angaben zur Bearbeitung Ihrer Anfrage zu. Details finden Sie in der <a href="%s" class="underline hover:text-accent">Datenschutzerklärung</a>.</p>
<div class="physio-contact-wide">
[submit class:inline-flex class:bg-accent-dark class:text-white class:font-semibold class:px-7 class:py-3 class:rounded-full class:transition-colors "Nachricht senden"]
</div>
</div>
FORM;
}