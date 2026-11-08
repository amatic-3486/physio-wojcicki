<?php
/**
 * The template for the "Kontakt" page.
 *
 * Intro text: page content in the backend (falls back to a default text).
 *
 * @package Physio_Wojcicki
 */

get_header();

$img    = get_template_directory_uri() . '/assets/img/';
$status = isset( $_GET['kontakt'] ) ? sanitize_key( wp_unslash( $_GET['kontakt'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
$hours  = array(
	'Montag'     => '8:30 – 17:00 Uhr',
	'Dienstag'   => '8:30 – 19:00 Uhr',
	'Mittwoch'   => '8:30 – 17:00 Uhr',
	'Donnerstag' => '8:30 – 19:00 Uhr',
	'Freitag'    => '8:30 – 12:30 Uhr',
);
$map_url = 'https://www.openstreetmap.org/search?query=' . rawurlencode( physio_wojcicki_contact( 'address_1' ) . ', ' . physio_wojcicki_contact( 'address_2' ) );
$field   = 'w-full rounded-xl border border-[#C9D6E8] bg-white px-4 py-3 text-[#222222] placeholder-[#555555] focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/30';
?>

<section class="bg-cream overflow-hidden">
	<div class="max-w-7xl mx-auto grid lg:grid-cols-2 items-stretch">
		<div class="px-4 sm:px-6 lg:px-8 py-12 lg:py-16 flex flex-col justify-center">
			<p class="text-accent text-xs sm:text-sm font-semibold tracking-[0.1em] uppercase mb-4"><?php esc_html_e( 'Kontakt', 'physio-wojcicki' ); ?></p>
			<h1 class="font-serif text-4xl sm:text-5xl font-bold text-secondary leading-[1.15] mb-4">
				<?php esc_html_e( 'So erreichen Sie uns', 'physio-wojcicki' ); ?>
			</h1>
			<div class="text-[#555555] max-w-md mb-6">
				<?php
				if ( have_posts() ) {
					the_post();
					$content = trim( wp_strip_all_tags( get_the_content() ) );
					if ( '' !== $content ) {
						the_content();
					} else {
						echo '<p>' . esc_html__( 'Sie haben Fragen oder möchten einen Termin vereinbaren? Wir sind gerne für Sie da.', 'physio-wojcicki' ) . '</p>';
					}
				}
				?>
			</div>
			<div>
				<a href="#kontaktformular" class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3.5 rounded-full transition-colors">
					<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
					</svg>
					<?php esc_html_e( 'Termin vereinbaren', 'physio-wojcicki' ); ?>
					<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
					</svg>
				</a>
			</div>
		</div>
		<div class="relative min-h-[240px] lg:min-h-[340px]">
			<img src="<?php echo esc_url( $img . 'hero-reception.jpeg' ); ?>" alt="<?php esc_attr_e( 'Empfangsbereich der Praxis', 'physio-wojcicki' ); ?>" class="absolute inset-0 w-full h-full object-cover">
		</div>
	</div>
</section>

<section class="bg-white">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">

		<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
			<article class="bg-white border border-[#E5E7EB] rounded-2xl p-6 shadow-sm">
				<span class="w-12 h-12 rounded-full bg-mint text-secondary flex items-center justify-center mb-4">
					<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
						<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
					</svg>
				</span>
				<h2 class="font-serif text-xl font-semibold text-secondary mb-2"><?php esc_html_e( 'Unsere Adresse', 'physio-wojcicki' ); ?></h2>
				<address class="not-italic text-[#222222]">
					<?php echo esc_html( physio_wojcicki_contact( 'address_1' ) ); ?><br>
					<?php echo esc_html( physio_wojcicki_contact( 'address_2' ) ); ?>
				</address>
			</article>

			<article class="bg-white border border-[#E5E7EB] rounded-2xl p-6 shadow-sm">
				<span class="w-12 h-12 rounded-full bg-accent/10 text-accent flex items-center justify-center mb-4">
					<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
					</svg>
				</span>
				<h2 class="font-serif text-xl font-semibold text-secondary mb-2"><?php esc_html_e( 'Unsere Sprechzeiten', 'physio-wojcicki' ); ?></h2>
				<dl class="text-[#222222] text-sm space-y-1">
					<?php foreach ( $hours as $day => $time ) : ?>
						<div class="flex justify-between gap-4">
							<dt><?php echo esc_html( $day ); ?>:</dt>
							<dd><?php echo esc_html( $time ); ?></dd>
						</div>
					<?php endforeach; ?>
				</dl>
			</article>

			<article class="bg-white border border-[#E5E7EB] rounded-2xl p-6 shadow-sm">
				<span class="w-12 h-12 rounded-full bg-mint text-secondary flex items-center justify-center mb-4">
					<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97a1.125 1.125 0 0 0 .417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
					</svg>
				</span>
				<h2 class="font-serif text-xl font-semibold text-secondary mb-2"><?php esc_html_e( 'Kontakt', 'physio-wojcicki' ); ?></h2>
				<a href="<?php echo esc_url( physio_wojcicki_contact( 'phone_href' ) ); ?>" class="block text-2xl font-semibold text-secondary hover:text-accent transition-colors mb-2">
					<?php echo esc_html( physio_wojcicki_contact( 'phone' ) ); ?>
				</a>
				<a href="mailto:<?php echo esc_attr( physio_wojcicki_contact( 'email' ) ); ?>" class="text-sm text-[#555555] hover:text-accent break-all">
					<?php echo esc_html( physio_wojcicki_contact( 'email' ) ); ?>
				</a>
			</article>
		</div>

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
			<article id="kontaktformular" class="bg-white border border-[#E5E7EB] rounded-2xl p-6 shadow-sm scroll-mt-28">
				<div class="flex items-center gap-4 mb-6">
					<span class="w-14 h-14 rounded-full bg-accent/10 text-accent flex items-center justify-center shrink-0">
						<svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0-9.75 6.5-9.75-6.5" />
						</svg>
					</span>
					<div>
						<h2 class="font-serif text-xl font-semibold text-secondary"><?php esc_html_e( 'Ihre Nachricht an uns', 'physio-wojcicki' ); ?></h2>
						<p class="text-sm text-[#555555]"><?php esc_html_e( 'Nutzen Sie gerne unser Kontaktformular. Wir melden uns zeitnah bei Ihnen.', 'physio-wojcicki' ); ?></p>
					</div>
				</div>

				<?php if ( 'ok' === $status ) : ?>
					<p class="mb-4 rounded-xl bg-mint text-secondary px-4 py-3 text-sm" role="status"><?php esc_html_e( 'Vielen Dank! Ihre Nachricht wurde gesendet.', 'physio-wojcicki' ); ?></p>
				<?php elseif ( 'error' === $status ) : ?>
					<p class="mb-4 rounded-xl bg-accent/10 text-accent-dark px-4 py-3 text-sm" role="alert"><?php esc_html_e( 'Die Nachricht konnte nicht gesendet werden. Bitte prüfen Sie Ihre Angaben oder rufen Sie uns an.', 'physio-wojcicki' ); ?></p>
				<?php endif; ?>

				<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
					<input type="hidden" name="action" value="physio_contact">
					<?php wp_nonce_field( 'physio_contact', 'physio_contact_nonce' ); ?>
					<div class="hidden" aria-hidden="true">
						<label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
					</div>
					<div>
						<label for="kontakt-name" class="sr-only"><?php esc_html_e( 'Ihr Name', 'physio-wojcicki' ); ?></label>
						<input id="kontakt-name" name="name" type="text" required autocomplete="name" placeholder="<?php esc_attr_e( 'Ihr Name *', 'physio-wojcicki' ); ?>" class="<?php echo esc_attr( $field ); ?>">
					</div>
					<div>
						<label for="kontakt-email" class="sr-only"><?php esc_html_e( 'Ihre E-Mail-Adresse', 'physio-wojcicki' ); ?></label>
						<input id="kontakt-email" name="email" type="email" required autocomplete="email" placeholder="<?php esc_attr_e( 'Ihre E-Mail-Adresse *', 'physio-wojcicki' ); ?>" class="<?php echo esc_attr( $field ); ?>">
					</div>
					<div class="sm:col-span-2">
						<label for="kontakt-message" class="sr-only"><?php esc_html_e( 'Ihre Nachricht', 'physio-wojcicki' ); ?></label>
						<textarea id="kontakt-message" name="message" rows="5" required placeholder="<?php esc_attr_e( 'Ihre Nachricht *', 'physio-wojcicki' ); ?>" class="<?php echo esc_attr( $field ); ?>"></textarea>
					</div>
					<p class="sm:col-span-2 text-xs text-[#555555]">
						<?php esc_html_e( 'Mit dem Absenden stimmen Sie der Verarbeitung Ihrer Angaben zur Bearbeitung Ihrer Anfrage zu. Details finden Sie in der Datenschutzerklärung.', 'physio-wojcicki' ); ?>
					</p>
					<div class="sm:col-span-2">
						<button type="submit" class="inline-flex items-center gap-2 bg-accent hover:bg-accent-dark text-white font-semibold px-7 py-3.5 rounded-full transition-colors">
							<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
							</svg>
							<?php esc_html_e( 'Nachricht senden', 'physio-wojcicki' ); ?>
						</button>
					</div>
				</form>
			</article>

			<div class="flex flex-col gap-6">
				<article class="bg-white border border-[#E5E7EB] rounded-2xl p-4 shadow-sm flex-1">
					<div class="relative h-full min-h-[260px] rounded-xl bg-[#F1E9DC] overflow-hidden flex items-center justify-center">
						<div class="absolute inset-0 bg-cover bg-center" style="background-image:url('<?php echo esc_url( $img . 'map-bg.png' ); ?>');"></div>
						<div class="relative flex flex-col items-center text-center gap-3 px-4">
							<svg class="w-14 h-14 text-accent" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path fill-rule="evenodd" d="M11.54 22.351s7.46-5.252 7.46-12.101a7.5 7.5 0 1 0-15 0c0 6.849 7.46 12.1 7.46 12.1ZM12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
							</svg>
							<p class="bg-white rounded-lg px-3 py-2 text-sm font-semibold text-secondary shadow"><?php esc_html_e( 'Physiotherapie Wojcicki', 'physio-wojcicki' ); ?></p>
							<a href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 border border-accent text-accent hover:bg-accent hover:text-white text-sm font-semibold px-4 py-2 rounded-full transition-colors">
								<?php esc_html_e( 'Karte öffnen', 'physio-wojcicki' ); ?>
							</a>
						</div>
					</div>
				</article>

				<article class="bg-mint rounded-2xl px-6 py-5 flex items-center gap-4">
					<svg class="w-12 h-12 text-secondary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
					</svg>
					<div>
						<h2 class="font-serif text-xl font-semibold text-secondary"><?php esc_html_e( 'Anfahrt & Parken', 'physio-wojcicki' ); ?></h2>
						<p class="text-sm text-[#555555]"><?php esc_html_e( 'Kostenfreie Parkplätze finden Sie direkt an der Praxis.', 'physio-wojcicki' ); ?></p>
					</div>
				</article>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
