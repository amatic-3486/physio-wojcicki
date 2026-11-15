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

/** Initial template only; subsequent edits are managed in Contact Form 7. */
function physio_wojcicki_contact_form_template() {
	return <<<'FORM'
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="min-w-0">
<label for="kontakt-name" class="sr-only">Ihr Name</label>
[text* your-name id:kontakt-name autocomplete:name class:w-full class:rounded-xl class:border class:border-[#C9D6E8] class:bg-white class:px-4 class:py-3 class:text-[#222222] class:placeholder-[#555555] class:focus:border-accent class:focus:outline-none class:focus:ring-2 class:focus:ring-accent/30 placeholder "Ihr Name *"]
</div>
<div class="min-w-0">
<label for="kontakt-email" class="sr-only">Ihre E-Mail-Adresse</label>
[email* your-email id:kontakt-email autocomplete:email class:w-full class:rounded-xl class:border class:border-[#C9D6E8] class:bg-white class:px-4 class:py-3 class:text-[#222222] class:placeholder-[#555555] class:focus:border-accent class:focus:outline-none class:focus:ring-2 class:focus:ring-accent/30 placeholder "Ihre E-Mail-Adresse *"]
</div>
<div class="md:col-span-2 min-w-0">
<label for="kontakt-message" class="sr-only">Ihre Nachricht</label>
[textarea* your-message id:kontakt-message 40x5 class:w-full class:rounded-xl class:border class:border-[#C9D6E8] class:bg-white class:px-4 class:py-3 class:text-[#222222] class:placeholder-[#555555] class:focus:border-accent class:focus:outline-none class:focus:ring-2 class:focus:ring-accent/30 placeholder "Ihre Nachricht *"]
</div>
<p class="md:col-span-2 text-xs text-[#555555]">Mit dem Absenden stimmen Sie der Verarbeitung Ihrer Angaben zur Bearbeitung Ihrer Anfrage zu. Details finden Sie in der <a href="%s" class="underline hover:text-accent">Datenschutzerklärung</a>.</p>
<div class="md:col-span-2">
[submit class:inline-flex class:bg-accent-dark class:hover:bg-secondary class:text-white class:font-semibold class:px-7 class:py-3.5 class:rounded-full class:transition-colors "Nachricht senden"]
</div>
</div>
FORM;
}